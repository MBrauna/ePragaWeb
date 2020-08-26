<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Image extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id_images');
            $table->integer('id_schudule_item');

            // Dados do que realizar
            $table->text('base64');
            $table->double('latitude',11,8);
            $table->double('longitude',11,8);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['id_schudule_item']);
            $table->index(['latitude']);
            $table->index(['longitude']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
