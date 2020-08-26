<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EpragaError extends Migration
{
    public function up()
    {
        Schema::create('epraga_error', function (Blueprint $table) {
            $table->increments('id_epraga_error');
            $table->integer('id_user');
            $table->text('json_data');
            $table->dateTime('insert_date');
            $table->boolean('status')->default(true);

            $table->index(['id_user']);
            $table->index(['json_data']);
            $table->index(['insert_date']);
            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('epraga_error');
    }
}
