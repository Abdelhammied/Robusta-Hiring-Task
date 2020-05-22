<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bus;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Seat::class, function (Faker $faker) {
    $status = ['free', 'reservation-in-progress', 'reserved'][rand(0, 2)];
    $reserved_untill = ['last_of_the_trip', 'specific_station'][rand(0, 1)];
    $bus = Bus::get()->random();
    $trip = Trip::get()->random();
    $user = User::get()->random();
    $station = Station::get()->random();

    return [
        'seat_uid' => $faker->uuid,
        'reservation_id' => $status == 'free' ? null : $faker->uuid,
        'bus_id' => $bus->id,
        'trip_id' => $trip->id,
        'user_id' => $status == 'free' ? null : $user->id,
        'drop_of_at' => $reserved_untill == 'specific_station' ? $station : null,
        'status' => $status,
        'reserved_untill' => $reserved_untill,
    ];
});
