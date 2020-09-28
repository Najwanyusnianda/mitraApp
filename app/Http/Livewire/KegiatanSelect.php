<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Kegiatan;

class KegiatanSelect extends Component
{
    public $kegiatan_id;

    public function render()
    {
        $kegiatan=Kegiatan::all();
        return view('livewire.kegiatan-select',['kegiatans'=>$kegiatan]);
    }

    public function updated($kegiatan_id){
        $kegiatan_id=$this->kegiatan_id;
        $this->emit('kegiatanSelected',$kegiatan_id);
    }

    
}