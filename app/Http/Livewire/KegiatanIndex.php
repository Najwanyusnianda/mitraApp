<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Kegiatan;
class KegiatanIndex extends Component
{   

    use WithPagination;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        
        $kegiatans=Kegiatan::latest()->paginate(5);
        return view('livewire.kegiatan-index',['kegiatans'=>$kegiatans]);
    }

    //nonaktifkan kegiatan
    public function inActiveKegiatan($kegiatan_id){
        $kegiatan=Kegiatan::find($kegiatan_id);
        $kegiatan->update([
            'is_active'=>0
        ]);

        $this->emit('refreshComponent');
    }


    
}
