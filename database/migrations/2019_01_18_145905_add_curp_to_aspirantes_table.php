<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurpToAspirantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aspirantes', function (Blueprint $table) {
            $table->date('fecha_nacimiento')
                ->after('informacion_procedencia_id')
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
        Schema::table('aspirantes', function (Blueprint $table) {
            $table->dropColumn('fecha_nacimiento');
        });
    }
}
