<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('postcode');
            $table->string('openMonday')->default('');
            $table->string('openTuesday')->default('');
            $table->string('openWednesday')->default('');
            $table->string('openThursday')->default('');
            $table->string('openFriday')->default('');
            $table->string('openSaturday')->default('');
            $table->string('openSunday')->default('');
            $table->string('closeMonday')->default('');
            $table->string('closeTuesday')->default('');
            $table->string('closeWednesday')->default('');
            $table->string('closeThursday')->default('');
            $table->string('closeFriday')->default('');
            $table->string('closeSaturday')->default('');
            $table->string('closeSunday')->default('');
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
        Schema::dropIfExists('location');
    }
}
