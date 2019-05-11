<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapbrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capbrand', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('Ristretto');
            $table->integer('Espresso');
            $table->integer('Lungo');
            $table->decimal('Ristretto_price');
            $table->decimal('Espresso_price');
            $table->decimal('Lungo_price');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('location_id')->references('id')->on('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capbrand');
    }
}
