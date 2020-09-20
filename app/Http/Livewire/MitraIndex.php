<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;
class MitraIndex extends Component
{
    protected $listeners=[
        'mitraStored'=>'handleStored'
    ];
    public function render()
    {
        $mitras=Mitra::latest()->get();
        return view('livewire.mitra-index',['mitras'=>$mitras]);
    }
    public function handleStored($mitra){
        
    }
}
