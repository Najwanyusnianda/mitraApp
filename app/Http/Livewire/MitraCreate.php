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
    public $npwp;
    public $bulan_lahir;
    public $tahun_lahir;
    public $hari_lahir;
    public $tanggal_lahir;
    public $nik;
    public $email;
    public $pengalaman;
    public $pekerjaan;
    public $agama;
    public $jenis_kelamin;
    public $is_kawin;
    public $pendidikan;
    public $alamat;

    public $is_gadget;
    public $is_kendaraan;
    public $rekening;
    public $kecamatans;
    public $kecamatan;
    
    public $step;

    protected $listeners = ['refreshComponent' => '$refresh'];


    public function mount($kegiatan){
        $this->users=[];
        $this->kecamatans=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];
        $this->kegiatan_id=$kegiatan->id;
      
        $this->nama_kegiatan=$kegiatan->nama_kegiatan;
        $this->step=1;
        
        //dd($this->kecamatans);
    }
    public function render()
    {
        
        return view('livewire.mitra-create');
    }

    public function store(){
        
      


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
                'email'=>$this->email,
                'jenis_kelamin'=>$this->jenis_kelamin,
                'is_kawin'=>$this->is_kawin,
                'alamat'=>$this->alamat,
                'pendidikan'=>$this->pendidikan,
                'npwp'=>$this->npwp,
                'nomor_rekening'=>$this->rekening,
                'agama'=>$this->agama,
                'kecamatan'=>$this->kecamatan
            ]);

    
        }else{
            //dd($this->pendidikan);
            #$this->tanggal_lahir=$this->tahun_lahir.'-'.$this->bulan_lahir.'-'.$this->hari_lahir;
            $mitra=Mitra::create([
                'name'=>$this->name,
                'phone'=>$this->phone,
                'tanggal_lahir'=>$this->tanggal_lahir,
                'nik'=>$this->nik,
                'pekerjaan'=>$this->pekerjaan,
                'pengalaman'=>$this->pengalaman,
                'is_gadget'=>$this->is_gadget ?? '1',
                'is_kendaraan'=>$this->is_kendaraan ?? '1',
                'email'=>$this->email,
                'jenis_kelamin'=>$this->jenis_kelamin,
                'is_kawin'=>$this->is_kawin,
                'alamat'=>$this->alamat,
                'pendidikan'=>$this->pendidikan,
                'npwp'=>$this->npwp,
                'nomor_rekening'=>$this->rekening,
                'agama'=>$this->agama,
                'kecamatan'=>$this->kecamatan
            ]);
          
        }

        $mitra_check=KegiatanMitra::where('kegiatan_id',$this->kegiatan_id)
        ->where('mitra_id',$mitra->id)->first();
        if(empty($mitra_check)){
            $mitra_kegiatan=KegiatanMitra::create([
                'kegiatan_id'=>$this->kegiatan_id,
                'mitra_id'=>$mitra->id,

            ]);

            $this->resetInput();
            $this->emit('mitraStored',$mitra);
            $this->dispatchBrowserEvent('closeModal');
            $this->step=1;
        }else{
            $this->resetInput();
            $this->emit('mitraAlreadyStored',$mitra);
            $this->dispatchBrowserEvent('closeModal');
            $this->step=1;
        }
        

    }


    public function closeModal(){
        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        $this->step=1;
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
        $this->jenis_kelamin = null;
        $this->is_kawin =null;
        $this->alamat =null;
        $this->pendidikan =null;
        $this->agama =null;
        $this->users=null;
    }


    public function updatedName(){
        $this->users=Mitra::where('name','like','%'.$this->name.'%')->take(5)->get()->toArray();

        if($this->name==''){
            $this->users=null;
        }


    }


    public function updatedAgama($agama)
    {
        //
        $this->agama=$agama;
        $this->emit('refreshComponent');
    }

    public function fillUserForm($mitra_id){
        $mitra=Mitra::find($mitra_id);

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
        $this->rekening=$mitra['nomor_rekening'];
        $this->npwp=$mitra['npwp'];
        $this->jenis_kelamin = $mitra['jenis_kelamin'];
        $this->is_kawin =$mitra['is_kawin'];
        $this->alamat =$mitra['alamat'];
        $this->pendidikan =$mitra['pendidikan'];
        $this->agama =$mitra['agama'];
        $this->kecamatan=$mitra['kecamatan'];

        $this->users=null;
    }

    public function nextStep($step){
        if($this->step==1){
            $this->validate([
            'name'=>'required|min:3',
            'phone'=>'required|min:4',
            'nik'=>'required',
            'pekerjaan'=>'required',          
            
        ]);
        }
        $this->step=$step;



    }

}
