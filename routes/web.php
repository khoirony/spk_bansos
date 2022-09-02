<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\SolusiController;
use App\Http\Controllers\MatriksController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TerbobotController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\NormalisasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    return view('dashboard.index', [
        'title' => 'Dashboard',
        'active' => 'dashboard'
    ]);
})->middleware('auth');

//Kriteria
Route::get('/kriteria', [KriteriaController::class, 'index'])->middleware('auth');
Route::get('/tambahkriteria', [KriteriaController::class, 'create'])->middleware('auth');
Route::post('/kriteriastore', [KriteriaController::class, 'store'])->middleware('auth');
Route::get('/editkriteria/{id}', [KriteriaController::class, 'edit'])->middleware('auth');
Route::post('/updatekriteria/{id}', [KriteriaController::class, 'update'])->middleware('auth');
Route::get('/hapuskriteria/{id}', [KriteriaController::class, 'destroy'])->middleware('auth');

//SubKriteria
Route::get('/tambahsubkriteria/{id}', [KriteriaController::class, 'subcreate'])->middleware('auth');
Route::post('/substore', [KriteriaController::class, 'substore'])->middleware('auth');
Route::get('/subedit/{id}', [KriteriaController::class, 'subedit'])->middleware('auth');
Route::post('/subupdate/{id}', [KriteriaController::class, 'subupdate'])->middleware('auth');
Route::get('/subhapus/{id}', [KriteriaController::class, 'subdestroy'])->middleware('auth');

//Warga
Route::get('/warga', [WargaController::class, 'index'])->middleware('auth');
Route::get('/tambahwarga', [WargaController::class, 'create'])->middleware('auth');
Route::post('/wargastore', [WargaController::class, 'store'])->middleware('auth');
Route::get('/editwarga/{id}', [WargaController::class, 'edit'])->middleware('auth');
Route::post('/updatewarga/{id}', [WargaController::class, 'update'])->middleware('auth');
Route::get('/hapuswarga/{id}', [WargaController::class, 'destroy'])->middleware('auth');


//Alternatif
Route::get('/search', [AlternatifController::class, 'search'])->name('search')->middleware('auth');
Route::get('/editalternatif/{id}', [AlternatifController::class, 'edit'])->middleware('auth');
Route::post('/editalternatif/{id}', [AlternatifController::class, 'edit'])->middleware('auth');
Route::put('/updatealternatif/{id}', [AlternatifController::class, 'update'])->middleware('auth');

Route::get('/matriks', [MatriksController::class, 'index'])->middleware('auth');
Route::post('/matriks', [MatriksController::class, 'index'])->middleware('auth');

Route::get('/normalisasi', [NormalisasiController::class, 'index'])->middleware('auth');
Route::post('/normalisasi', [NormalisasiController::class, 'index'])->middleware('auth');

Route::get('/terbobot', [TerbobotController::class, 'index'])->middleware('auth');
Route::post('/terbobot', [TerbobotController::class, 'index'])->middleware('auth');

Route::get('/solusi', [SolusiController::class, 'index'])->middleware('auth');
Route::post('/solusi', [SolusiController::class, 'index'])->middleware('auth');

Route::get('/preferensi', [PreferensiController::class, 'index'])->middleware('auth');
Route::post('/preferensi', [PreferensiController::class, 'index'])->middleware('auth');