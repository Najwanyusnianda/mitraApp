<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Kegiatan;

class KegiatanSelect extends Component
{
    public $kegiatan_id;
    public $pelaksanaan_mulai;
    public $pelaksanaan_selesai;
    public $pelatihan_mulai;
    public $pelatihan_selesai;

    public function render()
    {
        if(auth()->user()->role==1){
            $kegiatan=Kegiatan::where('is_active','=',1)->latest()->get();
            return view('livewire.kegiatan-select',['kegiatans'=>$kegiatan]);
        
        }else{
        $kegiatan=Kegiatan::
        join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
        ->where('master_kegiatans.seksi',auth()->user()->seksi)
        ->where('is_active','=',1)
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan','kegiatans.id AS id')
        ->latest('kegiatans.created_at')->get();

        }


        return view('livewire.kegiatan-select',['kegiatans'=>$kegiatan]);

    }

    public function updated($kegiatan_id){
        if(!empty($this->kegiatan_id)){
            $kegiatan_jadwal=Kegiatan::find($this->kegiatan_id);
  ;
            $this->pelaksanaan_mulai=$kegiatan_jadwal->pelaksanaan_mulai;
            $this->pelaksanaan_selesai=$kegiatan_jadwal->pelaksanaan_selesai;
            $this->pelatihan_mulai=$kegiatan_jadwal->pelatihan_mulai;
            $this->pelatihan_selesai=$kegiatan_jadwal->pelatihan_selesai;
        }

        $kegiatan_id=$this->kegiatan_id;
        $this->emit('kegiatanSelected',$kegiatan_id);
    }

    
}
