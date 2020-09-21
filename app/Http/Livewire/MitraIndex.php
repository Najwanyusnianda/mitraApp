<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;
class MitraIndex extends Component
{
    public $statusUpdate=false;
    protected $listeners=[
        'mitraStored'=>'handleStored',
        'mitraUpdated'=>'handleUpdated'
    ];
    public function render()
    {
        $mitras=Mitra::latest()->get();
        return view('livewire.mitra-index',['mitras'=>$mitras]);
    }

    public function getMitra($id){
    $this->statusUpdate=true;
    $mitra = Mitra::find($id);
    $this->emit('getMitra',$mitra);
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
