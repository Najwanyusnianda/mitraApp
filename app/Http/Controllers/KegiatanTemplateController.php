<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kegiatan;

class KegiatanTemplateController extends Controller
{
    //

    public function getTemplateSertifikat($id){
        $kegiatan=Kegiatan::find($id);
        return response()->download(storage_path('app/'.$kegiatan->template_sertifikat_path));
    }

    public function getTemplateSPK($id){
        $kegiatan=Kegiatan::find($id);
        return response()->download(storage_path('app/'.$kegiatan->template_spk_path));
    }
}
