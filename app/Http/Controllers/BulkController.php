<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BulkController extends Controller
{
    //
    public function getBulk($kegiatan_id){
                    // Define Dir Folder
                   
        $mitra=KegiatanMitra::where('kegiatan_id',$kegiatan_id)
        ->join('mitras','mitras.id','=','kegiatan_mitras.mitra_id')
        ->join('kegiatans','kegiatans.id','=','kegiatan_mitras.kegiatan_id')
        ->select('kegiatans.nama_kegiatan AS nama_kegiatan',
        'mitras.id AS id','mitras.name AS name','mitras.phone AS phone',
        'mitras.nik AS nik','kegiatan_mitras.nilai_pelatihan1 AS avg_pelatihan',
        'kegiatan_mitras.nilai_pelaksanaan1 AS avg_pelaksanaan',
        'kegiatan_mitras.nilai_evaluasi1 AS avg_evaluasi')
        ->get();
        

        $sertifikat_path='app/Data/'.$mitra->nama_kegiatan.'/sertifikat';
        $public_dir=storage_path($sertifikat_path);
        $zipFileName = 'Sertifikat.zip';
            // Create ZipArchive Obj
        $zip = new ZipArchive;
        $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
            $filetopath=$public_dir.'/'.$zipFileName;

        if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
                // Add File in ZipArchive

                foreach ($mitra as $mit) {
                    $filename_doc=$mit->name.'_'.$mit->nama_kegiatan.'.docx';
                $save_path='app/data/sertifikat/doc/'.$mit->nama_kegiatan.'/'.$filename_doc;
                $zip->addFile(storage_path($save_path),$filename_doc);
                }

                // Close ZipArchive     
                $zip->close();

                        // Close the archive.
                if ($zip->close()) {
                    // Archive is now downloadable ...
                    return response()->download($public_dir . '/' . $zipFileName, basename($public_dir . '/' . $zipFileName))->deleteFileAfterSend(true);
                } else {
                    throw new Exception("Could not close zip file: " . $archive->getStatusString());
                }
            }
            // Set Header
         
    }
}
