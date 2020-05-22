<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->uuid('seat_uuid')->unique();
            $table->uuid('reservation_id')->unique()->nullable();
            
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('check_in_at')->nullable();
            $table->unsignedBigInteger('check_out_at')->nullable();
            
            $table->enum('status', ['free', 'reservation-in-progress', 'reserved'])->default('free');
            $table->enum('reserved_from', ['begin_of_the_trip', 'specific_station'])->default('begin_of_the_trip')->nullable();
            $table->enum('reserved_untill', ['last_of_the_trip', 'specific_station'])->default('last_of_the_trip')->nullable();

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
        Schema::dropIfExists('seats');
    }
}
