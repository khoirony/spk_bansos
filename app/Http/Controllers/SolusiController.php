<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dpositif;
use App\Models\Dnegatif;
use App\Models\Periode;
use App\Models\Warga;

class SolusiController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }

        $cariperiode = Periode::where('periode', $periode)->first();
        $dpositif = Dpositif::where('id_periode', $cariperiode->id)->get();
        $dnegatif = Dnegatif::where('id_periode', $cariperiode->id)->get();
        $warga = Warga::paginate(10);
        return view('dashboard.solusi.index', [
            'title' => 'Solusi Ideal Positif dan Negatif',
            'active' => 'solusi',
            'warga' => $warga,
            'dpositif' => $dpositif,
            'dnegatif' => $dnegatif,
            'periode' => $periode,
            'no_dp' => 1,
            'no_dn' => 1
        ]);
    }
}
