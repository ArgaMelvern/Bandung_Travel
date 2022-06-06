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
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('type_place_id')->unsigned();
            $table->float('rate', 4, 2)->default(0.0)->nullable();
            $table->text('description')->nullable();
            $table->text('image_name')->nullable();
            $table->text('alamat');
            $table->string('latitude', 100);
            $table->string('longitude', 100);

            $table->foreign('type_place_id')->references('id')->on('place_types');
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
        Schema::dropIfExists('places');
    }
};
