<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasesExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pases_examen', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('numero_lista');
            $table->boolean('automatico')->default(1);
            $table->unsignedInteger('aspirante_id')->unique();
            $table->foreign('aspirante_id')->references('id')->on('aspirantes');
            $table->unsignedInteger('aula_id');
            $table->foreign('aula_id')->references('id')->on('aulas');
            $table->unique([ 'aula_id', 'numero_lista' ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pases_examen');
    }
}
