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
            $table->increments('id')
                ->comment('id del centro de trabajo en la tabla centros_trabajo de la base de datos de centrostrabajo');
            $table->unsignedInteger('uuid')
                ->comment('uuid del centro de trabajo en la tabla centros_trabajo de la base de datos de centrostrabajo');
            $table->string('descripcion');
            $table->string('clave', 10);
            $table->string('cve_ent', 2);
            $table->string('cve_mun', 3);
            $table->string('cve_loc', 4);
            $table->string('entidad');
            $table->string('municipio');
            $table->string('localidad');
            $table->string('calle_principal')->nullable();
            $table->string('calle_derecha')->nullable();
            $table->string('calle_posterior')->nullable();
            $table->string('calle_izquierda')->nullable();
            $table->string('colonia')->nullable();
            $table->integer('codigo_postal')->nullable();
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->unsignedInteger('subsistema_id');
            $table->string('subsistema');
            $table->unsignedInteger('sede_ceneval')->nullable();
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id')->references('id')->on('users');
            $table->unsignedTinyInteger('descuento')->default(0);
            $table->string('pagina_web')->default('https://qroo.gob.mx/seq');
            $table->string('telefono', 30)->nullable();
            $table->boolean('active')->default(0);

            $table->index('uuid');
            $table->index('cve_ent');
            $table->index('cve_mun');
            $table->index('cve_loc');
            $table->index('entidad');
            $table->index('municipio');
            $table->index('localidad');
            $table->index('subsistema_id');
            $table->index('subsistema');
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
