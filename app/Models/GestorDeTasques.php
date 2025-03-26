<?php

namespace App\Models;

use Illuminate\Support\Facades\Date;
use Exception;

/**
 * Classe GestorDeTasques
 * Aquesta classe gestiona una llista de tasques.
 */
class GestorDeTasques
{
    private array $tasques;

    /**
     * Constructor de la classe GestorDeTasques
     */
    public function __construct() 
    {
        $this->tasques = [];
    }

    /**
     * Afegeix una tasca al gestor de tasques
     * @param Tasca $tasca Passem un objecte de tipus Tasca
     * @return void
     */
    public function afegirTasca(Tasca $tasca) : void
    {
        $this->tasques[] = $tasca;
    }

    /**
     * Elimina una tasca del gestor de tasques
     * @param string $titol Títol de la tasca
     * @throws Exception Si la tasca no existeix
     * @return void
     */
    public function eliminarTasca(string $titol) : void
    {
        $tasquesRestants = [];
        $trobat = false;

        foreach ($this->tasques as $tasca) {
            if ($tasca->getTitol() === $titol) {
                $trobat = true;
            } else {
                $tasquesRestants[] = $tasca;
            }
        }

        if (!$trobat) {
            throw new Exception('La tasca no existeix');
        }

        $this->tasques = $tasquesRestants;
    }

    /**
     * Actualitza l'estat d'una tasca
     * @param string $titol
     * @param int $estat És un estat de la classe Tasca
     * @throws Exception Si la tasca no existeix
     * @return void
     */
    public function actualitzarEstatTasca(string $titol, int $estat) : void
    {
        $trobat = false;

        foreach ($this->tasques as $tasca) {
            if ($tasca->getTitol() === $titol) {
                $tasca->setEstat($estat);
                $trobat = true;
                break;
            }
        }

        if (!$trobat) {
            throw new Exception('La tasca no existeix');
        }
    }

    /**
     * Llista totes les tasques del gestor de tasques
     * @return array
     */
    public function llistarTasques() : array
    {
        return $this->tasques;
    }

    /**
     * Filtra les tasques per estat
     * @param int $estat Estat de la tasca
     * @return array
     */
    public function filtrarTasquesPerEstat(int $estat) : array
    {
        return array_filter($this->tasques, function ($tasca) use ($estat) {
            return $tasca->getEstat() === $estat;
        });
    }
}