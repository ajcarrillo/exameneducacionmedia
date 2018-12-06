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
            $u->assignRole('plantel');
        });

        factory(\ExamenEducacionMedia\User::class, 1)->create([
            'username' => 'subsistema',
        ])->each(function ($u) {
            $u->assignRole('subsistema');
        });

        factory(\ExamenEducacionMedia\User::class, 1)->create([
            'username' => 'departamento',
        ])->each(function ($u) {
            $u->assignRole('departamento');
        });
    }
}
