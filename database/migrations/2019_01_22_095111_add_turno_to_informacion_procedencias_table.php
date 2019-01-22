<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTurnoToInformacionProcedenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informacion_procedencias', function (Blueprint $table) {
            $table->tinyInteger('turno_id')
                ->after('nombre_centro_trabajo')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informacion_procedencias', function (Blueprint $table) {
            $table->dropColumn('turno_id');
        });
    }
}
