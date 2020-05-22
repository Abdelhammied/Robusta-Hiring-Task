<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Seat;
use App\Models\Trip;
use App\Models\Station;
use Faker\Generator as Faker;

$factory->define(Trip::class, function (Faker $faker) {
    return [
        'from_station_id' => Station::get()->random()->id,
        'to_station_id' => Station::get()->random()->id,
    ];
});

$factory->afterCreating(Trip::class, function ($trip) {
    $seats = factory(Seat::class, 12)->make();

    foreach ($seats as $seat) {
        $trip->seats()->save($seat);    
    }
});
