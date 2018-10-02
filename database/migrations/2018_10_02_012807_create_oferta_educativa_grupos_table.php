<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedTinyInteger('semestre')->default(1);
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
