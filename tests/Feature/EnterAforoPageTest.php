<?php

namespace Tests\Feature;

use Carbon\Carbon;
use ExamenEducacionMedia\Models\EtapaProceso;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnterAforoPageTest extends TestCase
{
    use RefreshDatabase;

    protected $etapa = 'AFORO';

    public function test_a_user_can_see_aforo_page()
    {
        factory(EtapaProceso::class)->create([
            'nombre'      => $this->etapa,
            'descripcion' => $this->etapa,
            'apertura'    => Carbon::now()->format('Y-m-d'),
            'cierre'      => Carbon::now()->format('Y-m-d'),
        ]);

        $this->get('/subsistema/aforo')
            ->assertStatus(200);
    }

    public function test_a_user_cant_see_aforo_page()
    {
        factory(EtapaProceso::class)->create([
            'nombre'      => $this->etapa,
            'descripcion' => $this->etapa,
            'apertura'    => '2018-09-01',
            'cierre'      => '2018-09-07',
        ]);

        $this->get('/subsistema/aforo')
            ->assertStatus(500);
    }
}
