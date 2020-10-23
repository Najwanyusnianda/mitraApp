<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mitra;
class MitraUpdate extends Component
{

    public $mitraId;
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

         $this->resetInput();

         $this->emit('mitraUpdated',$mitra);
         $this->dispatchBrowserEvent('closeModal');
      }  
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

    public function closeModal(){
        $this->resetInput();

        $this->dispatchBrowserEvent('closeModal');
        $this->step=1;
    }

    public function showMitra($mitra){
        $this->step=1;
        $this->mitraId=$mitra['id'];
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
