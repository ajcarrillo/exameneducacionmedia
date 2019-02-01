<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenevalPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceneval_preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('variable', 20)->nullable();
            $table->unsignedInteger('diccionario_id')->nullable();
            $table->unsignedInteger('padre_id')->nullable();
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
        Schema::dropIfExists('ceneval_preguntas');
    }
}
