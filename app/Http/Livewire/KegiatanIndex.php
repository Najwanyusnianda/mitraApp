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
