<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Bus;
use Faker\Generator as Faker;

$factory->define(Bus::class, function (Faker $faker) {
    return [
        'bus_id' => 'EGY-' . $faker->numberBetween(100, 1000) 
    ];
});
