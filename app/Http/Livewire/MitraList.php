<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;

class MitraList extends Component
{
    public function render()
    {
        $mitras=Mitra::all();

        return view('livewire.mitra-list',
        ['mitras'=>$mitras]);
    }
}
