<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Kegiatan;
use App\KegiatanMitra;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class KegiatanIndex extends Component
{   

    use WithPagination;
    public $kegiatan_id;
    public $kegiatan;

    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    { 

        $kegiatans=Kegiatan::latest()->paginate(5);
        $kegiatan_arr=Kegiatan::select('id')->get()->toArray();
        $temp=[];
       foreach ($kegiatan_arr as $key => $keg) {
           $temp[]=$keg['id'];
       }

      // dd($temp);
        $mitra_count=KegiatanMitra::whereIn('kegiatan_id',$temp)
        ->groupBy('kegiatan_id')
        ->select('kegiatan_id', DB::raw('COUNT(kegiatan_id) as count'))
        ->get();

        return view('livewire.kegiatan-index',['kegiatans'=>$kegiatans,
        'kegiatan_chosen'=>$this->kegiatan,'count_mitra'=>$mitra_count]);
        /*if(auth()->user()->role==1){

            
            $kegiatans=Kegiatan::query()
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            ->join('kegiatan_mitras','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->get();
            
            if($kegiatans->isNotEmpty()){
            $kegiatans=Kegiatan::query()
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            ->join('kegiatan_mitras','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->groupBy('kegiatan_mitras.kegiatan_id')
            ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan',
            'kegiatans.tahun AS tahun','kegiatans.is_active AS is_active',
            'kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai',DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
            ->latest('kegiatans.created_at')
            ->


            }
            else {
            $kegiatans=Kegiatan::query()
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            //->leftjoin('kegiatan_mitras','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            //->leftjoin('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan',
            'kegiatans.tahun AS tahun','kegiatans.is_active AS is_active',
            'kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai')
            ->paginate(5);
            }

            
    
            
        }else{


            $kegiatans=Kegiatan::query()
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            ->join('kegiatan_mitras','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->get();
      
            if($kegiatans->isNotEmpty()){
            $kegiatans=Kegiatan::query()
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            ->join('kegiatan_mitras','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->where('master_kegiatans.seksi',auth()->user()->seksi)
            ->groupBy('kegiatan_mitras.kegiatan_id')
            ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan',
            'kegiatans.tahun AS tahun','kegiatans.is_active AS is_active',
            'kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai',DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
            ->latest('kegiatans.created_at')
            ->paginate(5);
            }
            else {
            $kegiatans=Kegiatan::query()
            ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
            ->where('master_kegiatans.seksi',auth()->user()->seksi)
            //->leftjoin('kegiatan_mitras','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            //->leftjoin('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan',
            'kegiatans.tahun AS tahun','kegiatans.is_active AS is_active',
            'kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai')
            ->paginate(5);
        }*/

          
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
        $path_kegiatan='Data/'.$kegiatan->nama_kegiatan;
        $kegiatan_mitra=KegiatanMitra::where('kegiatan_id',$kegiatan->id);
        File::deleteDirectory(storage_path('app/'.$path_kegiatan));
        $kegiatan->delete();
        $kegiatan_mitra->delete();
        
        
       
        //$this->emit('refreshComponent');
    }


    public function updateData($kegiatan_id){
        
        return redirect()->to('/kegiatan/update/'.$kegiatan_id);
        //$this->emit('updateKegiatan',$kegiatan);
    }


    
}
