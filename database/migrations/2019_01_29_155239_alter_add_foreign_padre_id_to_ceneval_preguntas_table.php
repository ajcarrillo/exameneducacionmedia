<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddForeignPadreIdToCenevalPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ceneval_preguntas', function (Blueprint $table) {
            $table->foreign('padre_id')->references('id')->on('ceneval_preguntas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ceneval_preguntas', function (Blueprint $table) {
            $table->dropForeign(['padre_id']);
        });
    }
}
