<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchuduleItem extends Migration
{
    public function up()
    {
        Schema::create('schudule_item', function (Blueprint $table) {
            $table->increments('id_schudule_item');
            $table->integer('id_schudule');

            // Dados do que realizar
            $table->text('description');
            $table->boolean('visit')->default(false);
            $table->boolean('pest_control')->default(true);
            $table->integer('id_prague')->nullable();
            $table->integer('id_treatment')->nullable();

            // Dados do evento
            $table->integer('sequence')->default(999);
            $table->double('latitude',11,8)->default(999);
            $table->double('longitude',11,8)->default(999);
            $table->integer('quantity_images')->default(1);
            $table->dateTime('last_alt_at')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('note')->nullable();
            $table->boolean('accept')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->index(['visit']);
            $table->index(['pest_control']);
            $table->index(['id_prague']);
            $table->index(['id_treatment']);
            $table->index(['sequence']);
            $table->index(['quantity_images']);
            $table->index(['start_date']);
            $table->index(['end_date']);
            $table->index(['accept']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('schudule_item');
    }
}
