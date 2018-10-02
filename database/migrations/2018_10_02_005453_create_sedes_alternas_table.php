<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesAlternasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes_alternas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->unsignedInteger('sede_ceneval');
            $table->unsignedInteger('domicilio_id');
            $table->foreign('domicilio_id')->references('id')->on('domicilios');
            $table->unsignedInteger('plantel_id');
            $table->foreign('plantel_id')->references('id')->on('planteles');
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
        Schema::dropIfExists('sedes_alternas');
    }
}
