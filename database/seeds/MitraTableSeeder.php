<?php

use Illuminate\Database\Seeder;
use App\Mitra;
class MitraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Mitra::class,20)->create();
    }
}
