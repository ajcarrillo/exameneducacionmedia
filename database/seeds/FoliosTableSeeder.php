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
        for ($i = 300000000; $i < 300000100; $i++) {
            $folio = new \ExamenEducacionMedia\Modules\MediaSuperior\Models\Folio([
                'folio'  => $i,
                'active' => true,
            ]);
            $folio->save();
        }
    }
}
