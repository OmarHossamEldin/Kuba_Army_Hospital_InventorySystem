<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('input_id')->unsigned();
            $table->foreign('input_id')->references('id')->on('inputs');
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
        Schema::dropIfExists('input_details');
    }
}
