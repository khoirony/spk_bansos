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
        $warga = Warga::paginate(10);
        return view('dashboard.solusi.index', [
            'title' => 'Solusi Ideal Positif dan Negatif',
            'active' => 'solusi',
            'warga' => $warga,
            'periode' => $periode,
            'no_dp' => 1,
            'no_dn' => 1
        ]);
    }
}
