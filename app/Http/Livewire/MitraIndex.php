<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Mitra;
use App\KegiatanMitra;
use App\Kegiatan;
class MitraIndex extends Component
{
    use WithPagination;

    public $statusUpdate=false;
    //public $mitras;
   // public $kegiatan;
    public $kegiatan_id;

    protected $listeners=[
        'mitraStored'=>'handleStored',
        'mitraUpdated'=>'handleUpdated'
    ];

    public function mount($kegiatan_id){



     
       
        $this->kegiatan_id=$kegiatan_id;
        
    }

    public function render()
    {
        $kegiatan_id=$this->kegiatan_id;
        $kegiatan=Kegiatan::find($kegiatan_id);
        $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone')
        ->paginate(10);
        return view('livewire.mitra-index',['mitras'=>$mitras,'kegiatan'=>$kegiatan]);
    }



    ///create mitra
    public function createMitra(){
        $this->statusUpdate=false;
        $this->dispatchBrowserEvent('showModal');
    }


    ///edit mitra
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
