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
        $subsistema = \Subsistema\Models\Subsistema::find(1);
        $revision = new \Subsistema\Models\RevisionOferta();
        $revision->subsistema()->associate($subsistema)->save();
        $review = new \MediaSuperior\Models\Revision(
            [
                'fecha_apertura' => \Carbon\Carbon::now(),
                'estado'    => 'R',
                'comentario' => 'blabla',
                'usuario_apertura' => '1',
                'usuario_revision' => '1',
            ]
        );
        $revision->review()->save($review);
    }
}
