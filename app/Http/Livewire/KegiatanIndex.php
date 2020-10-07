<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Kegiatan;
class KegiatanIndex extends Component
{   

    use WithPagination;
    public $kegiatan_id;
    public $kegiatan;

    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    { 

        $kegiatans=Kegiatan::latest()->paginate(5);
        return view('livewire.kegiatan-index',['kegiatans'=>$kegiatans,
        'kegiatan_chosen'=>$this->kegiatan]);
    }


    public function confirmation($kegiatan_id){
        $this->kegiatan_id=$kegiatan_id;
        $kegiatan=Kegiatan::find($kegiatan_id);
      
        $this->kegiatan=$kegiatan;

        $this->dispatchBrowserEvent('showConfirmationModal');
    }

    public function closeModal(){

    }
    //nonaktifkan kegiatan
    public function inActiveKegiatan(){
        $this->dispatchBrowserEvent('closeConfirmationModal');
        $kegiatan=Kegiatan::find($this->kegiatan_id);
        $kegiatan->update([
            'is_active'=>0
        ]);
       
        $this->emit('refreshComponent');
    }


    
}
