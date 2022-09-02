<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Alternatif;
use App\Models\Normalisasi;
use App\Models\Terbobot;
use App\Models\Positifnegatif;
use App\Models\Dpositif;
use App\Models\Dnegatif;
use App\Models\Preferensi;

class WargaController extends Controller
{
    public function index()
    {
        $warga   = Warga::paginate(10);
        return view('dashboard.warga.index', [
            'title' => 'Manage warga',
            'active' => 'warga',
            'warga' => $warga,
            'no' => 1
        ]);
    }

    public function create()
    {
        return view('dashboard.warga.tambah', [
            'title' => 'Tambah Warga',
            'active' => 'warga'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_warga' => 'required',
            'alamat_warga' => 'required'
        ]);

        Warga::create($request->all());

        $warga = Warga::all()->SortByDesc('id')->first();

        return redirect('/warga')->with('success', 'Warga Sukses Ditambahkan');
    }

    public function edit($id)
    {
        $warga = Warga::find($id);
        return view('dashboard.warga.edit',[
            'title' => 'Edit Warga',
            'active' => 'warga'
        ], compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $warga = Warga::find($id);
        $warga->nama_warga = $request->input('nama_warga');
        $warga->alamat_warga = $request->input('alamat_warga');
        $warga->update();

        return redirect('/warga')->with('success', 'Warga Sukses Diedit');
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::where('id_warga', $id)->delete();
        $normalisasi = Normalisasi::where('id_warga', $id)->delete();
        $terbobot = Terbobot::where('id_warga', $id)->delete();
        $dpositif = Dpositif::where('id_warga', $id)->delete();
        $dnegatif = Dnegatif::where('id_warga', $id)->delete();
        $preferensi = Preferensi::where('id_warga', $id)->delete();

        $warga = Warga::where('id', $id)->delete();
        return redirect('/warga')->with('success', 'Warga Sukses Dihapus');
    }
}
