<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mitra;
use Faker\Generator as Faker;

$factory->define(Mitra::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'phone'=>$faker->e164PhoneNumber,
        'tanggal_lahir'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'nik'=>$faker->unique()->numerify('##################'),
        'pekerjaan'=>$faker->jobTitle,
        'pengalaman'=>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'is_gadget'=>1,
        'is_kendaraan'=>1,
        'email'=>$faker->email,
        'jenis_kelamin'=>$faker->randomElement($array = array ('Laki-laki','Perempuan')),
        'is_kawin'=>$faker->randomElement($array = array ('Belum Kawin','Kawin')),
        'alamat'=>$faker->address,
        'pendidikan'=>$faker->company,
        'npwp'=>$faker->unique()->numerify('#-####-####-########'),
        'nomor_rekening'=>$faker->creditCardNumber,
        'agama'=>'islam',
        'kecamatan'=>$faker->randomElement($array = array ('010','020','030','040','050'))       
    ];
});
