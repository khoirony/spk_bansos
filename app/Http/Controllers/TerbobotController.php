<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\Periode;

class TerbobotController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }

        $cariperiode = Periode::where('periode', $periode)->first();
        $warga = Warga::paginate(10);
        $kriteria   = Kriteria::all();
        return view('dashboard.terbobot.index', [
            'title' => 'Normalisasi Terbobot',
            'active' => 'terbobot',
            'warga' => $warga,
            'kriteria' => $kriteria,
            'periode' => $periode,
            'no' => 1
        ]);
    }
}
