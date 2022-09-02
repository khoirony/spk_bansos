<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Positifnegatif;
use App\Models\Dpositif;
use App\Models\Dnegatif;
use App\Models\Kriteria;

class SolusiController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }

        $positifnegatif = Positifnegatif::where('periode', $periode)->get();
        $dpositif = Dpositif::where('periode', $periode)->paginate(10);
        $dnegatif = Dnegatif::where('periode', $periode)->paginate(10);
        $kriteria   = Kriteria::all();
        return view('dashboard.solusi.index', [
            'title' => 'Solusi Ideal Positif dan Negatif',
            'active' => 'solusi',
            'positifnegatif' => $positifnegatif,
            'dpositif' => $dpositif,
            'dnegatif' => $dnegatif,
            'kriteria' => $kriteria,
            'periode' => $periode,
            'no' => 1
        ]);
    }
}
