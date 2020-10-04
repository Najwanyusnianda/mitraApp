<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;
use App\KegiatanMitra;
class MitraCreate extends Component
{
    
    public $kegiatan_id;
    public $nama_kegiatan;

    public $users;

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
        $this->users=[];
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
            $mitra=$is_mitra_already;
            $mitra->update([
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
        $this->resetInput();
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
        $this->users=null;
    }


    public function updatedName(){
        $this->users=Mitra::where('name','like','%'.$this->name.'%')->get()->toArray();

        if($this->name==''){
            $this->users=null;
        }


    }

    public function fillUserForm($mitra_id){
        $mitra=Mitra::find($mitra_id)->first();

        $this->tanggal_lahir=$mitra['tanggal_lahir'];

        $tanggal_lahir = explode('-', $this->tanggal_lahir);
        $this->name=$mitra['name'];
        $this->phone=$mitra['phone'];
        $this->bulan_lahir=$tanggal_lahir[1];
        $this->tahun_lahir=$tanggal_lahir[0];
        $this->hari_lahir=$tanggal_lahir[2];
      
        $this->nik=$mitra['nik'];
        $this->email=$mitra['email'] ?? '';
        $this->pengalaman=$mitra['pengalaman'];
        $this->pekerjaan=$mitra['pekerjaan'];
        $this->is_gadget=$mitra['is_gadget'];
        $this->is_kendaraan=$mitra['is_kendaraan'];

        $this->users=null;
    }
}
