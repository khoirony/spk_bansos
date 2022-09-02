<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preferensi;

class PreferensiController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }

        if($request->sort == 1){
            $sort = $request->sort;
            $preferensi = Preferensi::where('periode', $periode)->orderBy('rangking', 'asc')->get();
        }else if($request->sort == 2){
            $sort = $request->sort;
            $preferensi = Preferensi::where('periode', $periode)->orderBy('rangking', 'desc')->get();
        }else{
            $sort = 0;
            $preferensi = Preferensi::where('periode', $periode)->get();
        }

        

        return view('dashboard.preferensi.index', [
            'title' => 'Preferensi',
            'active' => 'preferensi',
            'preferensi' => $preferensi,
            'sort' => $sort,
            'periode' => $periode,
        ]);
    }
}
