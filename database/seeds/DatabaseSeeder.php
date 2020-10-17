<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(MitraTableSeeder::class);
        $this->call(MasterKegiatanTableSeeder::class);
        $this->call(KecamatanTableSeeder::class);
        //$this->call(KegiatanTableSeeder::class);
    }
}
