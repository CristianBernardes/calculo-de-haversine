<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertSaleRequest;
use App\Http\Requests\InsertSaleRoamingRequest;
use App\Repositories\SaleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * @group Informações sobre vendas
 *
 * Rotas para obter e realizar vendas de usuários com perfil vendedor e para gerenciamento de usuários com perfil administrativo
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
     * Listar vendas realizadas.
     * @authenticated
     * @queryParam board string. Example: Sudeste
     * @queryParam unit string. Example: Belo Horizonte
     * @queryParam salesman string. Example: Afonso Afancar
     * @queryParam start_date string. Example: 2023-01-01
     * @queryParam end_date string. Example: 2023-01-19
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

            return response()->json(['error' => $e->getMessage()], $e->getCode() === 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Listar informação de uma venda especifica
     * @authenticated
     * @param string $saleId
     * @return JsonResponse
     */
    public function sale(string $saleId): JsonResponse
    {
        try {

            return response()->json($this->saleRepository->getSale(Auth::user(), $saleId));
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], $e->getCode() === 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Inserir uma nova venda com roaming calculado
     * @authenticated
     * @param InsertSaleRequest $request
     * @return JsonResponse
     */
    public function insertSale(InsertSaleRequest $request): JsonResponse
    {
        try {

            return response()->json($this->saleRepository->insertSale(Auth::user(), $request->all()));
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], $e->getCode() === 0 ? 400 : $e->getCode());
        }
    }

    /**
     * Inserir uma nova venda sem roaming calculado
     * @authenticated
     * @param InsertSaleRoamingRequest $request
     * @return JsonResponse
     */
    public function insertSaleRoaming(InsertSaleRoamingRequest $request): JsonResponse
    {
        try {

            return response()->json($this->saleRepository->insertSale(Auth::user(), $request->all(), false));
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], $e->getCode() === 0 ? 400 : $e->getCode());
        }
    }
}
