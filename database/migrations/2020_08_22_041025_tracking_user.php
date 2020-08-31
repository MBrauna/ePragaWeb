<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrackingUser extends Migration
{
    public function up()
    {
        Schema::create('tracking_user', function (Blueprint $table) {
            $table->increments('id_tracking_user');
            $table->integer('id_user');
            $table->dateTime('tracking_date');
            $table->double('latitude',11,8)->nullable();
            $table->double('longitude',11,8)->nullable();
            $table->timestamps();

            $table->index(['id_user']);
            $table->index(['tracking_date']);
            $table->index(['latitude','longitude']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tracking_user');
    }
}
