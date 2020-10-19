<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class SertifikatController extends Controller
{
    //

    public function index(){

      
        $pdf = PDF::loadView('sertifikat');
        //return $pdf->stream();
        return $pdf->download('laporan-pdf.pdf');
        //return view('sertifikat');
    }
}
