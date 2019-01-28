<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'supermario',
            'cordinador',
            'departamento',
            'subsistema',
            'plantel',
            'aspirante',
            'invitado',
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create([ 'name' => $role ]);
        }
    }
}
