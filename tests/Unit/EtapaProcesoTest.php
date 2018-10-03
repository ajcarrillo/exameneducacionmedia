<?php

namespace Tests\Unit;

use Carbon\Carbon;
use ExamenEducacionMedia\Models\EtapaProceso;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EtapaProcesoTest extends TestCase
{
    use RefreshDatabase;

    protected function crearEtapa($etapa, $apertura, $cierre)
    {
        factory(EtapaProceso::class)->create([
            'nombre'      => $etapa,
            'descripcion' => $etapa,
            'apertura'    => $apertura,
            'cierre'      => $cierre,
        ]);
    }

    public function test_a_user_can_get_into_aforo_stage()
    {

        $this->crearEtapa('AFORO', Carbon::now()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $result = EtapaProceso::isAforo();

        $this->assertEquals(true, $result);
    }

    public function test_a_user_can_get_into_oferta_stage()
    {
        $this->crearEtapa('OFERTA', Carbon::now()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $result = EtapaProceso::isOferta();

        $this->assertEquals(true, $result);
    }

    public function test_a_user_can_get_into_registro_stage()
    {
        $this->crearEtapa('REGISTRO', Carbon::now()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $result = EtapaProceso::isRegistro();

        $this->assertEquals(true, $result);
    }

    public function test_a_user_cant_get_into_aforo_stage()
    {

        $this->crearEtapa('AFORO', '2018-09-01', '2018-09-07');
        $result = EtapaProceso::isAforo();

        $this->assertEquals(false, $result);
    }

    public function test_a_user_cant_get_into_oferta_stage()
    {
        $this->crearEtapa('OFERTA', '2018-09-01', '2018-09-07');
        $result = EtapaProceso::isOferta();

        $this->assertEquals(false, $result);
    }

    public function test_a_user_cant_get_into_registro_stage()
    {
        $this->crearEtapa('REGISTRO', '2018-09-01', '2018-09-07');
        $result = EtapaProceso::isRegistro();

        $this->assertEquals(false, $result);
    }
}
