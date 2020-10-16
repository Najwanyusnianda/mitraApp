<?php

use Illuminate\Database\Seeder;
use App\Kecamatan;
class KecamatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kode=['010','020','030','040','050'];
        $nama_kecamatan=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];

        foreach ($kode as $key => $code) {
            DB::table('kecamatans')->insert([
            'id' => $code,
            'nama_kecamatan' => $nama_kecamatan[$key],
            ]);
        }
    }
}
