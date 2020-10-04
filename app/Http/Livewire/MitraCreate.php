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
            'bulan_lahir'=>'required',
            'tahun_lahir'=>'required|digits:4',
            'hari_lahir'=>'required',
            'nik'=>'required',
            'pekerjaan'=>'required',
            
        ]);

        $is_mitra_already=Mitra::where('nik',$this->nik)->first();
        
        
        if (!empty($is_mitra_already)) {
            $mitra=$is_mitra_already->update([
                'name'=>$this->name,
                'phone'=>$this->phone,
            ]);


        }else{
            $this->tanggal_lahir=$this->tahun_lahir.'-'.$this->bulan_lahir.'-'.$this->hari_lahir;
            $mitra=Mitra::create([
            'name'=>$this->name,
            'phone'=>$this->phone,
            'tanggal_lahir'=>$this->tanggal_lahir,
            'nik'=>$this->nik,
            'pekerjaan'=>$this->pekerjaan,
            'pengalaman'=>$this->pengalaman,
            'is_gadget'=>$this->is_gadget,
            'is_kendaraan'=>$this->is_kendaraan,
            'email'=>$this->email
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
        $this->bulan_lahir=null;
        $this->tahun_lahir=null;
        $this->hari_lahir=null;
        $this->tanggal_lahir=null;
        $this->nik=null;
        $this->email=null;
        $this->pengalaman=null;
        $this->pekerjaan=null;
        $this->is_gadget=null;
        $this->is_kendaraan=null;
        $this->rekening=null;
        $this->npwp=null;
    }
}
