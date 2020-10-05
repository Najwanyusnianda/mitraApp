<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\KegiatanMitra;
use App\Mitra;

class MitraPenilaianCreate extends Component
{
    public $disiplin_val;
    public $kualitas_val;
    public $kerjasama_val;

    public $avg_pelatihan;
    public $avg_pelaksanaan;
    public $avg_evaluasi;
    public $indicator;

    public $kegiatan_id;
    public $mitra_id;
    public $kegiatan_mitra_id;
    public $mitra_name;
    public $mitra_kegiatan;



    protected $listeners=[
        'getMitra'=>'handleMitraPenilaian',
    ];
    public function mount($kegiatan_id){
        $this->kegiatan_id=$kegiatan_id;

    }
    public function render()
    {

        return view('livewire.mitra-penilaian-create');
    }

    public function store(){
        $kegiatan_mitra=KegiatanMitra::find($this->kegiatan_mitra_id);
        if(empty($this->avg_pelatihan)){
            $sum_val=(int)$this->disiplin_val+(int)$this->kualitas_val+(int)$this->kerjasama_val;
            $avg_val=(float)$sum_val/3.0;
            $kegiatan_mitra->update([
               'nilai_pelatihan1'=>$this->disiplin_val,
               'nilai_pelatihan2'=>$this->kualitas_val,
               'nilai_pelatihan3'=>$this->kerjasama_val,
               'avg_pelatihan'=>round($avg_val,4)
            ]);
            
        }elseif (empty($this->avg_pelaksanaan)) {
            $sum_val=(int)$this->disiplin_val+(int)$this->kualitas_val+(int)$this->kerjasama_val;
            $avg_val=(float)$sum_val/3.0;
            $kegiatan_mitra->update([
               'nilai_pelaksanaan1'=>$this->disiplin_val,
               'nilai_pelaksanaan2'=>$this->kualitas_val,
               'nilai_pelaksanaan3'=>$this->kerjasama_val,
               'avg_pelaksanaan'=>$avg_val
            ]);
        }elseif (empty($this->avg_evaluasi)) {
            $sum_val=(int)$this->disiplin_val+(int)$this->kualitas_val+(int)$this->kerjasama_val;
            $avg_val=(float)$sum_val/3.0;
            $kegiatan_mitra->update([
               'nilai_evaluasi1'=> $this->disiplin_val,
               'nilai_evaluasi2'=>$this->kualitas_val,
               'nilai_evaluasi3'=>$this->kerjasama_val,
               'avg_evaluasi'=>round($avg_val,2)
            ]);
        }
        $this->emit('nilaiUpdated',$kegiatan_mitra);
        $this->resetInput();
        $this->dispatchBrowserEvent('closeModalPenilaian');
     
    }

    public function handleMitraPenilaian($mitra){

        $this->mitra_id=$mitra['id'];
        $this->mitra_name=$mitra['name'];
        $kegiatan_mitra=KegiatanMitra::where('kegiatan_id',$this->kegiatan_id)
        ->where('mitra_id',$this->mitra_id)->first();
        
        $this->kegiatan_mitra_id=$kegiatan_mitra['id'];
        $this->avg_pelatihan=$kegiatan_mitra['avg_pelatihan'];
        $this->avg_pelaksanaan=$kegiatan_mitra['avg_pelaksanaan'];
        $this->avg_evaluasi=$kegiatan_mitra['avg_evaluasi'];

    }

    public function closeModal(){
        $this->resetInput();
        $this->dispatchBrowserEvent('closeModalPenilaian');
    }
    private function resetInput(){

        $this->avg_pelatihan=null;
        $this->avg_pelaksanaan=null;
        $this->avg_evaluasi=null;
        $this->disiplin_val=null;
        $this->kualitas_val=null;
        $this->kerjasama_val=null;
    }
}
