<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipiosViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios_view', function (Blueprint $table) {
            $table->string('CVE_ENT', 2)->index();
            $table->string('NOM_ENT');
            $table->string('CVE_MUN', 3)->index();
            $table->string('NOM_MUN');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios_view');
    }
}
