<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company extends Migration
{
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id_company');
            // Dados da companhia
            $table->integer('id_responsible')->nullable();
            $table->text('name');
            $table->text('fantasy_name')->nullable();
            $table->integer('type_person')->comment('[1] - Pessoa Física, [2] - Pessoa Jurídica')->default(1);
            $table->string('initials',3);
            $table->text('state_registration')->nullable();
            $table->text('municipal_registration')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->index(['id_responsible']);
            $table->index(['name']);
            $table->index(['fantasy_name']);
            $table->index(['type_person']);
            $table->index(['initials']);
            $table->index(['state_registration']);
            $table->index(['municipal_registration']);
            $table->index(['status']);
        });

        Schema::create('company_phone', function (Blueprint $table) {
            $table->increments('id_company_phone');
            $table->integer('id_company');
            $table->integer('ddd')->nullable();
            $table->integer('phone')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->index(['ddd']);
            $table->index(['phone']);
            $table->index(['status']);

            $table->foreign('id_company')->references('id_company')->on('company');
        });

        Schema::create('company_address', function (Blueprint $table) {
            $table->increments('id_company_address');
            $table->integer('id_company');
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

            $table->foreign('id_company')->references('id_company')->on('company');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company');
        Schema::dropIfExists('company_phone');
        Schema::dropIfExists('company_address');
    }
}
