<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;
use App\KegiatanMitra;
class MitraCreate extends Component
{
    
    public $kegiatan_id;
    public $nama_kegiatan;

    public $name;
    public $phone; 
    public $bulan_lahir;
    public $tahun_lahir;
    public $hari_lahir;
    public $tanggal_lahir;
    public $nik;
    public $email;
    public $pengalaman;
    public $pekerjaan;
    public $is_gadget;
    public $is_kendaraan;
    public $rekening;
    public $npwp;


    public function mount($kegiatan){
        
        $this->kegiatan_id=$kegiatan->id;
  
        $this->nama_kegiatan=$kegiatan->nama_kegiatan;
    }
    public function render()
    {
        return view('livewire.mitra-create');
    }

    public function store(){
        
        $this->validate([
            'name'=>'required|min:3',
            'phone'=>'required|min:4',
        ]);

        $is_mitra_already=Mitra::where('phone',$this->phone)->first();
        
        
        if (!empty($is_mitra_already)) {
            $mitra=$is_mitra_already->update([
                'name'=>$this->name,
                'phone'=>$this->phone,
            ]);


        }else{
            $mitra=Mitra::create([
            'name'=>$this->name,
            'phone'=>$this->phone,
            ]);
        }

        $mitra_kegiatan=KegiatanMitra::create([
                'kegiatan_id'=>$this->kegiatan_id,
                'mitra_id'=>$mitra->id,

        ]);

        $this->resetInput();
        $this->emit('mitraStored',$mitra);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function closeModal(){
        $this->dispatchBrowserEvent('closeModal');
    }

    private function resetInput(){
        $this->name=null;
        $this->phone=null;
    }
}
