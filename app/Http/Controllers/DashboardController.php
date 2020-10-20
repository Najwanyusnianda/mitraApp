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

       $nama_kecamatan=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];
       
       foreach ($kecamatans as $key => $data) {
           if(is_array($kecamatan_bar)){
            if(in_array($data,$kecamatan_bar)==false){
                array_push($kecamatan_bar,$data);
                array_push($count_bar,0); 
             }
           }

       }

       $nama_kec=[];
       foreach ($kecamatan_bar as $key => $kec) {
           if($kec=='010'){
            $nama_kec[]='Simpang Kiri';
           }elseif($kec=='020'){
            $nama_kec[]='Penanggalan';
           }elseif($kec=='030'){
            $nama_kec[]='Rundeng';
           }elseif($kec=='040'){
            $nama_kec[]='Sultan Daulat';
           }else{
            $nama_kec[]='longkib';
           }
       }
       $kecamatan_bar=$nama_kec;
       $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan->id)
       ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
       ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
       ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
       'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
       'mitras.nik AS nik','kegiatan_mitras.avg_pelatihan AS avg_pelatihan',
       'kegiatan_mitras.avg_pelaksanaan AS avg_pelaksanaan',
       'kegiatan_mitras.avg_evaluasi AS avg_evaluasi',
       'kegiatan_mitras.total_nilai AS total_nilai', 'mitras.kecamatan AS kecamatan' )
       ->paginate(5);
       

        
        return view('dashboard.dashboard')
        ->with('kegiatan',$kegiatan)
        ->with('mitras',$mitras)
        ->with('kecamatan_bar',$kecamatan_bar)
        ->with('count_bar',$count_bar);
       // ->with('kecamatan',$kecamatans);
    }
}
