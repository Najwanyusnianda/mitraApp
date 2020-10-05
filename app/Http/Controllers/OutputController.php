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


    public function getSertifikat($kegiatan_id,$mitra_id){

        $mitra=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->where('mitra_id',$mitra_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.nik AS nik','kegiatan_mitras.nilai_pelatihan1 AS avg_pelatihan',
        'kegiatan_mitras.nilai_pelaksanaan1 AS avg_pelaksanaan',
        'kegiatan_mitras.nilai_evaluasi1 AS avg_evaluasi')
        ->first();
        
        
        \PhpOffice\PhpWord\Settings::setPdfRendererPath('../vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        //atribut sertifikat
        $name=$mitra->name;



        $template= new \PhpOffice\PhpWord\TemplateProcessor(storage_path('template/sertifikat/template_sertifikat.docx'));
        $template->setValue('nama_lengkap',$name);

        //$filename=$mitra->name.'_'.$mitra->nama_kegiatan.'.docx';
        /*header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        $template->saveAs('php://output');*/
        
       /* $path=storage_path('data/sertifikat/doc/'.$mitra->nama_kegiatan.'.docx');
        $template->saveAs($path);*/


        //make dir
        Storage::makeDirectory('data/sertifikat/doc/'.$mitra->nama_kegiatan);
        Storage::makeDirectory('data/sertifikat/pdf/'.$mitra->nama_kegiatan);

        //define path
        $filename_doc=$mitra->name.'_'.$mitra->nama_kegiatan.'.docx';
        $filename_pdf=$mitra->name.'_'.$mitra->nama_kegiatan.'.pdf';
        $save_path='app/data/sertifikat/doc/'.$mitra->nama_kegiatan.'/'.$filename_doc;
        $save_path_pdf='app/data/sertifikat/pdf/'.$mitra->nama_kegiatan.'/'.$filename_pdf;
        $path=storage_path($save_path);
        
        $template->saveAs($path);
        $temp= \PhpOffice\PhpWord\IOFactory::load($path);
        $xmlWriter= \PhpOffice\PhpWord\IOFactory::createWriter($temp,'PDF');
        $xmlWriter->save(storage_path($save_path_pdf),TRUE);

        //header('Content-Type: application/pdf');
        #header('Content-Disposition: inline; filename='.$filename_pdf);
        //return response()->download(storage_path($save_path_pdf));
        return response()->file(storage_path($save_path_pdf),['Content-Type: application/pdf','Content-Disposition: inline; filename=download']);
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
}
