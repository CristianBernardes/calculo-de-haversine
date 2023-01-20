<?php

/** @noinspection ALL */

namespace App\Repositories;

use App\Models\Board;
use App\Models\Unity;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class SaleRepository
{
    /**
     * @param $authUser
     * @param string|null $board
     * @param string|null $unit
     * @param string|null $salesman
     * @param array|null $startEndDate
     * @return array
     */
    public function getSales($authUser, string|null $board, string|null $unit, string|null $salesman, array|null $startEndDate)
    {
        $boards = Board::select('board_name')->get()->pluck('board_name');
        $units = Unity::select('unit_name')->get()->pluck('unit_name');
        $salesmans = User::select('id', 'name')->get();

        $boardsUnits = $authUser->board_unit;

        if ($authUser->profile === User::DIRECTOR) {

            $boards = Board::select('board_name')->where('id', $boardsUnits['board_id'])->pluck('board_name');
            $units = Unity::select('unit_name')->where('board_id', $boardsUnits['board_id'])->get()->pluck('unit_name');
            $salesmans = User::select('users.id', 'users.name')
                ->join('board_unit_users', 'users.id', 'board_unit_users.user_id')
                ->where('board_id', $boardsUnits['board_id'])
                ->get();
        }

        if ($authUser->profile === User::MANAGER) {

            $boards = Board::select('board_name')->where('id', $boardsUnits['board_id'])->pluck('board_name');
            $units = Unity::select('unit_name')->where('id', $boardsUnits['unit_id'])->get()->pluck('unit_name');
            $salesmans = User::select('users.id', 'users.name')
                ->join('board_unit_users', 'users.id', 'board_unit_users.user_id')
                ->where('unit_id', $boardsUnits['unit_id'])
                ->get();
        }

        if ($authUser->profile === User::SALESMAN) {

            $boards = Board::select('board_name')->where('id', $boardsUnits['board_id'])->pluck('board_name');
            $units = Unity::select('unit_name')->where('id', $boardsUnits['unit_id'])->get()->pluck('unit_name');
            $salesmans = User::select('users.id', 'users.name')
                ->join('board_unit_users', 'users.id', 'board_unit_users.user_id')
                ->where('user_id', $authUser->id)
                ->get();
        }

        /** @var TYPE_NAME $aggregatedQuery */
        $aggregatedQuery = fn (string $value) => $this->aggregatedQuery(
            $this->querySale(
                $salesmans->pluck('id'),
                $board,
                $unit,
                $salesman,
                $startEndDate
            ),
            $value
        );

        return [
            'sales_amount' => $aggregatedQuery('sale_value'),
            'sales' => $this->querySale($salesmans->pluck('id'), $board, $unit, $salesman, $startEndDate)->get(),
            'menu' => [
                'boards' => $boards,
                'units' => $units,
                'salesman' => $salesmans->pluck('name'),
            ]
        ];
    }

    /**
     * @param string $saleId
     * @return mixed
     * @throws \Exception
     */
    public function getSale($authUser, string $saleId)
    {
        $sale = $this->querySale()->where('sales.id', $saleId)->first();

        $boardsUnits = $authUser->board_unit;

        if ($authUser->profile === User::DIRECTOR) {
            $sale = $this->querySale()->where('boards.id', $boardsUnits['board_id'])->where('sales.id', $saleId)->first();
        }

        if ($authUser->profile === User::MANAGER) {
            $sale = $this->querySale()
                ->where('boards.id', $boardsUnits['board_id'])
                ->where('units.id', $boardsUnits['unit_id'])
                ->where('sales.id', $saleId)->first();
        }

        if ($authUser->profile === User::SALESMAN) {
            $sale = $this->querySale()->where('users.id', $authUser->id)->where('sales.id', $saleId)->first();
        }

        if (!$sale) {
            throw new \Exception('Sale not found', 404);
        }

        return $sale;
    }

    /**
     * @param $usersId
     * @param $board
     * @param $unit
     * @param $salesman
     * @param $startEndDate
     * @return mixed
     */
    public function querySale(
        $usersId = null,
        $board = null,
        $unit = null,
        $salesman = null,
        $startEndDate = null,
    ) {
        return Sale::select(
            'sales.id AS sale_id',
            'sales.sale_value',
            'users.name AS salesman',
            DB::raw('COALESCE(sales.unit_name, units.unit_name) AS nearest_unit'),
            'boards.board_name AS board_salesman',
            'sales.latitude',
            'sales.longitude',
            'sales.roaming',
        )
            ->join('users', 'users.id', 'sales.user_id')
            ->join('board_unit_users', 'board_unit_users.user_id', 'users.id')
            ->join('units', 'units.id', 'board_unit_users.unit_id')
            ->join('boards', 'boards.id', 'units.board_id')
            ->when($usersId, function ($query, $usersId) {
                $query->whereIn('sales.user_id', $usersId);
            })
            ->when($board, function ($query, $board) {
                $query->where('boards.board_name', $board);
            })
            ->when($unit, function ($query, $unit) {
                $query->where('units.unit_name', $unit);
            })
            ->when($salesman, function ($query, $salesman) {
                $query->where('users.name', $salesman);
            })->when($startEndDate, function ($q, $startEndDate) {
                $q->whereBetween('sales.created_at', $startEndDate);
            });
    }

    /**
     * @param $authUser
     * @param array $request
     * @return Sale
     * @throws \Exception
     */
    public function insertSale($authUser, array $request)
    {
        if ($authUser->profile != User::SALESMAN) {
            throw new \Exception('Only sellers are allowed to make a sale', 403);
        }

        $lat = $request['latitude'];

        $lon = $request['longitude'];

        $distance = distance($lat, $lon, $authUser->show_seller_coordinates->latitude, $authUser->show_seller_coordinates->longitude);

        $roaming = 0;

        $unitName = null;

        if ($distance > 100) {

            foreach (Unity::select('unit_name', 'latitude', 'longitude')->get() as $unity) {
                $unityDistance = distance($lat, $lon, $unity->latitude, $unity->longitude);

                if ($distance > $unityDistance) {
                    $roaming = 1;
                    $unitName = $unity->unit_name;
                    break;
                }
            }
        }

        $sale = new Sale();
        $sale->user_id = $authUser->id;
        $sale->unit_name = $unitName;
        $sale->unit_name = $unitName;
        $sale->latitude = $lat;
        $sale->longitude = $lon;
        $sale->sale_value = $request['sale_value'];
        $sale->roaming = $roaming;
        $sale->date_hour_sale = Carbon::now();
        $sale->save();

        return $sale;
    }

    /**
     * @param $subQuery
     * @param $value
     * @return int|mixed
     */
    public function aggregatedQuery($subQuery, $value)
    {
        $subquerySql = $subQuery->toSql();

        return DB::table(DB::raw("($subquerySql) as subquery"))
            ->mergeBindings($subQuery->getQuery())
            ->sum("subquery.$value");
    }
}
