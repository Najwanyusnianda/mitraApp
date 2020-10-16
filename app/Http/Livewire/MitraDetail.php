<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MitraDetail extends Component
{

    public $mitraId;
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
    public $kecamatan;
    public $jenis_kelamin;
    public $is_kawin;
    public $pendidikan;
    public $alamat;

    protected $listeners=[
        'getMitraDetail'=>'showMitra'
    ];

    public function render()
    {
        return view('livewire.mitra-detail');
    }

    public function showMitra($mitra){

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
        $this->kecamatan=$mitra['kecamatan'];
        $this->jenis_kelamin=$mitra['jenis_kelamin'];
        $this->is_kawin =$mitra['is_kawin'];
        $this->alamat =$mitra['alamat'];
        $this->pendidikan =$mitra['pendidikan'];
        $this->agama =$mitra['agama'];
        $this->kecamatan=$mitra['kecamatan'];
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
        $this->kecamatan =null;
    
    }

    public function closeModalDetail(){
        
        $this->dispatchBrowserEvent('closeModalDetail');
    
    
    }
}
