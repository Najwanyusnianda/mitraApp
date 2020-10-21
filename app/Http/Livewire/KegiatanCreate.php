<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Kegiatan;
use App\MasterKegiatan;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class KegiatanCreate extends Component
{
    use WithFileUploads;

    public $nama_kegiatan;
    public $tahun;
    public $deskripsi;
    public $mulai_pelatihan;
    public $mulai_pelaksanaan;
    public $selesai_pelatihan;
    public $selesai_pelaksanaan;
    public $master_kegiatan_id;

    public $template_sertifikat;
    public $template_spk;

    public $kegiatans;
    public $kegiatan_error;

    public function mount()
    {
        $this->kegiatans=[];
    }
    
    public function render()
    {
        return view('livewire.kegiatan-create');
    }

    public function store(){
        if($this->master_kegiatan_id !=null){
            $master_kegiatan=Kegiatan::find($this->master_kegiatan_id);
        }else{
            $this->kegiatans=null;
        }
        
        $this->validate([
            'nama_kegiatan'=>'required|min:3',
            'tahun'=>'required|digits:4|integer|min:1900',
            //'deskripsi'=>'required',
            'master_kegiatan_id'=>'required',
        ]);
        if(!empty($this->master_kegiatan_id)){
            $path_sertifikat='Data/'.$this->nama_kegiatan.'/sertifikat';
        $path_spk='Data/'.$this->nama_kegiatan.'/spk';
        $path_template='Data/'.$this->nama_kegiatan.'/template';
        Storage::makeDirectory($path_sertifikat);
        Storage::makeDirectory($path_spk);
        Storage::makeDirectory($path_template);
    
        $ext=$this->template_sertifikat->getClientOriginalExtension();
        $ext2=$this->template_spk->getClientOriginalExtension();
        $path_sertifikat=$this->template_sertifikat->storeAs($path_template,'template_sertifikat_'.$this->nama_kegiatan.'-'.$this->tahun.'.'.$ext);
        $path_spk=$this->template_spk->storeAs($path_template,'template_spk_'.$this->nama_kegiatan.'-'.$this->tahun.'.'.$ext2);
        $kegiatan=Kegiatan::create([
            'nama_kegiatan'=>$this->nama_kegiatan,
            'tahun'=>$this->tahun,
            'master_kegiatan_id'=>$this->master_kegiatan_id,
            'deskripsi'=>$this->deskripsi,
            'pelatihan_mulai'=>$this->mulai_pelatihan,
            'pelatihan_selesai'=>$this->selesai_pelatihan,
            'pelaksanaan_mulai'=>$this->mulai_pelaksanaan,
            'pelaksanaan_selesai'=>$this->selesai_pelaksanaan,
            'template_sertifikat_path'=>$path_sertifikat,
            'template_spk_path'=>$path_spk,
        ]);

        

        $this->resetInput();

        session()->flash('success', 'Kegiatan Berhasil Ditambahkan');
        return redirect()->to('/kegiatan/index');
        }else{
            session()->flash('info', 'Kegiatan Tidak terdapat dalam master');
            return redirect()->to('/kegiatan/create');
        }

        
    }

    public function updatedNamaKegiatan(){
        if (auth()->user()->role==1) {
            $this->kegiatans=MasterKegiatan::where('nama_kegiatan','like','%'.$this->nama_kegiatan.'%')

            ->take(5)->get()->toArray();
            $check_kegiatan=MasterKegiatan::find($this->nama_kegiatan);
            if($check_kegiatan!=null){
                $this->master_kegiatan_id=$check_kegiatan->id;
                $this->kegiatan_error=false;
            }else{
                $this->kegiatan_error=true;
                $this->master_kegiatan_id=null;
            }
        } else {
            $this->kegiatans=MasterKegiatan::where('nama_kegiatan','like','%'.$this->nama_kegiatan.'%')
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            ->where('master_kegiatans.seksi',auth()->user()->seksi)
            ->take(5)->get()->toArray();
            $check_kegiatan=MasterKegiatan::find($this->nama_kegiatan);
            if($check_kegiatan!=null){
                $this->master_kegiatan_id=$check_kegiatan->id;
                $this->kegiatan_error=false;
            }else{
                $this->kegiatan_error=true;
                $this->master_kegiatan_id=null;
            }
        }
        

        
        if($this->nama_kegiatan==''){
            $this->kegiatans=null;
        }
    }

    public function fillKegiatanForm($master_kegiatan_id){
        $kegiatan=MasterKegiatan::find($master_kegiatan_id);

        $this->nama_kegiatan=$kegiatan['nama_kegiatan'];
        $this->master_kegiatan_id=$kegiatan['id'];
        $this->kegiatan_error=false;
        $this->kegiatans=null;
    }

    private function resetInput(){
        $this->nama_kegiatan=null;
        $this->tahun=null;
        $this->deskripsi=null;
        $this->kegiatan_error=false;
    }
}
