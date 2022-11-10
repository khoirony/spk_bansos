<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preferensi;
use App\Models\Periode;
use App\Models\Warga;

class PreferensiController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }
        $cariperiode = Periode::where('periode', $periode)->first();

        $sort = 0;
        if(!$request->sort){
            $sort = $request->sort;
        }

        if($sort == 1){
            $preferensi = Preferensi::where('id_periode', $cariperiode->id)->orderBy('peringkat', 'asc')->get();
        }else if($sort == 2){
            $preferensi = Preferensi::where('id_periode', $cariperiode->id)->orderBy('peringkat', 'desc')->get();
        }else if($sort == 0){
            $preferensi = Preferensi::where('id_periode', $cariperiode->id)->get();
        }

        echo "id: ". $sort;
        // $preferensi = Preferensi::where('id_periode', $cariperiode->id)->get();
        $warga = Warga::paginate(10);
        return view('dashboard.preferensi.index', [
            'title' => 'Preferensi',
            'active' => 'preferensi',
            'preferensi' => $preferensi,
            'warga' => $warga,
            'sort' => $sort,
            'periode' => $periode,
        ]);
    }
}
