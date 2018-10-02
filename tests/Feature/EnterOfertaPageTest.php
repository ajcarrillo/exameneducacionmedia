<?php

namespace Tests\Feature;

use ExamenEducacionMedia\Models\EtapaProceso;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnterOfertaPageTest extends TestCase
{
    use RefreshDatabase;

    protected $etapa = 'OFERTA';

    public function test_a_user_can_see_oferta_page()
    {
        factory(EtapaProceso::class)->create([
            'nombre'      => $this->etapa,
            'descripcion' => $this->etapa,
            'apertura'    => '2018-10-02',
            'cierre'      => '2018-10-02',
        ]);

        $this->get('/subsistema/oferta')
            ->assertStatus(200);
    }

    public function test_a_user_cant_see_oferta_page()
    {
        factory(EtapaProceso::class)->create([
            'nombre'      => $this->etapa,
            'descripcion' => $this->etapa,
            'apertura'    => '2018-09-01',
            'cierre'      => '2018-09-07',
        ]);

        $this->get('/subsistema/oferta')
            ->assertStatus(500);
    }
}
