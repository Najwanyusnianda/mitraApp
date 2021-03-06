<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Exports\KegiatanMitraExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\KegiatanMitra;
use App\Mitra;
use App\Kegiatan;
//use File;
use ZipArchive;

class OutputController extends Controller
{
    //


    public function getSertifikat($kegiatan_id,$mitra_id)
    {

        $mitra=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->where('mitra_id',$mitra_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.nik AS nik','kegiatan_mitras.nilai_pelatihan1 AS avg_pelatihan',
        'kegiatan_mitras.nilai_pelaksanaan1 AS avg_pelaksanaan',
        'kegiatan_mitras.nilai_evaluasi1 AS avg_evaluasi',
        'kegiatans.pelatihan_mulai AS pelatihan_mulai',
        'kegiatans.pelatihan_selesai AS pelatihan_selesai',
        'kegiatans.pelaksanaan_mulai AS pelaksanaan_mulai',
        'kegiatans.pelaksanaan_selesai AS pelaksanaan_selesai',
        'kegiatans.template_sertifikat_path AS template_sertifikat',
        'kegiatans.template_spk_path AS template_spk')
        ->first();
        
        
        \PhpOffice\PhpWord\Settings::setPdfRendererPath('../vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        //atribut sertifikat
        $name=$mitra->name;
        $kegiatan_write= 'Pelatihan'.' '.$mitra->nama_kegiatan;
        $mulai=\Carbon\Carbon::parse($mitra->pelatihan_mulai)->translatedFormat('d F');
        $selesai=\Carbon\Carbon::parse($mitra->pelatihan_selesai)->translatedFormat('d F Y');
        $tanggal_pelatihan=$mulai.' - '.$selesai; 
        $template= new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/'.$mitra->template_sertifikat));
        $template->setValue('nama_lengkap',$name);
        $template->setValue('kegiatan',$kegiatan_write);
        $template->setValue('tanggal_pelatihan',$tanggal_pelatihan);
        //$filename=$mitra->name.'_'.$mitra->nama_kegiatan.'.docx';
        /*header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        $template->saveAs('php://output');*/
        
       /* $path=storage_path('data/sertifikat/doc/'.$mitra->nama_kegiatan.'.docx');
        $template->saveAs($path);*/


        //make dir


        //define path
        $filename_doc=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.docx';
        $filename_pdf=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.pdf';
        $save_path='app/Data/'.$mitra->nama_kegiatan.'/sertifikat'.'/'.$filename_doc;
        $save_path_pdf='app/Data/'.$mitra->nama_kegiatan.'/sertifikat'.'/'.$filename_pdf;
        $path=storage_path($save_path);
        
        $template->saveAs($path);
       // $temp= \PhpOffice\PhpWord\IOFactory::load($path);
        //$xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
        //$xmlWriter->save(storage_path($save_path_pdf),TRUE);

        //header('Content-Type: application/pdf');
        //header('Content-Disposition: inline; filename='.$filename_pdf);
        return response()->download(storage_path($save_path));
       // return response()->file(storage_path($save_path_pdf),['Content-Type: application/pdf','Content-Disposition: inline; filename=download']);
        /*header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        $template->saveAs('php://output');*/



        /*$path=storage_path('ss.docx');
        $template->saveAs($path);
        $temp= \PhpOffice\PhpWord\IOFactory::load($path);
        $xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
        $xmlWriter->save(storage_path('ss.pdf'),TRUE);
        return response()->download(storage_path('ss.pdf'));*/
    }

    public function getSPK($kegiatan_id,$mitra_id){
        $mitra=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->where('mitra_id',$mitra_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.kecamatan AS kecamatan',
        'mitras.nik AS nik','kegiatan_mitras.nilai_pelatihan1 AS avg_pelatihan',
        'kegiatan_mitras.nilai_pelaksanaan1 AS avg_pelaksanaan',
        'kegiatan_mitras.nilai_evaluasi1 AS avg_evaluasi',
        'kegiatans.pelatihan_mulai AS pelatihan_mulai',
        'kegiatans.pelatihan_selesai AS pelatihan_selesai',
        'kegiatans.pelaksanaan_mulai AS pelaksanaan_mulai',
        'kegiatans.pelaksanaan_selesai AS pelaksanaan_selesai',
        'kegiatans.template_sertifikat_path AS template_sertifikat',
        'kegiatans.template_spk_path AS template_spk',
        'kegiatans.tahun AS tahun')
        ->first();
        
        
        \PhpOffice\PhpWord\Settings::setPdfRendererPath('../vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        //atribut sertifikat
        $name=$mitra->name;
        $tanggal_mulai=\Carbon\Carbon::parse($mitra->pelaksanaan_mulai)->translatedFormat('d F Y');
        $tanggal_selesai=\Carbon\Carbon::parse($mitra->pelaksanaan_selesai)->translatedFormat('d F Y');
        $kec=$mitra->kecamatan;
        if($kec=='010'){
            $kecamatan='Simpang Kiri';
           }elseif($kec=='020'){
            $kecamatan='Penanggalan';
           }elseif($kec=='030'){
            $kecamatan='Rundeng';
           }elseif($kec=='040'){
            $kecamatan='Sultan Daulat';
           }else{
            $kecamatan='Longkib';
           }

           $kegiatan_write= $mitra->nama_kegiatan.' '.$mitra->tahun;


        $template= new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/'.$mitra->template_spk));
        $template->setValue('nama_lengkap',$name);

        $template->setValue('kegiatan',$kegiatan_write);
        $template->setValue('tanggal_mulai',$tanggal_mulai);
        $template->setValue('tanggal_selesai',$tanggal_selesai);
        $template->setValue('kecamatan',$kecamatan);

        //define path
        $filename_doc=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.docx';
        $filename_pdf=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.pdf';
        $save_path='app/Data/'.$mitra->nama_kegiatan.'/spk'.'/'.$filename_doc;
        $save_path_pdf='app/Data/'.$mitra->nama_kegiatan.'/spk'.'/'.$filename_pdf;
        $path=storage_path($save_path);
        
        $template->saveAs($path);
        //$temp= \PhpOffice\PhpWord\IOFactory::load($path);
       // $xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
       // $xmlWriter->save(storage_path($save_path_pdf),TRUE);

        return response()->download(storage_path($save_path));
    }

    public function getBulkSPK($kegiatan_id){
        $kegiatan=Kegiatan::find($kegiatan_id);     
        $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.kecamatan AS kecamatan',
        'mitras.nik AS nik','kegiatan_mitras.nilai_pelatihan1 AS avg_pelatihan',
        'kegiatan_mitras.nilai_pelaksanaan1 AS avg_pelaksanaan',
        'kegiatan_mitras.nilai_evaluasi1 AS avg_evaluasi',
        'kegiatans.pelatihan_mulai AS pelatihan_mulai',
        'kegiatans.pelatihan_selesai AS pelatihan_selesai',
        'kegiatans.pelaksanaan_mulai AS pelaksanaan_mulai',
        'kegiatans.pelaksanaan_selesai AS pelaksanaan_selesai',
        'kegiatans.template_sertifikat_path AS template_sertifikat',
        'kegiatans.template_spk_path AS template_spk',
        'kegiatans.tahun AS tahun')
        ->get();


        \PhpOffice\PhpWord\Settings::setPdfRendererPath('../vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        //atribut sertifikat

      
        //dd($mitras);
        foreach ($mitras as $mitra) {
            $template= new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/'.$kegiatan->template_spk_path));
            # code...
            $name=$mitra->name;
        $tanggal_mulai=\Carbon\Carbon::parse($mitra->pelaksanaan_mulai)->translatedFormat('d F Y');
        $tanggal_selesai=\Carbon\Carbon::parse($mitra->pelaksanaan_selesai)->translatedFormat('d F Y');
        $kec=$mitra->kecamatan;
        if($kec=='010'){
            $kecamatan='Simpang Kiri';
           }elseif($kec=='020'){
            $kecamatan='Penanggalan';
           }elseif($kec=='030'){
            $kecamatan='Rundeng';
           }elseif($kec=='040'){
            $kecamatan='Sultan Daulat';
           }else{
            $kecamatan='Longkib';
           }

           $kegiatan_write= $mitra->nama_kegiatan.' '.$mitra->tahun;


            
            $template->setValue('nama_lengkap',$name);
            
        $template->setValue('kegiatan',$kegiatan_write);
        $template->setValue('tanggal_mulai',$tanggal_mulai);
        $template->setValue('tanggal_selesai',$tanggal_selesai);
        $template->setValue('kecamatan',$kecamatan);

            $filename_doc=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.docx';
        
            $filename_pdf=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.pdf';
            
            $save_path='app/Data/'.$mitra->nama_kegiatan.'/spk'.'/'.$filename_doc;
            $save_path_pdf='app/Data/'.$mitra->nama_kegiatan.'/spk'.'/'.$filename_pdf;
          
            $path=storage_path($save_path);
        

             $template->saveAs($path);
                
            // $temp= \PhpOffice\PhpWord\IOFactory::load($path);
                
            // $xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
            // $xmlWriter->save(storage_path($save_path_pdf),TRUE);
             }
            
             $zip = new ZipArchive;


            $zipname='spk.zip';
             if ($zip->open(public_path($zipname), ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE === TRUE)) {
              # code...
              $files=File::files(storage_path('app/Data/'.$kegiatan->nama_kegiatan.'/spk'));
              foreach ($files as $key => $value) {
                  $relativeName=basename($value);
                
                  $zip->addFile($value,$relativeName);
                }

            }
            $zip->close();
            return response()->download(public_path($zipname))->deleteFileAfterSend(true);
    }


    public function getBulk($kegiatan_id){

        
                    // Define Dir Folder
        $kegiatan=Kegiatan::find($kegiatan_id);     
        $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.nik AS nik','kegiatan_mitras.nilai_pelatihan1 AS avg_pelatihan',
        'kegiatan_mitras.nilai_pelaksanaan1 AS avg_pelaksanaan',
        'kegiatan_mitras.nilai_evaluasi1 AS avg_evaluasi')
        ->get();


        \PhpOffice\PhpWord\Settings::setPdfRendererPath('../vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        //atribut sertifikat

      
        //dd($mitras);
        foreach ($mitras as $mitra) {
            $template= new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/'.$kegiatan->template_sertifikat_path));
            # code...
            $name=$mitra->name;
        $kegiatan_write= 'Pelatihan'.' '.$mitra->nama_kegiatan;
        $mulai=\Carbon\Carbon::parse($mitra->pelatihan_mulai)->translatedFormat('d F');
        $selesai=\Carbon\Carbon::parse($mitra->pelatihan_selesai)->translatedFormat('d F Y');
        $tanggal_pelatihan=$mulai.' - '.$selesai; 

        $template->setValue('nama_lengkap',$name);
        $template->setValue('kegiatan',$kegiatan_write);
        $template->setValue('tanggal_pelatihan',$tanggal_pelatihan);
            $filename_doc=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.docx';
        
            $filename_pdf=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.pdf';
            
            $save_path='app/Data/'.$mitra->nama_kegiatan.'/sertifikat'.'/'.$filename_doc;
            $save_path_pdf='app/Data/'.$mitra->nama_kegiatan.'/sertifikat'.'/'.$filename_pdf;
          
            $path=storage_path($save_path);
        

        $template->saveAs($path);
        
       // $temp= \PhpOffice\PhpWord\IOFactory::load($path);

        //$xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
        //$xmlWriter->save(storage_path($save_path_pdf),TRUE);
        }



                    // Create ZipArchive Obj
        $zip = new ZipArchive;
        /*$zipname='myzip.zip';
        if ($zip->open(public_path($zipname), ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE === TRUE)) {
            # code...
            $files=File::files(public_path('myfiles'));
            foreach ($files as $key => $value) {
                $relativeName=basename($value);
            
                $zip->addFile($value,$relativeName);
            }

        }
       $zip->close();
       return response()->download(public_path($zipname))->deleteFileAfterSend(true);*/

       $zipname='sertifikat.zip';
        if ($zip->open(public_path($zipname), ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE === TRUE)) {
            # code...
            $files=File::files(storage_path('app/Data/'.$kegiatan->nama_kegiatan.'/sertifikat'));
            foreach ($files as $key => $value) {
                $relativeName=basename($value);
            
                $zip->addFile($value,$relativeName);
            }

        }
       $zip->close();
       return response()->download(public_path($zipname))->deleteFileAfterSend(true);

            // Set Header
         
    }


    public function getSpj($kegiatan_id){
        $kegiatan=Kegiatan::find($kegiatan_id);
        $mitras=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','kegiatan_mitras.mitra_id','=','mitras.id')
        ->select('mitras.name','mitras.kecamatan')
        ->get();
       
        $count_mitra=count($mitras);
        $nama_kecamatan=['Simpang Kiri','Penanggalan','Rundeng','Sultan Daulat','Longkib'];

        $tanggal_pelatihan=\Carbon\Carbon::parse($kegiatan->pelatihan_mulai)->translatedFormat('l,d F Y');
        $tahun=$kegiatan->tahun;

        $temp_path='app/spj/spj_temp.xlsx';
        $load_path=storage_path($temp_path);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($load_path);
        $worksheet1 = $spreadsheet->getSheet(0);
        $worksheet1->setCellValueByColumnAndRow(1,2,'Peserta Pelatihan '.$kegiatan->nama_kegiatan.' '.$kegiatan->tahun);
       // $workshee
        //insert new row;
        $worksheet1->insertNewRowBefore(13, $count_mitra);
        $worksheet1->setCellValue('D6', $tanggal_pelatihan);
        $worksheet1->setCellValueByColumnAndRow(6,24+$count_mitra,$tanggal_pelatihan);
        foreach ($mitras as $key => $mitra) {
            $kec=$mitra->kecamatan;
           if($kec=='010'){
            $kecamatan='Simpang Kiri';
           }elseif($kec=='020'){
            $kecamatan='Penanggalan';
           }elseif($kec=='030'){
            $kecamatan='Rundeng';
           }elseif($kec=='040'){
            $kecamatan='Sultan Daulat';
           }else{
            $kecamatan='Longkib';
           }
      
            $worksheet1->setCellValueByColumnAndRow(1,12+$key,$key+1);
            $worksheet1->setCellValueByColumnAndRow(2,12+$key,$mitra->name);
            $worksheet1->setCellValueByColumnAndRow(3,12+$key,'');
            if(($key+1)%2 == 0){
                $worksheet1->setCellValueByColumnAndRow(5,12+$key,($key+1).'.');
                $worksheet1->setCellValueByColumnAndRow(6,12+$key,'………………');
            }else{
                $worksheet1->setCellValueByColumnAndRow(7,12+$key,($key+1).'.');
                $worksheet1->setCellValueByColumnAndRow(8,12+$key,'………………');
            }
            
        }


        $worksheet2=$spreadsheet->getSheet(1);
        $worksheet2->insertNewRowBefore(18, $count_mitra);
        $worksheet2->setCellValue('C3',': '.$tahun);
        $worksheet2->setCellValue('C5',' Peserta Pelatihan '.$kegiatan->nama_kegiatan.' '.$kegiatan->tahun);
        $worksheet2->setCellValue('C11',': '.$tanggal_pelatihan);
        $worksheet2->setCellValueByColumnAndRow(7,29+$count_mitra,$tanggal_pelatihan);

        foreach ($mitras as $key => $mitra) {
            $worksheet2->setCellValueByColumnAndRow(1,18+$key,$key+1);
            $worksheet2->setCellValueByColumnAndRow(2,18+$key,$mitra->name);
            $worksheet2->setCellValueByColumnAndRow(3,18+$key,$kecamatan);
            if(($key+1)%2 == 0){
                $worksheet2->setCellValueByColumnAndRow(6,18+$key,($key+1).'.');
                $worksheet2->setCellValueByColumnAndRow(7,18+$key,'………………');
            }else{
                $worksheet2->setCellValueByColumnAndRow(8,18+$key,($key+1).'.');
                $worksheet2->setCellValueByColumnAndRow(9,18+$key,'………………');
            }
            
        }


        $worksheet3=$spreadsheet->getSheet(2);
        $worksheet3->insertNewRowBefore(18, $count_mitra);
        $worksheet3->setCellValue('C3',': '.$tahun);
        $worksheet3->setCellValue('C5',' Peserta Pelatihan '.$kegiatan->nama_kegiatan.' '.$kegiatan->tahun);
        $worksheet3->setCellValue('C11',': '.$tanggal_pelatihan);
        $worksheet3->setCellValueByColumnAndRow(8,29+$count_mitra,$tanggal_pelatihan);

        foreach ($mitras as $key => $mitra) {
            $worksheet3->setCellValueByColumnAndRow(1,18+$key,$key+1);
            $worksheet3->setCellValueByColumnAndRow(2,18+$key,$mitra->name);
           // $worksheet2->setCellValueByColumnAndRow(3,18+$key,$kecamatan);
            if(($key+1)%2 == 0){
                $worksheet3->setCellValueByColumnAndRow(7,18+$key,($key+1).'.');
                $worksheet3->setCellValueByColumnAndRow(8,18+$key,'………………');
            }else{
                $worksheet3->setCellValueByColumnAndRow(9,18+$key,($key+1).'.');
                $worksheet3->setCellValueByColumnAndRow(10,18+$key,'………………');
            }
            
        }

        $worksheet4=$spreadsheet->getSheet(3);
$worksheet4->insertNewRowBefore(18, $count_mitra);
$worksheet4->setCellValue('C3',': '.$tahun);
$worksheet4->setCellValue('C5',' Peserta Pelatihan '.$kegiatan->nama_kegiatan.' '.$kegiatan->tahun);
$worksheet4->setCellValue('C11',': '.$tanggal_pelatihan);
$worksheet4->setCellValueByColumnAndRow(8,29+$count_mitra,$tanggal_pelatihan);

foreach ($mitras as $key => $mitra) {
    $kec=$mitra->kecamatan;
           if($kec=='010'){
            $kecamatan='Simpang Kiri';
           }elseif($kec=='020'){
            $kecamatan='Penanggalan';
           }elseif($kec=='030'){
            $kecamatan='Rundeng';
           }elseif($kec=='040'){
            $kecamatan='Sultan Daulat';
           }else{
            $kecamatan='Longkib';
           }
    $worksheet4->setCellValueByColumnAndRow(1,18+$key,$key+1);
    $worksheet4->setCellValueByColumnAndRow(2,18+$key,$mitra->name);
    $worksheet2->setCellValueByColumnAndRow(3,18+$key,$kecamatan);
    if(($key+1)%2 == 0){
        $worksheet4->setCellValueByColumnAndRow(7,18+$key,($key+1).'.');
        $worksheet4->setCellValueByColumnAndRow(8,18+$key,'………………');
    }else{
        $worksheet4->setCellValueByColumnAndRow(9,18+$key,($key+1).'.');
        $worksheet4->setCellValueByColumnAndRow(10,18+$key,'………………');
    }
    
}

        $name_file=$kegiatan->nama_kegiatan.'.xlsx';
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($name_file);
        return response()->download($name_file)->deleteFileAfterSend(true);

    }



}
