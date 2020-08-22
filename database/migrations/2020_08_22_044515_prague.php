<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prague extends Migration
{
    public function up()
    {
        Schema::create('prague', function (Blueprint $table) {
            $table->increments('id_prague');
            $table->text('name');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['name']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('prague');
    }
}
