<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeleccionOfertasEducativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seleccion_ofertas_educativas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('preferencia');
            $table->unsignedInteger('aspirante_id');
            $table->foreign('aspirante_id')->references('id')->on('aspirantes');
            $table->unsignedInteger('oferta_educativa_id');
            $table->foreign('oferta_educativa_id')->references('id')->on('ofertas_educativas');
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
        Schema::dropIfExists('seleccion_ofertas_educativas');
    }
}
