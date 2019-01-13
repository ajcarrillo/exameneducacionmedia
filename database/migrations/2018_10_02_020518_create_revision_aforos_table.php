<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionAforosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_aforos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subsistema_id');
            $table->foreign('subsistema_id')->references('id')->on('centrostrabajo.subsistemas');
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
        Schema::dropIfExists('revision_aforos');
    }
}
