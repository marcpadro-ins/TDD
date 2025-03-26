<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GestorDeTasques;
use App\Models\Tasca;
use Illuminate\Support\Facades\Date;

class GestorDeTasquesController extends Controller
{
    public function index()
    {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca(new Tasca('Tasca 1', 'Descripció tasca 1', new Date()));
        $gestorDeTasques->afegirTasca(new Tasca('Tasca 2', 'Descripció tasca 2', new Date()));
        $gestorDeTasques->afegirTasca(new Tasca('Tasca 3', 'Descripció tasca 3', new Date()));
        $gestorDeTasques->afegirTasca(new Tasca('Tasca 4', 'Descripció tasca 4', new Date()));

        $gestorDeTasques->actualitzarEstatTasca('Tasca 1', 2);
        $gestorDeTasques->actualitzarEstatTasca('Tasca 2', 2);
        $gestorDeTasques->actualitzarEstatTasca('Tasca 3', 3);

        $gestorDeTasques->eliminarTasca('Tasca 4');
        $gestorDeTasques->eliminarTasca('Tasca 2');
    }
}
