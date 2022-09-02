<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Normalisasi;
use App\Models\Kriteria;
use App\Models\Periode;

class NormalisasiController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }
        
        $cariperiode = Periode::where('periode', $periode)->first();
        $normalisasi   = Normalisasi::where('id_periode', $cariperiode->id)->paginate(10);
        $kriteria   = Kriteria::all();
        return view('dashboard.normalisasi.index', [
            'title' => 'Normalisasi',
            'active' => 'normalisasi',
            'normalisasi' => $normalisasi,
            'kriteria' => $kriteria,
            'periode' => $periode,
            'no' => 1
        ]);
    }
}
