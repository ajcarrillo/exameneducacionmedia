<?php

namespace Tests\Feature;

use Carbon\Carbon;
use ExamenEducacionMedia\Models\EtapaProceso;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnterRegistrarionPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_see_registration_page()
    {
        factory(EtapaProceso::class)->create([
            'nombre'      => 'REGISTRO',
            'descripcion' => 'REGISTRO',
            'apertura'    => Carbon::now()->format('Y-m-d'),
            'cierre'      => Carbon::now()->format('Y-m-d'),
        ]);

        $this->get('/registro')
            ->assertStatus(200);
    }

    public function test_a_user_cant_see_registration_page()
    {
        factory(EtapaProceso::class)->create([
            'nombre'      => 'REGISTRO',
            'descripcion' => 'REGISTRO',
            'apertura'    => '2018-09-01',
            'cierre'      => '2018-09-07',
        ]);

        $this->get('/registro')
            ->assertStatus(500);
    }
}
