<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EPragaDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product',function(Blueprint $table){
            $table->increments('id_category_product');
            $table->text('description');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['description']);
            $table->index(['status']);
        }); // Schema::create('product',function(Blueprint $table){ ... }


        Schema::create('product',function(Blueprint $table){
            $table->increments('id_product');
            $table->text('description');
            $table->integer('id_category_product')->nullable();
            $table->double('quantity',12,2)->default(0);
            $table->text('measure')->default('kg');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['description']);
            $table->index(['id_category_product']);
            $table->index(['quantity']);
            $table->index(['measure']);
            $table->index(['status']);

            $table->foreign('id_category_product')->references('id_category_product')->on('category_product');
        }); // Schema::create('product',function(Blueprint $table){ ... }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
