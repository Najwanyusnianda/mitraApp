<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;
use App\KegiatanMitra;
use App\Kegiatan;

class MitraPenilaian extends Component
{
    public $kegiatan_id;

    protected $listeners=[
        'kegiatanPush',
    ];
    public function render()
    {
        $kegiatan_id=$this->kegiatan_id;
        $kegiatan=Kegiatan::find($kegiatan_id);
        $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.nik AS nik','kegiatan_mitras.nilai_pelatihan1 AS avg_pelatihan',
        'kegiatan_mitras.nilai_pelaksanaan1 AS avg_pelaksanaan',
        'kegiatan_mitras.nilai_evaluasi1 AS avg_evaluasi')
        ->paginate(10);
        return view('livewire.mitra-penilaian',['mitras'=>$mitras,'kegiatan'=>$kegiatan]);
    }

    //mount kegiataan saat change tabs
    public function kegiatanPush($kegiatan_id){
        $this->kegiatan_id=$kegiatan_id;
    }




}
