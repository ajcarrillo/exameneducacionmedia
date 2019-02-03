<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('revision');
            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_revision')->nullable();
            $table->enum('estado', [ 'C', 'A', 'R' ]);
            $table->text('comentario')->nullable();
            $table->unsignedInteger('usuario_apertura');
            $table->foreign('usuario_apertura')->references('id')->on('users');
            $table->unsignedInteger('usuario_revision')->nullable();
            $table->foreign('usuario_revision')->references('id')->on('users');
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
        Schema::dropIfExists('revisiones');
    }
}
