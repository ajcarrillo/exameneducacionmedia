<?php

use Illuminate\Database\Seeder;

class FoliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 100; $i++) {
            $folio = new \ExamenEducacionMedia\Modules\MediaSuperior\Models\Folio([
                'folio'  => str_pad($i, '10', '0', STR_PAD_LEFT),
                'active' => true,
            ]);
            $folio->save();
        }
    }
}
