<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function warga()
    {
        return $this->belongsTo('App\Models\Warga', 'id_warga');
    }
    public function periode()
    {
        return $this->belongsTo('App\Models\Periode', 'id_periode');
    }
    public function kriteria() 
	{
		return $this->belongsTo('App\Models\Kriteria', 'id_kriteria');
	}
}
