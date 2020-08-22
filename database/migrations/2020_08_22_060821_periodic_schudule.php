<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PeriodicSchudule extends Migration
{
    public function up()
    {
        Schema::create('periodic_schudule', function (Blueprint $table) {
            $table->increments('id_periodic_schudule');
            $table->integer('periodic'); // [1] - Diário, [2] - Semanal, [3] - Quinzenal, [4] - Mensal, [5] - Bimestral, [6] - Trimestral, [7] - Semestral, [8] - Anual
            $table->dateTime('first_schudule');
            $table->dateTime('next_schudule');
            $table->boolean('status')->default(true);

            // Dados que irão gerar o schudule
            $table->text('description');
            $table->integer('id_subsidiary');
            $table->integer('id_responsible')->nullable(); // Quem irá atender, se nulo aparecerá para todos.
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();

            $table->index(['periodic']);
            $table->index(['first_schudule']);
            $table->index(['next_schudule']);
            $table->index(['status']);
            $table->index(['id_subsidiary']);
            $table->index(['id_responsible']);
            $table->index(['start_date']);
            $table->index(['end_date']);
            $table->index(['start_date','end_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('periodic_schudule');
    }
}
