<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    public static int $INGRESO_MAXIMO = 600000;
    public static int $RETIRO_MAXIMO = 600000;
    public static int $LIMITE_TRANSFERENCIA_DIARIA = 300000;

    private int $saldo = 0;
    private int $transferenciasHoy = 0;

    public function getSaldo() : int
    {
        return $this->saldo;
    }

    /**
     * Depositar dinero en la cuenta
     *
     * @param int $amount Saldo a depositar en euros
     * @return void
     */
    public function depositar(int $amount) : void 
    {
        if ($amount > 0
            // && $this->less_than_two_decimals($amount)
            && $amount <= self::$INGRESO_MAXIMO) {
            $this->saldo += $amount;
        }        
    }

    // private function less_than_two_decimals(int $amount) : bool
    // {
    //     return (bool) preg_match('/^\d+(\.\d{1,2})?$/', $amount);
    //     // $decimals = explode('.', $amount);
    //     // if (strlen($decimals[1] ?? '0') > 2) {
    //     //     return false;
    //     // }
    //     // return true;
    // }

    public function retirar(int $amount) : void
    {
        if ($amount > 0 
            // && $this->less_than_two_decimals($amount)
            && $amount <= $this->saldo
            && $amount <= self::$RETIRO_MAXIMO) {
            $this->saldo -= $amount;
        }
    }

    public function transfereir(int $amount, Cuenta $cuenta) : void
    {
        if ($amount > 0 
            // && $this->less_than_two_decimals($amount)
            && $amount <= $this->saldo
            && $amount <= self::$RETIRO_MAXIMO
            && ($this->transferenciasHoy + $amount) <= self::$LIMITE_TRANSFERENCIA_DIARIA) { // Comprovar límit diari
            $this->saldo -= $amount;
            $cuenta->saldo += $amount;
            $this->transferenciasHoy += $amount;
        }
    }
}