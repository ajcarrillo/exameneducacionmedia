<?php

use Illuminate\Database\Seeder;

class OfertaEducativaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Subsistema\Models\OfertaEducativa::class, 100)->create();
    }
}
