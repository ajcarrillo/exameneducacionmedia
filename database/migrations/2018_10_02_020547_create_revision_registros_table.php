<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_registros', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('aspirante_id')->unique();
            $table->foreign('aspirante_id')->references('id')->on('aspirantes');
            $table->unsignedInteger('solicitud_pago')->unique();
            $table->boolean('efectuado')->default(0);
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
        Schema::dropIfExists('revision_registros');
    }
}
