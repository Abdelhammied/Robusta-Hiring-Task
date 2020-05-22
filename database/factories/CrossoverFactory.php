<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CrossOver;
use App\Models\Station;
use App\Models\Trip;
use Faker\Generator as Faker;

$factory->define(CrossOver::class, function (Faker $faker) {
    return [
        'trip_id' => Trip::get()->random()->id,
        'station_id' => Station::get()->random()->id,
    ];
});
