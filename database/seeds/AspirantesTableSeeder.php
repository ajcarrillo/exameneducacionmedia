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
        factory(\ExamenEducacionMedia\User::class, 1)->create()->each(function ($user) {
            $user->assignRole('aspirante');
            $user->aspirante()->save(factory(\Aspirante\Models\Aspirante::class)->make());

            $aspirante = $user->aspirante;

            $aspirante->informacionProcedencia()->associate(factory(\Aspirante\Models\InformacionProcedencia::class)->create())->save();
            $aspirante->domicilio()->associate(factory(\Aspirante\Models\Domicilio::class)->create())->save();

            for ($i = 0; $i < 10; $i++) {
                $aspirante->opcionesEducativas()->save(factory(\Aspirante\Models\Seleccion::class)->make([
                    'preferencia' => $i,
                ]));
            }
        });
    }
}
