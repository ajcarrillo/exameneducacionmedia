<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasEducativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas_educativas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('plantel_id');
            $table->foreign('plantel_id')->references('id')->on('planteles');
            $table->unsignedInteger('especialidad_id');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->boolean('active')->default(1);
            $table->string('clave', 15);
            $table->unsignedSmallInteger('programa_estudio_id');
            $table->foreign('programa_estudio_id')->references('id')->on('programas_estudio');
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
        Schema::dropIfExists('ofertas_educativas');
    }
}
