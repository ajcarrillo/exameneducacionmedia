<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAspirantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aspirantes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('alumno_id')->nullable()->comment('Id de la base de alumnos o en su caso de control escolar');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('telefono', 30)->nullable();
            $table->string('sexo', 1)->nullable();
            $table->unsignedInteger('folio')->nullable();
            $table->string('pais_nacimiento_id', 2)->nullable();
            $table->string('entidad_nacimiento_id', 2)->nullable();
            $table->unsignedInteger('domicilio_id')->nullable();
            $table->foreign('domicilio_id')->references('id')->on('domicilios');
            $table->unsignedInteger('informacion_procedencia_id')->nullable();
            $table->foreign('informacion_procedencia_id')->references('id')->on('informacion_procedencias');

            $table->index('sexo');
            $table->index('folio');
            $table->index('pais_nacimiento_id');
            $table->index('entidad_nacimiento_id');

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
        Schema::dropIfExists('aspirantes');
    }
}
