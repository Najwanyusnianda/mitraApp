<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Kegiatan;
class KegiatanIndex extends Component
{   

    use WithPagination;
    public function render()
    {
        
        $kegiatans=Kegiatan::latest()->paginate(5);
        return view('livewire.kegiatan-index',['kegiatans'=>$kegiatans]);
    }


    
}
