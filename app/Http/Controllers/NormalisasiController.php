<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\Normalisasi;
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

        if(!$cariperiode){
            return redirect('/warga')->with('success', 'Data periode ini belum ada harap diisi terlebuh dahulu');
        }else{
            $id_periode = $cariperiode->id;
        }

        $warga = Warga::paginate(10);
        $normalisasi = Normalisasi::where('id_periode', $id_periode)->get();
        $kriteria   = Kriteria::all();
        return view('dashboard.normalisasi.index', [
            'title' => 'Normalisasi',
            'active' => 'normalisasi',
            'warga' => $warga,
            'normalisasi' => $normalisasi,
            'kriteria' => $kriteria,
            'periode' => $periode,
            'no' => 1
        ]);
    }
}
