<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacionProcedenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_procedencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave_centro_trabajo')->nullable();
            $table->text('nombre_centro_trabajo')->nullable();
            $table->year('fecha_egreso')->nullable();
            $table->boolean('primera_vez')->default(1);
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
        Schema::dropIfExists('informacion_procedencias');
    }
}
