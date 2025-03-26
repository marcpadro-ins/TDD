<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IBAN extends Model
{
    public static function validarCCC($ccc) {
        // Comprovar si té el nombre de números correctes
        if (strlen($ccc) != 20 || !ctype_digit($ccc)) {
            return false;
        }

        // Extracció de parts del CCC
        $banc = substr($ccc, 0, 4);
        $oficina = substr($ccc, 4, 4);
        $control = substr($ccc, 8, 2);
        $compte = substr($ccc, 10, 10);
        
        // Pesos per a càlculs
        $pesos_banc_oficina = [4, 8, 5, 10, 9, 7, 3, 6];
        $pesos_compte = [1, 2, 4, 8, 5, 10, 9, 7, 3, 6];
        
        // Càlcul del primer dígit de control
        $suma1 = 0;
        $banc_oficina = $banc . $oficina;
        for ($i = 0; $i < 8; $i++) {
            $suma1 += $banc_oficina[$i] * $pesos_banc_oficina[$i];
        }
        $control1 = 11 - ($suma1 % 11);
        $control1 = ($control1 == 11) ? 0 : (($control1 == 10) ? 1 : $control1);
        
        // Càlcul del segon dígit de control
        $suma2 = 0;
        for ($i = 0; $i < 10; $i++) {
            $suma2 += $compte[$i] * $pesos_compte[$i];
        }
        $control2 = 11 - ($suma2 % 11);
        $control2 = ($control2 == 11) ? 0 : (($control2 == 10) ? 1 : $control2);
        
        // Comparació dels dígits de control calculats amb els proporcionats
        return $control == ($control1 . $control2);
    }
    
    public static function validarIBAN($iban) {
        // Comprovar si té el nombre de números correctes
        if (strlen($iban) < 15 || strlen($iban) > 34 || !ctype_alnum($iban)) {
            return false;
        }

        // Convertir l'IBAN a format numèric
        $iban = strtoupper(str_replace(' ', '', $iban));
        $iban_reordenat = substr($iban, 4) . substr($iban, 0, 4);
    
        // Canviar lletres per números
        $iban_numeric = '';
        for ($i = 0; $i < strlen($iban_reordenat); $i++) {
            $car = $iban_reordenat[$i];
            if (ctype_alpha($car)) {
                $iban_numeric .= (ord($car) - 55);
            } else {
                $iban_numeric .= $car;
            }
        }
    
        // Comprovar mòdul 97
        $resta = bcmod($iban_numeric, '97');
        return $resta == 1;
    }

    public static function getCCCForcaBruta($CCC) {
        $control = 0;
        for ($i = 0; $i <= 99; $i++) {
            $control = str_pad($i, 2, "0", STR_PAD_LEFT);
            $CCC = substr_replace($CCC, $control, 18, 2);
            if (IBAN::validarCCC($CCC)) {
                return $CCC;
            }
        }
        return null;    
    }

    public static function getIBANForcaBruta($iban) {
        for ($i = 0; $i <= 99; $i++) {
            $control = str_pad($i, 2, "0", STR_PAD_LEFT);
            $nouIban = substr_replace($iban, $control, -2, 2);
    
            if (IBAN::validarIBAN($nouIban)) {
                return $nouIban;
            }
        }
        return null;
    }        
}