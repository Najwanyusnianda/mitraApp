<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use App\Kegiatan;
use App\Mitra;
use App\KegiatanMitra;


class DashboardPenilaian extends Component
{

    public function render()
    {
        $kegiatan=Kegiatan::latest()->first();
        if(!empty($kegiatan)){
        $avg_kecamatan=DB::table('kegiatan_mitras')
        ->where('kegiatan_mitras.kegiatan_id',$kegiatan->id)
        ->join('mitras','kegiatan_mitras.mitra_id','=','mitras.id')
    ->groupBy('mitras.kecamatan')
        ->select('mitras.kecamatan', DB::raw('AVG(kegiatan_mitras.total_nilai) as avg'))
        //->selectRaw('mitras.kecamatan AS mitraz','sum(kegiatan_mitras.total_nilai)')
        ->get();

        $avg_kab=DB::table('kegiatan_mitras')
        ->where('kegiatan_mitras.kegiatan_id',$kegiatan->id)
        ->join('mitras','kegiatan_mitras.mitra_id','=','mitras.id')
        ->select(DB::raw('AVG(kegiatan_mitras.total_nilai) as avg'))
        //->selectRaw('mitras.kecamatan AS mitraz','sum(kegiatan_mitras.total_nilai)')
        ->first();
                return view('livewire.dashboard-penilaian',['avg_kecamatans'=>$avg_kecamatan,'avg_kab'=>$avg_kab,'kegiatan'=>$kegiatan]);
        }else{
             return view('livewire.dashboard-penilaian',['kegiatan'=>$kegiatan]);
        }

       

    }


}
