<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Treatment extends Migration
{
    public function up()
    {
        Schema::create('treatment', function (Blueprint $table) {
            $table->increments('id_treatment');
            $table->text('name');
            $table->text('description')->nullable();
            $table->integer('id_prague')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['name']);
            $table->index(['id_prague']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('treatment');
    }
}
