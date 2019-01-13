<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertaEducativaGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oferta_educativa_grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('grupos');
            $table->unsignedInteger('alumnos');
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
        Schema::dropIfExists('oferta_educativa_grupos');
    }
}
