<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Kegiatan;
use Carbon\Carbon;

class KegiatanCreate extends Component
{
   
    public $nama_kegiatan;
    public $tahun;
    public $deskripsi;

    
    public function render()
    {
        return view('livewire.kegiatan-create');
    }

    public function store(){
    
        $this->validate([
            'nama_kegiatan'=>'required|min:3',
            'tahun'=>'required|digits:4|integer|min:1900',
            'deskripsi'=>'required'
        ]);
        $kegiatan=Kegiatan::create([
            'nama_kegiatan'=>$this->nama_kegiatan,
            'tahun'=>$this->tahun,
            'deskripsi'=>$this->deskripsi
        ]);
        $this->resetInput();
        return redirect()->to('/kegiatan/index'))->with('success', 'Kegiatan Berhasil Ditambahkan');
        
    }

    private function resetInput(){
        $this->nama_kegiatan=null;
        $this->tahun=null;
        $this->deskripsi=null;
    }
}
