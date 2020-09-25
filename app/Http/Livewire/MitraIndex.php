<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Mitra;
use App\KegiatanMitra;
class MitraIndex extends Component
{
    use WithPagination;

    public $statusUpdate=false;
    public $mitras;

    protected $listeners=[
        'mitraStored'=>'handleStored',
        'mitraUpdated'=>'handleUpdated'
    ];

    public function mount($kegiatan_id){
        $mitra_kegiatan=KegiatanMitra::where('kegiatan_id',$kegiatan_id)->get();
        $this->mitras=$mitra_kegiatan;
    }

    public function render()
    {
        $mitras=$this->mitras;
        return view('livewire.mitra-index',['mitras'=>$mitras]);
    }

    public function getMitra($id){
    $this->statusUpdate=true;
    $mitra = Mitra::find($id);
    $this->emit('getMitra',$mitra);
    $this->dispatchBrowserEvent('showModal');
    }

    public function deleteMitra($id){
        $mitra = Mitra::find($id);
        $mitra->delete();
        $this->handleDeleted($mitra);
    }


    public function handleDeleted($mitra){
        session()->flash('message','Mitra berhasil dihapus');
    }
    public function handleStored($mitra){
        session()->flash('message','Mitra berhasil ditambahkan');
    }

    public function handleUpdated($mitra){
        
        session()->flash('message','Mitra berhasil diperbaharui');
    }

}
