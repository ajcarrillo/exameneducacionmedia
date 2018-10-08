<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->string('nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('nombre_completo', 765);
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('api_token', 60)->unique();
            $table->string('session_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
