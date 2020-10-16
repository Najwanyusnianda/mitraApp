<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Mitra;

class MitraList extends Component
{
    use WithPagination;

    public $kecamatan;
    public $search;

    protected $updatesQueryString = [
        ['search' => ['except' => '']],
    ];
    


    public function render()
    {
        $kecamatans=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];
        if($this->kecamatan !==null && $this->search !== null ){
            $mitras=Mitra::where('kecamatan',$this->kecamatan)
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name')->paginate(15);
        }elseif($this->kecamatan !== null){
            $mitras=Mitra::where('kecamatan',$this->kecamatan)->orderBy('name')->paginate(15);
            
        }elseif($this->search !== null){
            $mitras=Mitra::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name')->paginate(15);
        }
        else{
            $mitras=Mitra::orderBy('name')->paginate(15);
        }


        return view('livewire.mitra-list',
        ['mitras'=>$mitras,'kecamatans'=>$kecamatans]);
    }


    public function filterKecamatan($kecamatan){
        if($kecamatan != 'semua'){
            $this->kecamatan=$kecamatan;
        }else{
            $this->kecamatan=null;
        }
       
    }

    public function getMitraDetail($id){
        $mitra = Mitra::find($id);
        $this->emit('getMitraDetail',$mitra);
        $this->dispatchBrowserEvent('showModalDetail');
    }


}
