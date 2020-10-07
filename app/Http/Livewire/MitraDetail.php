<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MitraDetail extends Component
{
    public $name;
    public $phone;
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

    protected $listeners=[
        'getMitra'=>'showMitra'
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
    }
}
