<?php

namespace App\Http\Livewire;

use App\Kegiatan;
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

    public $check_mitra_exist;
    
    public $step;

    protected $listeners = ['refreshComponent' => '$refresh',
'upKegiatanId'=>'handleKegiatanId'];


    public function mount($kegiatan){
        

        $this->users=[];
        $this->check_mitra_exist=[];
        $this->kecamatans=['010','020','030','040','050'];
        $this->kegiatan_id=$kegiatan->id;
      
        $this->nama_kegiatan=$kegiatan->nama_kegiatan;
        $this->step=1;
        
        //dd($this->kecamatans);
    }
    public function render()
    {
        if($this->nik != null){
            $kegiatan=Kegiatan::find($this->kegiatan_id);
            $check_kegiatan_mitras=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->where('kegiatans.id','!=',$this->kegiatan_id)
            ->where('mitras.nik',$this->nik)
            ->where(function($query) use ($kegiatan){
                $query->whereBetween('kegiatans.pelaksanaan_mulai', [$kegiatan->pelaksanaan_mulai, $kegiatan->pelaksanaan_selesai])
                ->orWhereBetween('kegiatans.pelaksanaan_selesai',[$kegiatan->pelaksanaan_mulai, $kegiatan->pelaksanaan_selesai])
                ->orWhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$kegiatan->pelaksanaan_mulai]) 
                ->orWhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$kegiatan->pelaksanaan_selesai]);
            })
            ->select('kegiatans.nama_kegiatan AS nama_kegiatan','kegiatans.pelaksanaan_mulai AS mulai','kegiatans.pelaksanaan_selesai AS selesai')
            ->first();
            if(!empty($check_kegiatan_mitras)){
                $check_kegiatan_mitras=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
                ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
                ->where('kegiatans.id','!=',$this->kegiatan_id)
                ->where('mitras.nik',$this->nik)
                ->where(function($query) use ($kegiatan){
                    $query->whereBetween('kegiatans.pelaksanaan_mulai', [$kegiatan->pelaksanaan_mulai, $kegiatan->pelaksanaan_selesai])
                    ->orWhereBetween('kegiatans.pelaksanaan_selesai',[$kegiatan->pelaksanaan_mulai, $kegiatan->pelaksanaan_selesai])
                    ->orWhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$kegiatan->pelaksanaan_mulai]) 
                    ->orWhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$kegiatan->pelaksanaan_selesai]);
                })
                ->select('kegiatans.nama_kegiatan AS nama_kegiatan','kegiatans.pelaksanaan_mulai AS mulai','kegiatans.pelaksanaan_selesai AS selesai')
                ->first()->toArray();
            }
      
            $this->check_mitra_exist=$check_kegiatan_mitras;
        }else{
            //$check_kegiatan_mitras=null;
            $this->check_mitra_exist=[];
        }

        return view('livewire.mitra-create');
    }

    public function handleKegiatanId($kegiatan_id){
  
        $this->kegiatan_id =$kegiatan_id;
    }
    /*
    public function updatedTanggalLahir(){
        $this->dispatchBrowserEvent('updateInput');
    }*/
    public function store(){
        
      
        $this->validate([
            'name'=>'required|min:3',
            'phone'=>'required|numeric|min:8',
            'email'=>'email',
            'nik'=>'required|digits:16',
            'pekerjaan'=>'required',
            'tanggal_lahir'=>'required',
            'is_gadget'=>'required',
            'is_kendaraan'=>'required',
            'jenis_kelamin'=>'required',
            'pendidikan'=>'required',
            'agama'=>'required',
            'kecamatan'=>'required',
            'jenis_kelamin'=>'required'         
        
        ],
        [
            'name.required'=>'Nama tidak boleh kosong',
            'name.min'=>'Nama minimal terdiri dari 3 huruf',
            'name.alpha'=>'Nama harus terdiri dari huruf',
            'phone.numeric'=>'Nomor handphone tidak valid',
            'phone.between'=>'Nomor handphone tidak valid',
            'phone.required'=>' Nomor Hp tidak boleh kosong',
            'nik.digits'=>'NIK harus terdiri dari 16 digit',
            'nik.required'=>'NIK tidak boleh kosong',
            'email.email'=>'Email tidak valid',
            'pekerjaan.required'=>'Pekerjaan harus diisi',
            'kecamatan.required'=>'kecamatan tidak boleh kosong',
            'agama.required'=>' Agama tidak boleh kosong',
            'pendidikan.required'=>'Ijazah tidak boleh kosong',
            'jenis_kelamin.required'=>'Jenis Kelamin tidak boleh kosong',
            'tanggal_lahir.required'=>'Tanggal Lahir tidak boleh kosong',
            'is_gadget.required'=>'Keterangan Gadget belum ditentukan',
            'is_kendaraan.required'=>'Keterangan kendaraan belum ditentukan',

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
        $this->kegiatan_id=null;
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
        $this->kecamatan=null;
        $this->users=null;
    }


    public function updatedName(){
        $this->users=Mitra::where('name','like','%'.$this->name.'%')->take(5)->get()->toArray();

        if($this->name==''){
            $this->users=null;
        }


    }



   /* public function updatedNik(){
        $kegiatan=Kegiatan::find($this->kegiatan_id);
        $check_kegiatan_mitras=KegiatanMitra::
        //where('kegiatan_id',$this->kegiatan_id)
        join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->where('kegiatans.id','!=',$this->kegiatan_id)
        ->where('mitras.nik',$this->nik)
        ->where(function($query) use ($kegiatan){
            $query->whereBetween('kegiatans.pelaksanaan_mulai', [$kegiatan->pelaksanaan_mulai, $kegiatan->pelaksanaan_selesai])
            ->orWhereBetween('kegiatans.pelaksanaan_selesai',[$kegiatan->pelaksanaan_mulai, $kegiatan->pelaksanaan_selesai])
            ->orWhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$kegiatan->pelaksanaan_mulai]) 
            ->orWhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$kegiatan->pelaksanaan_selesai]);
        })
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan','kegiatans.pelaksanaan_mulai AS mulai','kegiatans.pelaksanaan_selesai AS selesai')
        ->first();

        $this->check_mitra_exist=$check_kegiatan_mitras;
       
    }*/

/*
    public function updatedAgama($agama)
    {
        //
        $this->agama=$agama;
        $this->emit('refreshComponent');
    }*/

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
                'phone'=>'required|numeric|min:8',
                'email'=>'email',
                'nik'=>'required|digits:16',
                'pekerjaan'=>'required',
                'tanggal_lahir'=>'required',
                //'is_gadget'=>'required',
                // 'is_kendaraan'=>'required',
                'jenis_kelamin'=>'required',
                'pendidikan'=>'required',
                'agama'=>'required',
                'kecamatan'=>'required',
                'jenis_kelamin'=>'required'         
            
            ],
            [
                'name.required'=>'Nama tidak boleh kosong',
                'name.min'=>'Nama minimal terdiri dari 3 huruf',
                'name.alpha'=>'Nama harus terdiri dari huruf',
                'phone.numeric'=>'Nomor handphone tidak valid',
                'phone.between'=>'Nomor handphone tidak valid',
                'nik.digits'=>'NIK harus terdiri dari 16 digit',
                'nik.required'=>'NIK tidak boleh kosong',
                'email.email'=>'Email tidak valid',
                'pekerjaan.required'=>'Pekerjaan harus diisi',
                'kecamatan.required'=>'kecamatan tidak boleh kosong',
                'agama.required'=>' Agama tidak boleh kosong',
                'pendidikan'=>'Ijazah tidak boleh kosong',
                'jenis_kelamin'=>'Jenis Kelamin tidak boleh kosong',
                'tanggal_lahir'=>'Tanggal Lahir tidak boleh kosong',

        ]);
        }
        $this->step=$step;



    }

}
