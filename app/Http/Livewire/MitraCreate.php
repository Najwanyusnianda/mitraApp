<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;
class MitraCreate extends Component
{
    public $name;
    public $phone;


    public function render()
    {
        return view('livewire.mitra-create');
    }

    public function store(){
        $mitra=Mitra::create([
            'name'=>$this->name,
            'phone'=>$this->phone,
        ]);
        $this->resetInput();
        $this->emit('mitraStored',$mitra);
    }

    private function resetInput(){
        $this->name=null;
        $this->phone=null;
    }
}
