<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\SaleRepository;
use Exception;
use Tests\TestCase;

class InsertSalesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testInsertSalesForSpecificRoamingTrueUser()
    {
        $user = User::where('email', 'afonso.afancar@magazineaziul.com.br')->first();

        $saleRepository = new SaleRepository();

        $result = $saleRepository->insertSale($user, [
            "latitude" => "-25.473704465731746",
            "longitude" => "-49.24787198992874",
            "sale_value" => 500.44
        ]);

        $this->assertFalse($result->roaming === 0);
        $this->assertTrue($result->roaming === 1);
        $this->assertNotEmpty($result);
    }

    public function testInsertSalesForSpecificRoamingFalseUser()
    {
        $user = User::where('email', 'afonso.afancar@magazineaziul.com.br')->first();

        $saleRepository = new SaleRepository();

        $result = $saleRepository->insertSale($user, [
            "latitude" => "-19.917854829716372",
            "longitude" => "-43.94089385954766",
            "sale_value" => 800.55
        ]);

        $this->assertTrue($result->roaming === 0);
        $this->assertNotEmpty($result);
    }

    public function testInsertSalesForUserNotSalesman()
    {
        $this->withExceptionHandling('\Exception');

        try {
            $user = User::where('email', 'pele@magazineaziul.com.br')->first();

            $saleRepository = new SaleRepository();

            $result = $saleRepository->insertSale($user, [
                "latitude" => "-25.473704465731746",
                "longitude" => "-49.24787198992874",
                "sale_value" => 80500.44
            ]);
        } catch (\Exception $e) {
            $this->assertEquals('Only sellers are allowed to make a sale', $e->getMessage());
        }
    }
}
