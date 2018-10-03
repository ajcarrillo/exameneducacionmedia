<?php

namespace Tests\Feature;

use Artisan;
use ExamenEducacionMedia\Models\Subsistema;
use ExamenEducacionMedia\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubsistemaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    public function test_a_subsistema_user_can_see_subsistema_module()
    {
        $userId = factory(User::class)->create()->id;
        $user   = User::find($userId);

        $user->groups()->attach(5);
        $subsistema = Subsistema::first();
        $user->subsistema()->save($subsistema);

        $this->be($user)
            ->get('/subsistemas')
            ->assertStatus(200);
    }

    public function test_a_user_cant_see_subsistema_modulo_without_role_subsistema()
    {
        $userId = factory(User::class)->create()->id;

        $user = User::find($userId);

        $this->be($user)
            ->get('/subsistemas')
            ->assertStatus(401);
    }
}
