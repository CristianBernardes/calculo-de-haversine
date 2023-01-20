<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertSaleRequest;
use App\Repositories\SaleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 *
 */
class SaleApiController extends Controller
{
    /**
     * @var SaleRepository
     */
    protected  SaleRepository $saleRepository;

    /**
     * @param SaleRepository $saleRepository
     */
    public function __construct(SaleRepository $saleRepository)
    {
        $this->middleware('auth:api');
        $this->saleRepository = $saleRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sales(Request $request): JsonResponse
    {
        $board = $request->input('board') ?? null;
        $unit = $request->input('unit') ?? null;
        $salesman = $request->input('salesman') ?? null;

        $period = [];

        if ($request->input('start_date') && !$request->input('end_date')) {

            $period = [
                convertDate($request->input('start_date'), '-1'), convertDate(date('Y-m-d'), '+1')
            ];
        } elseif ($request->input('start_date') && $request->input('end_date')) {

            $period = [
                convertDate($request->input('start_date'), '-1'), convertDate($request->input('end_date'), '+1')
            ];
        }

        $startEndDate = sizeof($period) > 0 ? $period : null;

        try {

            return response()->json($this->saleRepository->getSales(Auth::user(), $board, $unit, $salesman, $startEndDate));
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param string $saleId
     * @return JsonResponse
     */
    public function sale(string $saleId): JsonResponse
    {
        try {

            return response()->json($this->saleRepository->getSale(Auth::user(), $saleId));
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param InsertSaleRequest $request
     * @return JsonResponse
     */
    public function insertSale(InsertSaleRequest $request): JsonResponse
    {
        try {
            return response()->json($this->saleRepository->insertSale(Auth::user(), $request->all()));
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
