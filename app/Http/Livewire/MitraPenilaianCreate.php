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
        
    }

    public function handleMitraPenilaian($mitra){

        $this->mitra_id=$mitra['id'];
        $this->mitra_name=$mitra['name'];
        $kegiatan_mitra=KegiatanMitra::where('kegiatan_id',$this->kegiatan_id)
        ->where('mitra_id',$this->mitra_id)->first();
        $this->avg_pelatihan=$kegiatan_mitra['avg_pelatihan'];
        $this->avg_pelaksanaan=$kegiatan_mitra['avg_pelaksanaan'];
        $this->avg_evaluasi=$kegiatan_mitra['avg_evaluasi'];

        
    }

    public function closeModal(){
        $this->dispatchBrowserEvent('closeModalPenilaian');
    }
}
