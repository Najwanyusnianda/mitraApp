<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Kegiatan;
use App\KegiatanMitra;
use Illuminate\Support\Facades\DB;
class KegiatanIndex extends Component
{   

    use WithPagination;
    public $kegiatan_id;
    public $kegiatan;

    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    { 

        if(auth()->user()->role==1){
            $kegiatans=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            ->groupBy('kegiatan_mitras.kegiatan_id')
            ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan',
            'kegiatans.tahun AS tahun','kegiatans.is_active AS is_active',
            'kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai',DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
            ->latest('kegiatans.created_at')
            ->paginate(5);


    
          // dd($temp);
        }else{
            $kegiatans=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            ->where('master_kegiatans.seksi',auth()->user()->seksi)
            ->groupBy('kegiatan_mitras.kegiatan_id')
            ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan',
            'kegiatans.tahun AS tahun','kegiatans.is_active AS is_active',
            'kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai',DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
            ->latest('kegiatans.created_at')
            ->paginate(5);

    
          



        }


        return view('livewire.kegiatan-index',['kegiatans'=>$kegiatans,
        'kegiatan_chosen'=>$this->kegiatan]);
    }


    public function confirmation($kegiatan_id){
        $this->kegiatan_id=$kegiatan_id;
        $kegiatan=Kegiatan::find($kegiatan_id);
        
        $this->kegiatan=$kegiatan;

        $this->dispatchBrowserEvent('showConfirmationModal');
    }

    public function closeModal(){

    }
    //nonaktifkan kegiatan
    public function inActiveKegiatan(){
        $this->dispatchBrowserEvent('closeConfirmationModal');
        $kegiatan=Kegiatan::find($this->kegiatan_id);
        $kegiatan->update([
            'is_active'=>0
        ]);
       
        $this->emit('refreshComponent');
    }


    
}
