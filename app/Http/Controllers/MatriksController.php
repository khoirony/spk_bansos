<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\Periode;

class MatriksController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }


        $cariperiode = Periode::where('periode', $periode)->first();

        if(!$cariperiode){
            return redirect('/warga')->with('success', 'Data periode ini belum ada');
        }else{
            $id_periode = $cariperiode->id;
        }

        $warga   = Warga::paginate(10);
        $matriks = Alternatif::where('id_periode', $id_periode)->get();
        $kriteria   = Kriteria::all();
        return view('dashboard.matriks.index', [
            'title' => 'Manage matriks',
            'active' => 'matriks',
            'matriks' => $matriks,
            'warga' => $warga,
            'kriteria' => $kriteria,
            'periode' => $periode,
            'no' => 1
        ]);
    }
}
