<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terbobot;
use App\Models\Kriteria;

class TerbobotController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }

        $terbobot   = Terbobot::where('periode', $periode)->paginate(10);
        $kriteria   = Kriteria::all();
        return view('dashboard.terbobot.index', [
            'title' => 'Normalisasi Terbobot',
            'active' => 'terbobot',
            'terbobot' => $terbobot,
            'kriteria' => $kriteria,
            'periode' => $periode,
            'no' => 1
        ]);
    }
}
