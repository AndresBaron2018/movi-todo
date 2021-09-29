<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('general_load');
            $table->date('date');
            $table->string('vehicle');
            $table->string('tour_driver');
            $table->double('money_advance');
            $table->double('tons');
            $table->double('feeding');
            $table->double('Toll');
            $table->double('fuel');
            $table->double('other');
            $table->integer('driver');
            $table->foreign('driver')->references('id')->on('users');
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
        Schema::dropIfExists('trips');
    }
}
