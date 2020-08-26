<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->text('cpf_cnpj')->unique();
            $table->boolean('mobile_access')->default(false);
            $table->boolean('website_access')->default(false);
            $table->dateTime('last_login')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('mobile_device')->nullable(); // Corresponderá ao IMEI do aparelho, permitirá acessar apenas com um aparelho. (regra de negócio)
            $table->text('api_token')->unique()->nullable()->default(null);
            $table->dateTime('api_expiring')->nullable();
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
