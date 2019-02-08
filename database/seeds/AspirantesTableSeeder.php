<?php

use Illuminate\Database\Seeder;

class AspirantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\ExamenEducacionMedia\User::class, 5)->create()->each(function ($user) {
            $user->assignRole('aspirante');
            $user->aspirante()->save(factory(\Aspirante\Models\Aspirante::class)->make());
        });
    }
}
