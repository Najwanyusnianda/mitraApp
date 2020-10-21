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
        ->whereNotNull('kegiatan_mitras.total_nilai')
        ->join('kecamatans','mitras.kecamatan','=','kecamatans.id')
        ->groupBy('mitras.kecamatan')
        ->select('mitras.kecamatan', DB::raw('AVG(kegiatan_mitras.total_nilai) as count'))
        
        //->selectRaw('mitras.kecamatan AS mitraz','sum(kegiatan_mitras.total_nilai)')
        ->get();


    if($count_kecamatan->isEmpty()){
        $kecamatan_bar=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];
        $count_bar=[0,0,0,0,0];
    }else{
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
            $nama_kec[]='Longkib';
           }
       }
       $kecamatan_bar=$nama_kec;

    }



       ///////////////////////////////////////////////////////
       $counts_kecamatan=DB::table('kegiatan_mitras')
        ->where('kegiatan_mitras.kegiatan_id',$kegiatan->id)
        ->join('mitras','kegiatan_mitras.mitra_id','=','mitras.id')
        ->join('kecamatans','mitras.kecamatan','=','kecamatans.id')
        ->groupBy('mitras.kecamatan')
        ->select('mitras.kecamatan', DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
        
        //->selectRaw('mitras.kecamatan AS mitra','sum(kegiatan_mitras.total_nilai)')
        ->get();

      if ($counts_kecamatan->isEmpty()) {
        $kecamatanx_bar=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];
        $countx_bar=[0,0,0,0,0];
      }else{
        $kecamatanx_bar=[];
       $countx_bar=[];
       foreach ($counts_kecamatan as $key => $kec) {
           $kecamatanx_bar[]=$kec->kecamatan;
           $countx_bar[]=$kec->count;
       }
       
       
       $kecamatans=['010','020','030','040','050'];

       $nama_kecamatan=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];
       
       foreach ($kecamatans as $key => $data) {
           if(is_array($kecamatanx_bar)){
            if(in_array($data,$kecamatanx_bar)==false){
                array_push($kecamatanx_bar,$data);
                array_push($countx_bar,0); 
             }
           }

       }

     

       $nama_kec=[];
       foreach ($kecamatanx_bar as $key => $kec) {
           if($kec=='010'){
            $nama_kec[]='Simpang Kiri';
           }elseif($kec=='020'){
            $nama_kec[]='Penanggalan';
           }elseif($kec=='030'){
            $nama_kec[]='Rundeng';
           }elseif($kec=='040'){
            $nama_kec[]='Sultan Daulat';
           }else{
            $nama_kec[]='Longkib';
           }
       }
       $kecamatanx_bar=$nama_kec;
      }
 


       //////////////////////////////////////////////////////
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

       $mitras_count=KegiatanMitra::where('kegiatan_id',$kegiatan->id)->count();
       $mitras_count_nilai=KegiatanMitra::where('kegiatan_id',$kegiatan->id)
       ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
       ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
       ->whereNotNull('kegiatan_mitras.total_nilai')
       ->count();

       /////////////////////////////////////////////
       $now_time=\Carbon\Carbon::now();
       $check_kegiatan_mitras=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
       ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
       ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
       ->WhereRaw('? BETWEEN kegiatans.pelaksanaan_mulai and pelaksanaan_selesai', [$now_time])
       ->groupBy('kegiatan_mitras.kegiatan_id')
       ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan','kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai',DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
       ->latest('kegiatans.created_at')
       ->get();


       $check_kegiatan_mitras_before=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
       ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
       ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
       ->Where('kegiatans.pelaksanaan_selesai','<',$now_time)
       ->groupBy('kegiatan_mitras.kegiatan_id')
       ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan','kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai',DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
       ->latest('kegiatans.created_at')
       ->get();

       $check_kegiatan_mitras_after=KegiatanMitra::query()->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
       ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
       ->join('master_kegiatans','kegiatans.master_kegiatan_id','=','master_kegiatans.id')
       ->Where('kegiatans.pelaksanaan_mulai','>',$now_time)
       ->groupBy('kegiatan_mitras.kegiatan_id')
       ->select('kegiatans.id AS id','master_kegiatans.seksi','kegiatans.nama_kegiatan','kegiatans.pelaksanaan_mulai','kegiatans.pelaksanaan_selesai','kegiatans.pelatihan_mulai','kegiatans.pelatihan_selesai',DB::raw('COUNT(kegiatan_mitras.mitra_id) as count'))
       ->latest('kegiatans.created_at')
       ->get();

        return view('dashboard.dashboard')
        ->with('kegiatan',$kegiatan)
        ->with('mitras',$mitras)
        ->with('kecamatan_bar',$kecamatan_bar)
        ->with('mitra_count',$mitras_count)
        ->with('mitra_count_nilai',$mitras_count_nilai)
        ->with('count_bar',$count_bar)
        ->with('kecamatanx_bar',$kecamatanx_bar)
        ->With('check_kegiatan_mitras',$check_kegiatan_mitras)
        ->With('check_kegiatan_mitras_before',$check_kegiatan_mitras_before)
        ->With('check_kegiatan_mitras_after',$check_kegiatan_mitras_after)
        ->with('countx_bar',$countx_bar);
       // ->with('kecamatan',$kecamatans);
    }

//-----------------------------------------------
    public function MitraDetail($kegiatan_id){
        $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.nik AS nik',
        'mitras.is_gadget AS is_gadget','mitras.is_kendaraan AS is_kendaraan',
        'mitras.kecamatan AS kecamatan')
        ->orderBy('kecamatan')
        ->paginate(10);

        return view('mitra_detail',compact('mitras'));
    }
    //---------------------------------------------------------

    public function MitraDetailNilai($kegiatan_id){
        $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.nik AS nik','kegiatan_mitras.avg_pelatihan AS avg_pelatihan',
        'kegiatan_mitras.avg_pelaksanaan AS avg_pelaksanaan',
        'kegiatan_mitras.avg_evaluasi AS avg_evaluasi',
        'kegiatan_mitras.total_nilai AS total_nilai', 'mitras.kecamatan AS kecamatan' )
        ->paginate(10);

        return view('mitra_detail_nilai',compact('mitras'));
    }
}
