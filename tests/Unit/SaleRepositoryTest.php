<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\SaleRepository;
use Tests\TestCase;

class SaleRepositoryTest extends TestCase
{
    /**
     * Testa se o método getSales retorna as vendas do usuário específico.
     *
     * @return void
     */
    public function testGetSalesReturnsSalesForSpecificUser()
    {
        $user = User::where('email', 'pele@magazineaziul.com.br')->first();

        $board = null;
        $unit = null;
        $salesman = null;
        $startEndDate = null;

        $saleRepository = new SaleRepository();

        $result = $saleRepository->getSales($user, $board, $unit, $salesman, $startEndDate);

        $this->assertTrue(sizeof($result['menu']['salesman']) > 0);
    }
}
