<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeyAjastes extends Migration
{
    public function up()
    {
        Schema::table('company',function(Blueprint $table){
            $table->foreign('id_responsible')->references('id')->on('users');
        });

        Schema::table('subsidiary',function(Blueprint $table){
            $table->foreign('id_company')->references('id_company')->on('company');
        });

        Schema::table('treatment',function(Blueprint $table){
            $table->foreign('id_prague')->references('id_prague')->on('prague');
        });

        Schema::table('schudule',function(Blueprint $table){
            $table->foreign('id_subsidiary')->references('id_subsidiary')->on('subsidiary');
        });

        Schema::table('schudule_item',function(Blueprint $table){
            $table->foreign('id_schudule')->references('id_schudule')->on('schudule');
            $table->foreign('id_prague')->references('id_prague')->on('prague');
            $table->foreign('id_treatment')->references('id_treatment')->on('treatment');
        });

        Schema::table('message',function(Blueprint $table){
            $table->foreign('id_user')->references('id')->on('users');
        });

        Schema::table('tracking_user',function(Blueprint $table){
            $table->foreign('id_user')->references('id')->on('users');
        });

        Schema::table('periodic_schudule',function(Blueprint $table){
            $table->foreign('id_subsidiary')->references('id_subsidiary')->on('subsidiary');
            $table->foreign('id_responsible')->references('id')->on('users');
        });

        Schema::table('periodic_schudule_item',function(Blueprint $table){
            $table->foreign('id_prague')->references('id_prague')->on('prague');
            $table->foreign('id_treatment')->references('id_treatment')->on('treatment');
        });

        Schema::table('epraga_error',function(Blueprint $table){
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    public function down()
    {
        //
    }
}
