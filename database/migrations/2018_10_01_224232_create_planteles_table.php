<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planteles', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')
                ->comment('uuid del centro de trabajo en la tabla centros_trabajo de la base de datos de centrostrabajo');
            $table->string('descripcion');
            $table->string('clave', 10);
            $table->string('cve_ent', 2)->nullable();
            $table->string('cve_mun', 3)->nullable();
            $table->string('cve_loc', 4)->nullable();
            $table->string('entidad')->nullable();
            $table->string('municipio')->nullable();
            $table->string('localidad')->nullable();
            $table->string('calle_principal')->nullable();
            $table->string('calle_derecha')->nullable();
            $table->string('calle_posterior')->nullable();
            $table->string('calle_izquierda')->nullable();
            $table->string('colonia')->nullable();
            $table->integer('codigo_postal')->nullable();
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->unsignedTinyInteger('subsistema_id')->nullable();
            $table->foreign('subsistema_id')->references('id')->on('subsistemas');
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id')->references('id')->on('users');
            $table->unsignedInteger('sede_ceneval')->nullable();
            $table->unsignedTinyInteger('descuento')->default(0);
            $table->string('pagina_web')->default('https://qroo.gob.mx/seq');
            $table->string('telefono', 30)->nullable();
            $table->unsignedTinyInteger('opciones')->default(0);
            $table->boolean('active')->default(0);

            $table->index('uuid');
            $table->index('cve_ent');
            $table->index('cve_mun');
            $table->index('cve_loc');
            $table->index('entidad');
            $table->index('municipio');
            $table->index('localidad');
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
        Schema::dropIfExists('planteles');
    }
}
