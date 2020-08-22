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
            $table->double('latitude',11,8);
            $table->double('longitude',11,8);
            $table->timestamps();


            $table->index(['id_company']);
            $table->index(['name']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('subsidiary');
    }
}
