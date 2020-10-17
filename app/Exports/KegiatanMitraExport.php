<?php

namespace App\Exports;

use App\KegiatanMitra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class KegiatanMitraExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return KegiatanMitra::all();
    }*/
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function query(){
        $mitras=KegiatanMitra::query()
        ->join('mitras','kegiatan_mitras.mitra_id','=','mitras.id')
        ->where('kegiatan_id',$this->id);
        dd($mitras);
        return $mitras;
    }
}
