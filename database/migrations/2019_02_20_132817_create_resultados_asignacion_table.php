<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadosAsignacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados_asignacion', function (Blueprint $table) {
            $table->unsignedInteger('folio')->primary();
            $table->foreign('folio')->references('folio')->on('aspirantes');
            $table->string('opc_ed01', 5)->nullable();
            $table->string('opc_ed02', 5)->nullable();
            $table->string('opc_ed03', 5)->nullable();
            $table->string('opc_ed04', 5)->nullable();
            $table->string('opc_ed05', 5)->nullable();
            $table->string('opc_ed06', 5)->nullable();
            $table->string('opc_ed07', 5)->nullable();
            $table->string('opc_ed08', 5)->nullable();
            $table->string('opc_ed09', 5)->nullable();
            $table->string('opc_ed10', 5)->nullable();
            $table->string('expl_asi', 5)->nullable();
            $table->integer('nsel', 5)->nullable();
            $table->integer('nopc_asi')->nullable();
            $table->integer('copc_asi')->nullable();
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
        Schema::dropIfExists('resultados_asignacion');
    }
}
