<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_ofertas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('subsistema_id');
            $table->foreign('subsistema_id')->references('id')->on('subsistemas');
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
        Schema::dropIfExists('revision_ofertas');
    }
}
