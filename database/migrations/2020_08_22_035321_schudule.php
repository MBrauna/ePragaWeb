<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Schudule extends Migration
{
    public function up()
    {
        Schema::create('schudule', function (Blueprint $table) {
            $table->increments('id_schudule');
            $table->text('description');
            $table->integer('id_subsidiary');
            $table->dateTime('last_alt_at')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['id_subsidiary']);
            $table->index(['start_date']);
            $table->index(['end_date']);
            $table->index(['start_date','end_date']);
        });


        Schema::create('schudule_responsible',function(Blueprint $table){
            $table->increments('id_schudule_responsible');
            $table->integer('id_schudule');
            $table->integer('id_user');
            $table->timestamps();

            $table->index(['id_schudule']);
            $table->index(['id_user']);
            $table->foreign('id_schudule')->references('id_schudule')->on('schudule');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schudule');
    }
}
