<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAspiranteCuestionarioDeContextoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aspirante_cuestionario_de_contexto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('aspirante_id');
            $table->unsignedInteger('pregunta_id');
            $table->unsignedInteger('respuesta_id');
            $table->timestamps();

            $table->foreign('aspirante_id')->references('id')->on('aspirantes');
            $table->foreign('pregunta_id')->references('id')->on('ceneval_preguntas');
            $table->foreign('respuesta_id')->references('id')->on('ceneval_respuestas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aspirante_cuestionario_de_contexto');
    }
}
