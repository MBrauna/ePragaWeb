<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subsidiary extends Migration
{
    public function up()
    {
        Schema::create('subsidiary', function (Blueprint $table) {
            $table->increments('id_subsidiary');
            $table->integer('id_company');
            $table->text('name');
            $table->text('description');
            $table->boolean('status')->default(false);
            // Localização da subsidiária
            $table->text('address')->default('Endereço não definido! Utilize o GPS.');
            $table->double('latitude',11,8)->nullable();
            $table->double('longitude',11,8)->nullable();
            $table->timestamps();


            $table->index(['id_company']);
            $table->index(['name']);
            $table->index(['status']);
        });

        Schema::create('subsidiary_phone', function (Blueprint $table) {
            $table->increments('id_subsidiary_phone');
            $table->integer('id_subsidiary');
            $table->integer('ddd')->nullable();
            $table->integer('phone')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->index(['ddd']);
            $table->index(['phone']);
            $table->index(['status']);

            $table->foreign('id_subsidiary')->references('id_subsidiary')->on('subsidiary');
        });

        Schema::create('subsidiary_address', function (Blueprint $table) {
            $table->increments('id_subsidiary_address');
            $table->integer('id_subsidiary');
            $table->text('address')->default('Não identificado');
            $table->integer('number')->nullable();
            $table->text('complement')->nullable();
            $table->text('district')->nullable();
            $table->text('city')->nullable();
            $table->text('uf')->nullable();
            $table->integer('cep')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->index(['address']);
            $table->index(['number']);
            $table->index(['complement']);
            $table->index(['district']);
            $table->index(['city']);
            $table->index(['uf']);
            $table->index(['cep']);
            $table->index(['status']);

            $table->foreign('id_subsidiary')->references('id_subsidiary')->on('subsidiary');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subsidiary');
        Schema::dropIfExists('subsidiary_phone');
        Schema::dropIfExists('subsidiary_address');
    }
}
