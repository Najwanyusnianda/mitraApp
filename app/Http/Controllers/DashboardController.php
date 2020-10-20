<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\KegiatanMitra;
use App\Kegiatan;
use App\User;

class DashboardController extends Controller
{
    //

    public function index(){
        $kegiatan=Kegiatan::latest()->first();
       

        $count_kecamatan=DB::table('kegiatan_mitras')
        ->where('kegiatan_mitras.kegiatan_id',$kegiatan->id)
        ->join('mitras','kegiatan_mitras.mitra_id','=','mitras.id')
        ->join('kecamatans','mitras.kecamatan','=','kecamatans.id')
        ->groupBy('mitras.kecamatan')
        ->select('mitras.kecamatan', DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
        
        //->selectRaw('mitras.kecamatan AS mitraz','sum(kegiatan_mitras.total_nilai)')
        ->get();


       $kecamatan_bar=[];
       $count_bar=[];
       foreach ($count_kecamatan as $key => $kec) {
           $kecamatan_bar[]=$kec->kecamatan;
           $count_bar[]=$kec->count;
       }
       
       
       $kecamatans=['010','020','030','040','050'];
       
       foreach ($kecamatans as $key => $data) {
           if(is_array($kecamatan_bar)){
            if(in_array($data,$kecamatan_bar)==false){
                array_push($kecamatan_bar,$data);
                array_push($count_bar,0); 
             }
           }

       }

       

        
        return view('dashboard.dashboard')
        ->with('kegiatan',$kegiatan)
        ->with('kecamatan_bar',$kecamatan_bar)
        ->with('count_bar',$count_bar);
       // ->with('kecamatan',$kecamatans);
    }
}
