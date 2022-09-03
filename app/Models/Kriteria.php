<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function subkriteria()
    {
        return $this->hasMany('App\Models\SubKriteria', 'id_kriteria');
    }
    public function alternatif()
    {
        return $this->hasMany('App\Models\Alternatif', 'id_kriteria');
    }
    public function normalisasi()
    {
        return $this->hasMany('App\Models\Normalisasi', 'id_kriteria');
    }
    public function terbobot()
    {
        return $this->hasMany('App\Models\Terbobot', 'id_kriteria');
    }
}
