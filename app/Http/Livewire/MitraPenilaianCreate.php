<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MitraPenilaianCreate extends Component
{
    public $disiplin_val;
    public $kualitas_val;
    public $kerjasama_val;

    public $indicator;
    public function render()
    {
        return view('livewire.mitra-penilaian-create');
    }

    public function store(){
        
    }
}
