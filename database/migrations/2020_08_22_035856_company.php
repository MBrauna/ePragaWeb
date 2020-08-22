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
            $table->integer('id_responsible');
            $table->text('name');
            $table->string('initials',3);
            $table->dateTime('contract_start');
            $table->dateTime('contract_due')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->index(['id_responsible']);
            $table->index(['name']);
            $table->index(['initials']);
            $table->index(['contract_start']);
            $table->index(['contract_due']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('company');
    }
}
