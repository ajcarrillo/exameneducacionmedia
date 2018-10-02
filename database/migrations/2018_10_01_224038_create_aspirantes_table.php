<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('telefono', 30)->nullable();
            $table->string('sexo', 1);
            $table->unsignedInteger('folio');
            $table->string('pais_nacimiento_id', 2);
            $table->string('entidad_nacimiento_id', 2)->nullable();
            $table->unsignedInteger('domicilio_id');
            $table->foreign('domicilio_id')->references('id')->on('domicilios');
            $table->unsignedInteger('informacion_procedencia');
            $table->foreign('informacion_procedencia')->references('id')->on('informacion_procedencias');

            $table->index('sexo');
            $table->index('folio');
            $table->index('pais_nacimiento_id');
            $table->index('entidad_nacimiento_id', 2);

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
