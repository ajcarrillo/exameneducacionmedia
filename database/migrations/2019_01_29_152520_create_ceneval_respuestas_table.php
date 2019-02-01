<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenevalRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceneval_respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valor', 4);
            $table->string('etiqueta', 250);
            $table->unsignedInteger('diccionario_id');
            $table->timestamps();

            $table->foreign('diccionario_id')->references('id')->on('ceneval_diccionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ceneval_respuestas');
    }
}
