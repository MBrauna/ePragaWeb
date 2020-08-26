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
            $table->integer('id_responsible')->nullable(); // Quem irá atender, se nulo aparecerá para todos.
            $table->dateTime('last_alt_at')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['id_subsidiary']);
            $table->index(['id_responsible']);
            $table->index(['start_date']);
            $table->index(['end_date']);
            $table->index(['start_date','end_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('schudule');
    }
}
