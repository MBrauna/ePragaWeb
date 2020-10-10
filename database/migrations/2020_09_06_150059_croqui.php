<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Croqui extends Migration
{
    public function up()
    {
        Schema::table('subsidiary',function(Blueprint $table){
            $table->text('croqui_base64')->nullable();
        });
    }

    public function down()
    {
        //
    }
}
