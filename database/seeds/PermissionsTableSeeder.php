<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'guardar.planteles',
            'editar.planteles',
            'eliminar.planteles',
            'desactivar.planteles',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create([ 'name' => $permission ]);
        }
    }
}
