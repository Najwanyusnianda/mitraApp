<?php
                                                                                          
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Mitra;
use App\KegiatanMitra;
use App\Kegiatan;
class MitraIndex extends Component
{
    use WithPagination;

    public $statusUpdate=false;
    //public $mitras;
   // public $kegiatan;
    public $kegiatan_id;

    public $tabs;
    public $kecamatan;
    //public $kec=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];
    protected $listeners=[
        'mitraStored'=>'handleStored',
        'mitraUpdated'=>'handleUpdated',
        'mitraAlreadyStored'=>'handleAlreadyStored',
        'kegiatanSelected',
        'nilaiUpdated'
    ];


    /*public function mount($kegiatan_id){       
        $this->kegiatan_id=$kegiatan_id;       
    }*/

    public function render()
    {
        $kecamatans=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];
        $kegiatan_id=$this->kegiatan_id;
        $kegiatan=Kegiatan::find($kegiatan_id);
        $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.nik AS nik',
        'mitras.is_gadget AS is_gadget','mitras.is_kendaraan AS is_kendaraan',
        'mitras.kecamatan AS kecamatan')->paginate(10);

        if(!empty($kegiatan)){
            $check_kegiatan_mitras=KegiatanMitra::
            //where('kegiatan_id',$this->kegiatan_id)
            join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->where('kegiatans.id','!=',$this->kegiatan_id)
            //->where('mitras.nik',$this->nik)
            ->where(function($query) use ($kegiatan){
                $query->whereBetween('kegiatans.pelaksanaan_mulai', [$kegiatan->pelaksanaan_mulai, $kegiatan->pelaksanaan_selesai])
                ->orWhereBetween('kegiatans.pelaksanaan_selesai',[$kegiatan->pelaksanaan_mulai, $kegiatan->pelaksanaan_selesai])
                ->orWhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$kegiatan->pelaksanaan_mulai]) 
                ->orWhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$kegiatan->pelaksanaan_selesai]);
            })
            ->select('mitras.id AS id','mitras.name AS nama','kegiatans.nama_kegiatan AS nama_kegiatan','kegiatans.pelaksanaan_mulai AS mulai','kegiatans.pelaksanaan_selesai AS selesai')
            ->get()->toArray();

            //dd($check_kegiatan_mitras[0])["id"];
        }else{
            $check_kegiatan_mitras=[];
        }


        return view('livewire.mitra-index',['mitras'=>$mitras,'kegiatan'=>$kegiatan,'kecamatans'=>$kecamatans,'check_kegiatan_mitras'=>$check_kegiatan_mitras]);
    }






    ///create mitra
    public function createMitra(){
        $this->statusUpdate=false;
        $this->dispatchBrowserEvent('showModal');
    }


    ///edit mitra
    public function getMitra($id){
    $this->statusUpdate=true;
    $mitra = Mitra::find($id);
    $this->emit('getMitra',$mitra);
    $this->dispatchBrowserEvent('showModal');
    }

    public function getMitraDetail($id){
        $mitra = Mitra::find($id);
        $this->emit('getMitraDetail',$mitra);
        $this->dispatchBrowserEvent('showModalDetail');
    }

    public function deleteMitra($id){
        $mitra = Mitra::find($id);
        $mitra->delete();
        $this->handleDeleted($mitra);
    }

    public function storeMitra(){
        $this->emit('storeMitra');
    }


    ///emit
    public function handleDeleted($mitra){
        session()->flash('message','Mitra berhasil dihapus');
    }
    public function handleStored($mitra){
        session()->flash('message','Mitra berhasil ditambahkan');
    }

    public function handleAlreadyStored($mitra){
        session()->flash('info','Mitra telah ditambahkan sebelumnya dalam kegiatan ini');
    }

    public function handleUpdated($mitra){
        
        session()->flash('message','Mitra berhasil diperbaharui');
    }

    public function nilaiUpdated($kegiatan_mitra){
        session()->flash('message','Nilai Mitra berhasil diperbaharui');
    }

    public function changesTab($tabs){
        $kegiatan_id=$this->kegiatan_id;
        $this->tabs=$tabs;
        $this->emit('kegiatanPush',$kegiatan_id);
    }

    public function kegiatanSelected($kegiatan_id){
        $this->tabs=1;
        $this->kegiatan_id=$kegiatan_id;
    }

}
