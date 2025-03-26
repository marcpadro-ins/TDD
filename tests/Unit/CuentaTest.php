<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Cuenta;

class CuentaTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_saldo_inicial_es_cero() : void 
    {
        $cuenta = new Cuenta();
        $this->assertEquals(0, $cuenta->getSaldo());
    }

    public function test_depositar_100_aumenta_saldo_a_100() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(10000);
        $this->assertEquals(10000, $cuenta->getSaldo());
    }

    public function test_depositar_3000() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(300000);
        $this->assertEquals(300000, $cuenta->getSaldo());
    }

    public function test_depositar_100_y_luego_200() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(10000);
        $this->assertEquals(10000, $cuenta->getSaldo());
        $cuenta->depositar(20000);
        $this->assertEquals(30000, $cuenta->getSaldo());
    }

    public function test_depositar_negativo() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(-10000);
        $this->assertEquals(0, $cuenta->getSaldo());
    }

    public function test_depositar_decimales() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(12345);
        $this->assertEquals(12345, $cuenta->getSaldo());
    }

    // public function test_depositar_tres_decimales() : void 
    // {
    //     $cuenta = new Cuenta();
    //     $cuenta->depositar(123457);
    //     $this->assertEquals(0, $cuenta->getSaldo());
    // }

    public function test_depositar_6000() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(600000);
        $this->assertEquals(600000, $cuenta->getSaldo());
    }

    public function test_depositar_6000_1_centimo() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(6000001);
        $this->assertEquals(0, $cuenta->getSaldo());
    }

    public function test_retirar_100() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(50000);
        $cuenta->retirar(10000);
        $this->assertEquals(40000, $cuenta->getSaldo());
    }

    public function test_retirar_mas_que_saldo() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(20000);
        $cuenta->retirar(50000);
        $this->assertEquals(20000, $cuenta->getSaldo());
    }

    public function test_retirar_negativo() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(20000);
        $cuenta->retirar(-10000);
        $this->assertEquals(20000, $cuenta->getSaldo());
    }

    public function test_retirar_decimales() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(200000);
        $cuenta->retirar(100001);
        $this->assertEquals(99999, $cuenta->getSaldo());
    }

    // public function test_retirar_tres_decimales() : void 
    // {
    //     $cuenta = new Cuenta();
    //     $cuenta->depositar(200.0);
    //     $cuenta->retirar(100.456);
    //     $this->assertEquals(200.0, $cuenta->getSaldo());
    // }

    public function test_retirar_6000() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(600000);
        $cuenta->retirar(600000);
        $this->assertEquals(0, $cuenta->getSaldo());
    } 

    public function test_retirar_6000_1_centimo() : void 
    {
        $cuenta = new Cuenta();
        $cuenta->depositar(600000);
        $cuenta->depositar(600000);
        $cuenta->retirar(6000001);
        $this->assertEquals(1200000, $cuenta->getSaldo());
    }

    public function test_transferencia() : void 
    {
        $cuenta1 = new Cuenta();
        $cuenta2 = new Cuenta();
        $cuenta1->depositar(10000);

        $cuenta1->transfereir(5000, $cuenta2);
        // $cuenta1->transfereir($cuenta2, 50.0);
        // Cuenta::transfereir($cuenta1, $cuenta2, 50.0);

        $this->assertEquals(5000, $cuenta1->getSaldo());
        $this->assertEquals(5000, $cuenta2->getSaldo());
    }

    public function test_transferencia_saldo_insuficiente() : void 
    {
        $cuenta1 = new Cuenta();
        $cuenta2 = new Cuenta();
        $cuenta1->depositar(10000);
        $cuenta1->transfereir(15000, $cuenta2);
        $this->assertEquals(10000, $cuenta1->getSaldo());
        $this->assertEquals(0, $cuenta2->getSaldo());
    }

    public function test_transferencia_negativo() : void 
    {
        $cuenta1 = new Cuenta();
        $cuenta2 = new Cuenta();
        $cuenta1->depositar(10000);
        $cuenta1->transfereir(-5000, $cuenta2);
        $this->assertEquals(10000, $cuenta1->getSaldo());
        $this->assertEquals(0, $cuenta2->getSaldo());
    }

    public function test_transferencia_dentro_del_limite() : void 
    {
        $cuenta1 = new Cuenta();
        $cuenta2 = new Cuenta();
        $cuenta1->depositar(350000);
        $cuenta2->depositar(5000);

        $cuenta1->transfereir(300000, $cuenta2);

        $this->assertEquals(50000, $cuenta1->getSaldo());
        $this->assertEquals(305000, $cuenta2->getSaldo());
    }

    public function test_transferencia_supera_limite() : void 
    {
        $cuenta1 = new Cuenta();
        $cuenta2 = new Cuenta();
        $cuenta1->depositar(350000);
        $cuenta2->depositar(5000);

        $cuenta1->transfereir(300001, $cuenta2);

        $this->assertEquals(350000, $cuenta1->getSaldo());
        $this->assertEquals(5000, $cuenta2->getSaldo());
    }

    public function test_transferencia_varias_hasta_limite() : void 
    {
        $cuenta1 = new Cuenta();
        $cuenta2 = new Cuenta();
        $cuenta1->depositar(350000);
        $cuenta2->depositar(5000);

        $cuenta1->transfereir(200000, $cuenta2);
        $cuenta1->transfereir(120000, $cuenta2);

        $this->assertEquals(150000, $cuenta1->getSaldo());
        $this->assertEquals(205000, $cuenta2->getSaldo());
    }
}
