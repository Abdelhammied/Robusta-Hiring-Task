<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $blueprint) {
            $blueprint->foreign('from_station_id')->references('id')->on('stations');
            $blueprint->foreign('to_station_id')->references('id')->on('stations');
        });

        Schema::table('cross_overs', function (Blueprint $blueprint) {
            $blueprint->foreign('station_id')->references('id')->on('stations');
            $blueprint->foreign('trip_id')->references('id')->on('trips');
        });

        Schema::table('seats', function (Blueprint $blueprint) {
            $blueprint->foreign('bus_id')->references('id')->on('buses');
            $blueprint->foreign('trip_id')->references('id')->on('trips');
            $blueprint->foreign('check_in_at')->references('id')->on('stations');
            $blueprint->foreign('check_out_at')->references('id')->on('stations');
            $blueprint->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
