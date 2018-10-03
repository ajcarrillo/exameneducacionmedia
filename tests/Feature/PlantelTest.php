<?php

namespace Tests\Feature;

use Artisan;
use ExamenEducacionMedia\Models\Plantel;
use ExamenEducacionMedia\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlantelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    protected function user($withRole = false, $beenResponsible = false): User
    {
        $userId = factory(User::class)->create()->id;
        $user   = User::find($userId);

        if ($withRole) {
            $user->groups()->attach(2);
        }

        if ($beenResponsible) {
            $plantel = Plantel::first();
            $user->plantel()->save($plantel);
        }

        return $user;
    }

    public function test_a_user_can_see_plantel_module()
    {
        $user = $this->user(true, true);

        $this->be($user)
            ->get('/planteles')
            ->assertStatus(200);
    }

    public function test_a_plantel_user_cant_see_plantel_module_if_not_is_responsible()
    {
        $user = $user = $this->user(true);

        $this->be($user)
            ->get('/planteles')
            ->assertStatus(401);
    }

    public function test_a_user_cant_see_plantel_module()
    {
        $user = $user = $this->user();

        $this->be($user)
            ->get('/planteles')
            ->assertStatus(401);
    }
}
