<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;
class MitraUpdate extends Component
{
    public $name;
    public $phone;
    public $mitraId;

    protected $listeners=[
        'getMitra'=>'showMitra'
    ];

    public function render()
    {
        return view('livewire.mitra-update');
    }

    public function update(){
      if($this->mitraId){
          $mitra=Mitra::find($this->mitraId);
         $mitra->update([
            'name'=>$this->name,
            'phone'=>$this->phone,
         ]);

         $this->resetInput();

         $this->emit('mitraUpdated',$mitra);
      }  
    }

    private function resetInput(){
        $this->name=null;
        $this->phone=null;
    }

    public function showMitra($mitra){
        $this->name=$mitra['name'];
        $this->phone=$mitra['phone'];
        $this->mitraId=$mitra['id'];
    }
}
