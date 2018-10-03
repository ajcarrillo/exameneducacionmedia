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
            $table->unsignedInteger('centro_trabajo_id')->nullable()->comment('Id del centro de trabajo de la base de datos de centros de trabajo o bien de estadistica');
            $table->string('descripcion');
            $table->string('cct', 10);
            $table->string('referencia')->nullable();
            $table->unsignedTinyInteger('nivel_demanda_id')->nullable();
            $table->foreign('nivel_demanda_id')->references('id')->on('niveles_demanda');
            $table->unsignedInteger('sede_ceneval')->nullable();
            $table->unsignedInteger('domicilio_id')->nullable();
            $table->foreign('domicilio_id')->references('id')->on('domicilios');
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id')->references('id')->on('users');
            $table->unsignedTinyInteger('subsistema_id');
            $table->foreign('subsistema_id')->references('id')->on('subsistemas');
            $table->unsignedTinyInteger('descuento')->default(0);
            $table->string('pagina_web')->default('https://qroo.gob.mx/seq');
            $table->string('telefono', 30)->nullable();
            $table->boolean('active')->default(0);
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
