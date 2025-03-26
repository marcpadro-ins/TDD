<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\GestorDeTasques;
use App\Models\Tasca;
use Illuminate\Support\Facades\Date;

class GestorDeTasquesTest extends TestCase 
{
    public function test_crear_gestor_de_tasques() 
    {
        $gestorDeTasques = new GestorDeTasques();
        $this->assertNotNull($gestorDeTasques);
        $this->assertEquals([], $gestorDeTasques->llistarTasques());
    }

    public function test_tasca_throw_exception() : void
    {
        $this->expectException(\Exception::class);
        new Tasca('', 'Descripció tasca 1', new Date());
    }

    public function test_afegir_tasca() : void
    {
        $gestorDeTasques = new GestorDeTasques();
        $newTasca = new Tasca('Tasca 1', 'Descripció tasca 1', new Date());
        $gestorDeTasques->afegirTasca($newTasca);
        $this->assertCount(1, $gestorDeTasques->llistarTasques());
    }

    public function test_actualitzar_tasca() : void
    {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca(new Tasca('Tasca 1', 'Descripció tasca 1', new Date()));
        $gestorDeTasques->actualitzarEstatTasca('Tasca 1', Tasca::EN_CURS);
        $this->assertEquals(Tasca::EN_CURS, $gestorDeTasques->llistarTasques()[0]->getEstat());
    }

    public function test_eliminar_tasca() : void
    {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca(new Tasca('Tasca 1', 'Descripció tasca 1', new Date()));
        $gestorDeTasques->eliminarTasca('Tasca 1');
        $this->assertCount(0, $gestorDeTasques->llistarTasques());
    }

    public function test_eliminar_tasca_no_existent() : void
    {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca(new Tasca('Tasca 1', 'Descripció tasca 1', new Date()));
        $this->expectException(\Exception::class);
        $gestorDeTasques->eliminarTasca('Tasca 2');
    }

    public function test_actualitzar_tasca_no_existent() : void
    {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca(new Tasca('Tasca 1', 'Descripció tasca 1', new Date()));
        $this->expectException(\Exception::class);
        $gestorDeTasques->actualitzarEstatTasca('Tasca 2', Tasca::EN_CURS);
    }
}
