<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyAjuste extends Migration
{
    public function up()
    {
        Schema::table('company',function(Blueprint $table){
            $table->integer('id_responsible')->nullable()->change();
        });
    }

    public function down()
    {
        //
    }
}
