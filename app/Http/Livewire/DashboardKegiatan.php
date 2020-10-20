<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Kegiatan;
use App\KegiatanMitra;
use App\Mitra;

class DashboardKegiatan extends Component
{
    public function render()
    {
        $now_time=\Carbon\Carbon::now();
        $check_kegiatan_mitras_old=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        //->where('mitras.nik',$this->nik)
        ->WhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$now_time])
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan','kegiatans.pelaksanaan_mulai AS mulai','kegiatans.pelaksanaan_selesai AS selesai')
        ->get();
        if($check_kegiatan_mitras_old->isEmpty())
        {
            $check_kegiatan_mitras_old=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
            ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
            ->select('kegiatans.nama_kegiatan AS nama_kegiatan','kegiatans.pelaksanaan_mulai AS mulai','kegiatans.pelaksanaan_selesai AS selesai')
            ->latest()
            ->get();
        }

        return view('livewire.dashboard-kegiatan');
    }
}
