<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Date;

class Tasca 
{
    private string $titol;
    private string $descripcio;
    private Date $dataLimit;
    private int $estat;
    
    public const PENDENT = 1;
    public const EN_CURS = 2;
    public const COMPLETAT = 3;

    /**
     * Constructor de la classe Tasca
     * @param string $titol
     * @param string $descripcio
     * @param Date $dataLimit
     * @throws Exception
     */
    public function __construct(string $titol, string $descripcio, Date $dataLimit) 
    {
        if (empty($titol)) {
            throw new Exception('El títol de la tasca no pot ser buit');
        }
        
        if (empty($descripcio)) {
            throw new Exception('La descripció de la tasca no pot ser buida');
        }

        if (!$dataLimit || $dataLimit > Date::now()) { 
            throw new Exception('La data límit de la tasca ha de ser vàlida i no pot ser futura');
        }

        $this->titol = $titol;
        $this->descripcio = $descripcio;
        $this->dataLimit = $dataLimit;
        $this->estat = self::PENDENT;
    }

    public function getTitol(): string
    {
        return $this->titol;
    }

    public function getDescripcio(): string
    {
        return $this->descripcio;
    }

    public function getDataLimit(): Date
    {
        return clone $this->dataLimit;
    }

    public function getEstat(): int
    {
        return $this->estat;
    }

    public function setEstat(int $estat): void
    {
        if (!in_array($estat, [self::PENDENT, self::EN_CURS, self::COMPLETAT], true)) {
            throw new Exception('Estat no vàlid');
        }
        $this->estat = $estat;
    }

    public function __toString() : string
    {
        return $this->titol . ' - ' . $this->descripcio . ' - ' . $this->dataLimit . ' - ' . $this->estat;
    }
}