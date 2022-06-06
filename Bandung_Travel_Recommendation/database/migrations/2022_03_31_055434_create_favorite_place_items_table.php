<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_place_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('favorite_id')->unsigned();
            $table->integer('place_id')->unsigned();

            $table->foreign('favorite_id')->references('id')->on('favorites');
            $table->foreign('place_id')->references('id')->on('places');
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
        Schema::dropIfExists('favorite_place_items');
    }
};
