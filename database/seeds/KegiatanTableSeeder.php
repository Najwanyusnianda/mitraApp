<?php

use Illuminate\Database\Seeder;
use App\Kegiatan;

class KegiatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Kegiatan::class,20)->create();
    }
}
