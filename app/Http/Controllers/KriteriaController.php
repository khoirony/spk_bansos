<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\SubKriteria;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria   = Kriteria::paginate(10);
        return view('dashboard.kriteria.index', [
            'title' => 'Manage Kriteria',
            'active' => 'kriteria',
            'kriteria' => $kriteria,
            'no' => 1
        ]);
    }

    public function create()
    {
        return view('dashboard.kriteria.tambah', [
            'title' => 'Tambah Kriteria',
            'active' => 'kriteria'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'atribut_kriteria' => 'required',
            'bobot_kriteria' => 'required'
        ]);

        Kriteria::create($request->all());

        $kriteria = Kriteria::all()->SortByDesc('id')->first();

        return redirect('/kriteria')->with('success', 'Kriteria Sukses Ditambahkan');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view('dashboard.kriteria.edit',[
            'title' => 'Edit Kriteria',
            'active' => 'kriteria',
            'kriteria' => $kriteria
        ]);
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->nama_kriteria = $request->input('nama_kriteria');
        $kriteria->atribut_kriteria = $request->input('atribut_kriteria');
        $kriteria->bobot_kriteria = $request->input('bobot_kriteria');
        $kriteria->update();

        return redirect('/kriteria')->with('success', 'Kriteria Sukses Diedit');
    }

    public function destroy($id)
    {
        $subkriteria = Subkriteria::where('id_kriteria', $id)->delete();
        $kriteria = kriteria::where('id', $id)->delete();

        return redirect('/kriteria')->with('success', 'Kriteria Sukses Dihapus');
    }

    public function subcreate($id)
    {
        $kriteria   = Kriteria::find($id);
        return view('dashboard.subkriteria.tambah', [
            'title' => 'Tambah Sub Kriteria',
            'active' => 'kriteria',
            'id' => $id,
            'kriteria' => $kriteria
        ]);
    }

    public function substore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bobot' => 'required'
        ]);

        SubKriteria::create($request->all());

        return redirect('/kriteria')->with('success', 'Sub Kriteria Sukses Ditambahkan');
    }

    public function subedit($id)
    {
        $subkriteria = SubKriteria::find($id);
        return view('dashboard.subkriteria.edit',[
            'title' => 'Edit Sub Kriteria',
            'active' => 'kriteria'
        ], compact('subkriteria'));
    }

    public function subupdate(Request $request, $id)
    {
        $subkriteria = SubKriteria::find($id);
        $subkriteria->nama_sub_kriteria = $request->input('nama_sub_kriteria');
        $subkriteria->bobot_sub_kriteria = $request->input('bobot_sub_kriteria');
        $subkriteria->update();

        return redirect('/kriteria')->with('success', 'Sub kriteria Sukses Diedit');
    }

    public function subdestroy($id)
    {
        $subkriteria = Subkriteria::where('id', $id)->delete();
        return redirect('/kriteria')->with('success', 'Sub Kriteria Sukses Dihapus');
    }
}
