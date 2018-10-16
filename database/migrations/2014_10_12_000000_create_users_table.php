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
            $table->string('nombre_completo', 765);
            $table->string('email');
            $table->string('username');
            $table->string('password')->nullable();
            $table->string('api_token', 60)->unique();
            $table->string('session_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('active')->default(1);
            $table->string('provider_id')->nullable()->comment('Uuid de la tabla users de la base de datos de jarvis');
            $table->string('provider')->nullable();
            $table->text('jarvis_user_access_token')->nullable();
            $table->string('jarvis_user_token_type')->nullable();
            $table->integer('jarvis_user_token_expires_in')->nullable();
            $table->text('jarvis_user_refresh_token')->nullable();
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
