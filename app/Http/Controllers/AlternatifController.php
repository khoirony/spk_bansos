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

        $this->_hitung($request->input('periode'));
        $warga = Warga::where('id', $id)->first();
        return redirect('/warga')->with('success', 'Data Alternatif Sukses Ditambakan pada '.$warga->nama_warga);
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

        ## Mengisi Tabel D Positif
        $kriteriaterbobot   = Kriteria::join('terbobots', 'kriterias.id', '=', 'terbobots.id_kriteria')->where('terbobots.id_periode', $cariperiode->id)->orderBy('id', 'asc')->get(['terbobots.id','terbobots.id_kriteria','terbobots.id_warga','kriterias.nama_kriteria','kriterias.atribut_kriteria','terbobots.nilai_terbobot']);
        
        $total = 0;
        foreach ($kriteriaterbobot as $kt){
            //mencari solusi ideal positif tiap kriteria
            if($kt->atribut_kriteria == 'benefit'){
                $positif = Terbobot::where('id_periode', $cariperiode->id)->where('id_kriteria', $kt->id_kriteria)->max('nilai_terbobot');
            }else{
                $positif = Terbobot::where('id_periode', $cariperiode->id)->where('id_kriteria', $kt->id_kriteria)->min('nilai_terbobot');
            }

            //mengurangi solusi ideal positif dengan nilai terbobot dan mempangkat 2 hasilnya
            $hasil = pow($positif-$kt->nilai_terbobot, 2); 
            $total += $hasil; 

            //setelah kriteria terakhir maka hasil ditotal untuk dimasukkan ke dpositif
            $hitungkriteria = Kriteria::count();
            if($kt->id_kriteria == $hitungkriteria){
                //cari dpositif ada apa tidak
                $cekdpositif = Dpositif::where('id_warga', $kt->id_warga)->where('id_periode', $cariperiode->id)->count();

                //cek dpositif untuk tambah/edit dpositif | buka
                if($cekdpositif == 0){
                    $dpositif = new dpositif;
                }else{
                    $dpositif = dpositif::where('id_warga', $kt->id_warga)->where('id_periode', $cariperiode->id)->first();
                }
                
                //isi dpositif
                $dpositif->id_warga = $kt->id_warga;
                $dpositif->id_periode = $cariperiode->id;
                $dpositif->nilai_dpositif = sqrt($total);
    
                //cek dpositif untuk tambah/edit dpositif | tutup
                if($cekdpositif == 0){
                    $dpositif->save();
                }else{
                    $dpositif->update();
                }
                $total = 0;
            }
        }
        
        ## Mengisi Tabel D Negatif
        $kriteriaterbobot   = Kriteria::join('terbobots', 'kriterias.id', '=', 'terbobots.id_kriteria')->where('terbobots.id_periode', $cariperiode->id)->orderBy('id', 'asc')->get(['terbobots.id','terbobots.id_kriteria','terbobots.id_warga','kriterias.nama_kriteria','kriterias.atribut_kriteria','terbobots.nilai_terbobot']);
        $total = 0;
        foreach ($kriteriaterbobot as $kt){
            //mencari solusi ideal negatif tiap kriteria
            if($kt->atribut_kriteria == 'benefit'){
                $negatif = Terbobot::where('id_periode', $cariperiode->id)->where('id_kriteria', $kt->id_kriteria)->min('nilai_terbobot');
            }else{
                $negatif = Terbobot::where('id_periode', $cariperiode->id)->where('id_kriteria', $kt->id_kriteria)->max('nilai_terbobot');
            }

            //mengurangi solusi ideal negatif dengan nilai terbobot dan mempangkat 2 hasilnya
            $hasil = pow($kt->nilai_terbobot-$negatif, 2); 
            $total += $hasil;

            //setelah kriteria terakhir maka hasil ditotal untuk dimasukkan ke dnegatif
            $hitungkriteria = Kriteria::count();
            if($kt->id_kriteria == $hitungkriteria){
                //cari dnegatif ada apa tidak
                $cekdnegatif = Dnegatif::where('id_warga', $kt->id_warga)->where('id_periode', $cariperiode->id)->count();

                //cek dnegatif untuk tambah/edit dnegatif | buka
                if($cekdnegatif == 0){
                    $dnegatif = new Dnegatif;
                }else{
                    $dnegatif = Dnegatif::where('id_warga', $kt->id_warga)->where('id_periode', $cariperiode->id)->first();
                }
                
                //isi dnegatif
                $dnegatif->id_warga = $kt->id_warga;
                $dnegatif->id_periode = $cariperiode->id;
                $dnegatif->nilai_dnegatif = sqrt($total);
    
                //cek dnegatif untuk tambah/edit dnegatif | tutup
                if($cekdnegatif == 0){
                    $dnegatif->save();
                }else{
                    $dnegatif->update();
                }
                $total = 0;
            }
        }

        ## Mengisi Tabel Preferensi ##
        $dnegatif = Dnegatif::where('id_periode', $cariperiode->id)->get();
        foreach ($dnegatif as $dn){
            $dpositif = Dpositif::where('id_warga', $dn->id_warga)->where('id_periode', $cariperiode->id)->first();

            //cari preferensi ada apa tidak
            $cekpreferensi = preferensi::where('id_warga', $dn->id_warga)->where('id_periode', $cariperiode->id)->count();

            //cek preferensi untuk tambah/edit preferensi | buka
            if($cekpreferensi == 0){
                $preferensi = new preferensi;
            }else{
                $preferensi = preferensi::where('id_warga', $dn->id_warga)->where('id_periode', $cariperiode->id)->first();
            }
            
            //isi preferensi
            $preferensi->id_warga = $dn->id_warga;
            $preferensi->id_periode = $cariperiode->id;
            $preferensi->nilai_preferensi = $dn->nilai_dnegatif/($dn->nilai_dnegatif+$dpositif->nilai_dpositif);

            //cek preferensi untuk tambah/edit preferensi | tutup
            if($cekpreferensi == 0){
                $preferensi->save();
            }else{
                $preferensi->update();
            }
        }

        //Mengisi Rangking
        $preferensi = Preferensi::where('id_periode', $cariperiode->id)->orderBy('nilai_preferensi', 'desc')->get();
        $n=1;
        foreach ($preferensi as $pre){
            $preferensi = Preferensi::find($pre['id']);
            $preferensi->peringkat = $n++;
            $preferensi->update();
        }

    }
}
