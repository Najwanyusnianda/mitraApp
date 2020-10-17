<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Kegiatan;

class KegiatanSelect extends Component
{
    public $kegiatan_id;

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
        $kegiatan_id=$this->kegiatan_id;
        $this->emit('kegiatanSelected',$kegiatan_id);
    }

    
}
