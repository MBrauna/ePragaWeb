<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Message extends Migration
{
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id_message');

            // Dados do que realizar
            $table->text('title');
            $table->text('description');
            $table->integer('id_user')->nullable(); // Se nulo irá enviar a todos os usuários
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable(); // Se nulo irá apresentar de modo indefinido
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->index(['title']);
            $table->index(['id_user']);
            $table->index(['start_date']);
            $table->index(['end_date']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('message');
    }
}
