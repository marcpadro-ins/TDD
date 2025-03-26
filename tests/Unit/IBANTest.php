<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\IBAN;

class IBANTest extends TestCase
{
    public function test_validar_iban_correctament()
    {
        $ibanValid = "ES9121000418450200051332";
        $ibanInvalid = "ES9121000418450200051331";

        $this->assertTrue(IBAN::validarIBAN($ibanValid) && IBAN::validarCCC(substr($ibanValid, 4, 20)));
        $this->assertFalse(IBAN::validarIBAN($ibanInvalid) && IBAN::validarCCC(substr($ibanInvalid, 4, 20)));
    }

    public function test_validar_ccc_correctament()
    {
        $cccValid = "21000418450200051332";
        $cccInvalid = "21000418450200051331";

        $this->assertTrue(IBAN::validarCCC($cccValid));
        $this->assertFalse(IBAN::validarCCC($cccInvalid));
    }

    public function test_obtenir_compte_amb_forca_bruta_ccc() {
        $cccValid = "210004184502000513**";
        $cccInvalid = "210004187502000513**";
        
        $resultatValid = IBAN::getCCCForcaBruta($cccValid);
        $resultatInvalid = IBAN::getCCCForcaBruta($cccInvalid);
    
        $this->assertNotNull($resultatValid);
        $this->assertTrue(IBAN::validarCCC($resultatValid));
        
        $this->assertNull($resultatInvalid);
    }
    
    public function test_obtenir_compte_amb_forca_bruta_iban() {
        $ibanValid = "ES91210004184502000513**";
        $ibanInvalid = "ES91-10004184502000513**";
    
        $resultatValid = IBAN::getIBANForcaBruta($ibanValid);
        $resultatInvalid = IBAN::getIBANForcaBruta($ibanInvalid);
    
        $this->assertNotNull($resultatValid);
        $this->assertTrue(IBAN::validarIBAN($resultatValid));
        
        $this->assertNull($resultatInvalid);
    }
}