<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Periode;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\Normalisasi;
use App\Models\Terbobot;
use App\Models\Positifnegatif;
use App\Models\Dpositif;
use App\Models\Dnegatif;
use App\Models\Preferensi;

class AlternatifController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->search;
        $warga = warga::where('name', 'like', "%" . $keyword . "%")->paginate(10);
        return view('dashboard.warga.index', [
            'title' => 'Hasil Pencarian dari : '.$keyword,
            'active' => 'warga',
            'warga' => $warga,
            'no' => 1
        ]);
    }

    public function edit(Request $request, $id)
    {
        $periode = $request->periode;
        if($periode == 0){
            $periode =  date("Y-m");
        }

        $hitungperiode = Periode::where('periode', $periode)->count();
        if($hitungperiode == 0){
            $periode2 = new Periode;
            $periode2->periode = $periode;
            $periode2->save();
        }
        $cariperiode = Periode::where('periode', $periode)->first();
        // $alternatif = Alternatif::where('id_warga', $id)->where('id_periode', $cariperiode->id)->first();
        $cekalternatif = Alternatif::where('id_warga', $id)->where('id_periode', $cariperiode->id)->count();
        $warga = Warga::where('id', $id)->first();

        if($cekalternatif == 0){
            $kriteria   = Kriteria::all();
        }else{
            $kriteria   = Kriteria::join('alternatifs', 'kriterias.id', '=', 'alternatifs.id_kriteria')->where('alternatifs.id_warga', $id)->where('alternatifs.id_periode', $cariperiode->id)->get(['kriterias.id','kriterias.nama_kriteria','alternatifs.nilai_alternatif']);
        }

        return view('dashboard.alternatif.edit',[
            'title' => 'Edit Data',
            'active' => 'warga',
            'kriteria' => $kriteria,
            // 'alternatif' => $alternatif,
            'cekalternatif' => $cekalternatif,
            'warga' => $warga,
            'periode' => $periode,
        ]);
    }

    public function update(Request $request, $id)
    {
        $cariperiode = Periode::where('periode', $request->input('periode'))->first();
        $cekalternatif = Alternatif::where('id_warga', $id)->where('id_periode', $cariperiode->id)->count();


        $kriteria   = Kriteria::all();
        foreach ($kriteria as $k){
            //cek alternatif untuk tambah/edit alternatif | buka
            if($cekalternatif == 0){
                $alternatif = new Alternatif;
                $alternatif->id_warga = $id;
                $alternatif->id_kriteria = $k->id;

                //ngecekperiode ada/tidak, tambah jika tidak ada
                $cekperiode = Periode::where('periode', $request->input('periode'))->count();
                if($cekperiode == 0){
                    $periode = new Periode;
                    $periode->periode = $request->input('periode');
                    $periode->save();
                }
                $cariperiode = Periode::where('periode', $request->input('periode'))->first();
                $alternatif->id_periode = $cariperiode->id;
            }else{
                $cariperiode = Periode::where('periode', $request->input('periode'))->first();
                $alternatif = Alternatif::where('id_warga', $id)->where('id_periode', $cariperiode->id)->first();
            }

            // echo $request->input('nilai_alternatif'.$k->id);
            $alternatif->nilai_alternatif = $request->input('nilai_alternatif'.$k->id);

            //cek alternatif untuk tambah/edit alternatif | tutup
            if($cekalternatif == 0){
                $alternatif->save();
            }else{
                $alternatif->update();
            }
        }



        // $periode = $request->input('periode');
        $this->_hitung($request->input('periode'));
        $warga = Warga::where('id', $id)->first();
        return redirect('/warga')->with('success', 'Data Alternatif Sukses Ditambakan pada '.$warga->name);
    }

    private function _hitung($periode)
	{
        ## Mencari Pembagi ##
        $cariperiode = Periode::where('periode', $periode)->first(); //cariperiode
        $alternatif = Alternatif::where('id_periode', $cariperiode->id)->get(); //ambil alternatif sesuai periode
        
        $kriteria = Kriteria::all();
        foreach ($kriteria as $k){
            $hasil[$k->id] = 0;
            foreach ($k->alternatif as $alt){
                $temp = pow($alt->nilai_alternatif, 2);
                $hasil[$k->id] += $temp;
            }
        }

        ## Mengisi Tabel Normalisasi ##
        $kriteria = Kriteria::all();
        foreach ($kriteria as $k){
            foreach ($k->alternatif as $alt){
                //cari normalisasi ada apa tidak
                $ceknormalisasi = Normalisasi::where('id_warga', $alt->id_warga)->where('id_periode', $alt->id_periode)->where('id_kriteria', $k->id)->count();

                //cek normalisasi untuk tambah/edit normalisasi | buka
                if($ceknormalisasi == 0){
                    $normalisasi = new Normalisasi;
                }else{
                    $normalisasi = Normalisasi::where('id_warga', $alt->id_warga)->where('id_periode', $alt->id_periode)->where('id_kriteria', $k->id)->first();
                }
                
                //isi normalisasi
                $normalisasi->id_warga = $alt->id_warga;
                $normalisasi->id_kriteria = $k->id;
                $normalisasi->id_periode = $alt->id_periode;
                $normalisasi->nilai_normalisasi = $alt->nilai_alternatif/sqrt($hasil[$k->id]);
    
                //cek normalisasi untuk tambah/edit normalisasi | tutup
                if($ceknormalisasi == 0){
                    $normalisasi->save();
                }else{
                    $normalisasi->update();
                }
            }
        }


        ## Mengisi Tabel Normalisasi Terbobot ##
        $kriteria = Kriteria::all();
        foreach ($kriteria as $k){
            foreach ($k->normalisasi as $nor){
                //cari terbobot ada apa tidak
                $cekterbobot = Terbobot::where('id_warga', $nor->id_warga)->where('id_periode', $nor->id_periode)->where('id_kriteria', $k->id)->count();

                //cek terbobot untuk tambah/edit terbobot | buka
                if($cekterbobot == 0){
                    $terbobot = new Terbobot;
                }else{
                    $terbobot = Terbobot::where('id_warga', $nor->id_warga)->where('id_periode', $nor->id_periode)->where('id_kriteria', $k->id)->first();
                }
                
                //isi terbobot
                $terbobot->id_warga = $nor->id_warga;
                $terbobot->id_kriteria = $k->id;
                $terbobot->id_periode = $nor->id_periode;
                $terbobot->nilai_terbobot = $nor->nilai_normalisasi*$k->bobot_kriteria;
    
                //cek terbobot untuk tambah/edit terbobot | tutup
                if($cekterbobot == 0){
                    $terbobot->save();
                }else{
                    $terbobot->update();
                }
            }
        }

        

        //Mengisi Tabel PositifNegatif
        // Positifnegatif::where('periode', $periode)->delete();

        // $positifnegatif = new Positifnegatif;
        // $positifnegatif->name = 'Positif';

        // $kriteria = kriteria::all();
        // foreach ($kriteria as $k){
        //     $kolom = 'c'.$k->id;
        //     if($k->atribut == 'benefit'){
        //         $positifnegatif->$kolom = Terbobot::where('periode', $periode)->max('c'.$k->id);
        //     }else{
        //         $positifnegatif->$kolom = Terbobot::where('periode', $periode)->min('c'.$k->id);
        //     }
        // }
        // $positifnegatif->periode = $periode;
        // $positifnegatif->save();

        // $positifnegatif = new Positifnegatif;
        // $positifnegatif->name = 'Negatif';
        // foreach ($kriteria as $k){
        //     $kolom = 'c'.$k->id;
        //     if($k->atribut == 'benefit'){
        //         $positifnegatif->$kolom = Terbobot::where('periode', $periode)->min('c'.$k->id);
        //     }else{
        //         $positifnegatif->$kolom = Terbobot::where('periode', $periode)->max('c'.$k->id);
        //     }
        // }
        // $positifnegatif->periode = $periode;
        // $positifnegatif->save();



        //Mengisi Tabel D Positif
        // $positif = Positifnegatif::where('name', 'Positif')->where('periode', $periode)->first();
        $terbobot = Terbobot::where('id_periode', $cariperiode->id)->get();
        foreach ($terbobot as $t){
            foreach($t->kriteria as $k){
                
            }
        //     $kriteria = kriteria::all();
        //     $total = 0;
        //     foreach ($kriteria as $k){
        //         $kolom = 'c'.$k->id;
        //         $hasil = 0;
        //         $hasil = pow($positif->$kolom-$t['c'.$k->id], 2);
        //         $total += $hasil;
        //     }

        //     $dpositif = Dpositif::where('id_warga', $t->id_warga)->where('periode', $periode)->first();
        //     $dpositif->nilai = sqrt($total);
        //     $dpositif->periode = $t->periode;
        //     $dpositif->update();
        }

        //Mengisi Tabel D Negatif
        // $negatif = Positifnegatif::where('name', 'Negatif')->where('periode', $periode)->first();
        // $terbobot = Terbobot::where('periode', $periode)->get();
        // foreach ($terbobot as $t){
        //     $kriteria = kriteria::all();
        //     $total = 0;
        //     foreach ($kriteria as $k){
        //         $kolom = 'c'.$k->id;
        //         $hasil = 0;
        //         $hasil = pow($t['c'.$k->id]-$negatif->$kolom, 2);
        //         $total += $hasil;
        //     }

        //     $dnegatif = Dnegatif::where('id_warga', $t->id_warga)->where('periode', $periode)->first();
        //     $dnegatif->nilai = sqrt($total);
        //     $dnegatif->periode = $t->periode;
        //     $dnegatif->update();
        // }

        //Mengisi Tabel Preferensi
        // $dnegatif = Dnegatif::where('periode', $periode)->get();

        // foreach ($dnegatif as $dn){
        //     $dpositif = Dpositif::where('id_warga', $dn->id_warga)->where('periode', $periode)->first();
        //     $preferensi = Preferensi::where('id_warga', $dn->id_warga)->where('periode', $periode)->first();
        //     if($dn->nilai != null){
        //         $preferensi->nilai = $dn->nilai/($dn->nilai+$dpositif->nilai);
        //     }
        //     $preferensi->periode = $dn->periode;
        //     $preferensi->update();
        // }

        //Mengisi Rangking
        
        // $preferensi = Preferensi::where('periode', $periode)->orderBy('nilai', 'desc')->get();
        // $n=1;
        // foreach ($preferensi as $pre){
        //     $preferensi = Preferensi::find($pre['id']);
        //     $preferensi->rangking = $n++;
        //     $preferensi->update();
        // }

    }
}
