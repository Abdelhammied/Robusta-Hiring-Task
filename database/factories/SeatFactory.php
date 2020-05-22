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
    $reserved_from = ['begin_of_the_trip', 'specific_station'][rand(0, 1)];
    $bus = Bus::get()->random();
    $trip = Trip::get()->random();
    $user = User::get()->random();
    $station = Station::get()->random();

    return [
        'seat_uuid' => $faker->uuid,
        'reservation_id' => $status == 'free' ? null : $faker->uuid,
        'bus_id' => $bus->id,
        'trip_id' => $trip->id,
        'user_id' => $status == 'free' ? null : $user->id,
        'check_in_at' =>  $status == 'free' ? null : ($reserved_from == 'specific_station' ? $station : $trip->from_station_id),
        'check_out_at' =>  $status == 'free' ? null : ($reserved_untill == 'specific_station' ? $station : $trip->to_station_id),
        'status' => $status,
        'reserved_from' => $reserved_from,
        'reserved_untill' => $reserved_untill,
    ];
});
