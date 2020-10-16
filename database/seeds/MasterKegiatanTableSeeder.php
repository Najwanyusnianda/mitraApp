<?php

use Illuminate\Database\Seeder;

class MasterKegiatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $neraca=['Survei Khusus Konsumsi Rumah Tangga (SKKRT) Triwulan',
        'Survei Khusus Lembaga Non Profit Melayani RUmah Tangga (SKLNPRT) Triwulan',
        'Updating Direktori LNPRT', 'Survei Matrik PMTB','Survei Khusus Studi Penyusunan Perubahan Inventori (SKSPPI)',
        'Survei Matriks Arus Komoditas (SMAK)'];

        $sosial=['Survei Angkatan Kerja Nasional Semesteran','Survei Angkatan Kerja Nasional Tahunan',
        'Survei Ekonomi Nasional Maret','Survei Ekonomi Nasional September','Survei Politik dan Keamanan (POLKAM)',
        'Updating Potensi Desa (PODES)', 'Sensus Penduduk 2020'];


        $ipds=['Pos Enumeration Survei Sensus Penduduk 2020', 'Survei Kebutuhan Data ',
        'Survei Metadata Kegiatan Statistik Sektoral'];

        $distribusi=[
            'Pendataan IKK','Pendataan SHPB','Pendataan VHT-S','Pendataan AJR II/2/II, AJR II/3 dan PJ II/5',
            'Pendataan VHT-L Tahunan', 'Pendataan APBD-2','Pendataan K3','Pendataan Koperasi',
        'Pendataan BOQ', 'Pendataan K2','PAW','STKU','Survei PDTW','WISNUS','Updating KBLI47','Updating Direktori Pasar'];

        $produksi=[
            'Survei Peternakan RPH/TPH','IBS Bulanan','IBS Tahunan','IMK Tahunan','Survei PE dan CP',
            'Survei Konstruksi','Survei Ubinan','Survei Hortikultura','Survei KSA Padi - Jagung'
        ];

    }
}
