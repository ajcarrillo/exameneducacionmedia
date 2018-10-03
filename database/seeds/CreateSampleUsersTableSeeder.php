<?php

use Illuminate\Database\Seeder;

class CreateSampleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\ExamenEducacionMedia\User::class, 1)->create([
            'username' => 'plantel',
        ])->each(function ($u) {
            $u->groups()->attach(2);
        });

        factory(\ExamenEducacionMedia\User::class, 1)->create([
            'username' => 'subsistema',
        ])->each(function ($u) {
            $u->groups()->attach(5);
            $subsistema = \ExamenEducacionMedia\Models\Subsistema::first();
            $u->subsistema()->save($subsistema);
        });

        factory(\ExamenEducacionMedia\User::class, 1)->create([
            'username' => 'departamento',
        ])->each(function ($u) {
            $u->groups()->attach(3);
        });
    }
}
