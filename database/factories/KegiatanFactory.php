<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Kegiatan;
use Faker\Generator as Faker;

$factory->define(Kegiatan::class, function (Faker $faker) {
    return [
        //
        'nama_kegiatan'=>'kegiatan'.$faker->name,
        'tahun'=>$faker->year($max = 'now'),
        'deskripsi'=>$faker->text
    ];
});
