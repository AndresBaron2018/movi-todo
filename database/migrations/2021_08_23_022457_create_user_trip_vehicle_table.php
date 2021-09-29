<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTripVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trip_vehicle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('trip_id')->unsigned();
            $table->foreign('trip_id')->references('id')->on('trips');
            $table->integer('vehicle_id')->unsigned();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
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
        Schema::dropIfExists('user_trip_vehicle');
    }
}
