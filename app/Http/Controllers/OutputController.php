<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\KegiatanMitra;
use App\Mitra;
use App\Kegiatan;
use File;
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
        $template= new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/'.$mitra->template_sertifikat));
        $template->setValue('nama_lengkap',$name);

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
        $temp= \PhpOffice\PhpWord\IOFactory::load($path);
        $xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
        $xmlWriter->save(storage_path($save_path_pdf),TRUE);

        //header('Content-Type: application/pdf');
        #header('Content-Disposition: inline; filename='.$filename_pdf);
        return response()->download(storage_path($save_path));
        //return response()->file(storage_path($save_path_pdf),['Content-Type: application/pdf','Content-Disposition: inline; filename=download']);
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
        $template= new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/'.$mitra->template_spk));
        $template->setValue('nama_lengkap',$name);


        //define path
        $filename_doc=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.docx';
        $filename_pdf=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.pdf';
        $save_path='app/Data/'.$mitra->nama_kegiatan.'/spk'.'/'.$filename_doc;
        $save_path_pdf='app/Data/'.$mitra->nama_kegiatan.'/spk'.'/'.$filename_pdf;
        $path=storage_path($save_path);
        
        $template->saveAs($path);
        $temp= \PhpOffice\PhpWord\IOFactory::load($path);
        $xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
        $xmlWriter->save(storage_path($save_path_pdf),TRUE);

        return response()->download(storage_path($save_path));
    }

    public function getBulkSPK($kegiatan_id){
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
            $template= new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/'.$kegiatan->template_spk_path));
            # code...
            $name=$mitra->name;
            
            $template->setValue('nama_lengkap',$name);
            $filename_doc=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.docx';
        
            $filename_pdf=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.pdf';
            
            $save_path='app/Data/'.$mitra->nama_kegiatan.'/spk'.'/'.$filename_doc;
            $save_path_pdf='app/Data/'.$mitra->nama_kegiatan.'/spk'.'/'.$filename_pdf;
          
            $path=storage_path($save_path);
        

             $template->saveAs($path);
                
             $temp= \PhpOffice\PhpWord\IOFactory::load($path);
                
             $xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
             $xmlWriter->save(storage_path($save_path_pdf),TRUE);
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
            
            $template->setValue('nama_lengkap',$name);
            $filename_doc=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.docx';
        
            $filename_pdf=$mitra->name.'_'.$mitra->nama_kegiatan.'_'.$mitra->nik.'.pdf';
            
            $save_path='app/Data/'.$mitra->nama_kegiatan.'/sertifikat'.'/'.$filename_doc;
            $save_path_pdf='app/Data/'.$mitra->nama_kegiatan.'/sertifikat'.'/'.$filename_pdf;
          
            $path=storage_path($save_path);
        

        $template->saveAs($path);
        
        $temp= \PhpOffice\PhpWord\IOFactory::load($path);

        $xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
        $xmlWriter->save(storage_path($save_path_pdf),TRUE);
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


    public function getZip(){

    }



}
