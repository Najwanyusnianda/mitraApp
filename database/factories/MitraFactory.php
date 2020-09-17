<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mitra;
use Faker\Generator as Faker;

$factory->define(Mitra::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'phone'=>$faker->e164PhoneNumber
    ];
});
