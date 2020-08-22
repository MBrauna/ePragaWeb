<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Guide extends Migration
{
    public function up()
    {
        Schema::create('guide', function (Blueprint $table) {
            $table->increments('id_guide');
            $table->text('title');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['title']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('guide');
    }
}
