<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutputDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('output_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('output_id')->unsigned();
            $table->foreign('output_id')->references('id')->on('outputs');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('output_details');
    }
}
