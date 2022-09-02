<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function alternatif() 
	{
		return $this->hasMany('App\Models\Alternatif', 'id_warga');
	}

    public function normalisasi() 
	{
		return $this->hasMany('App\Models\Normalisasi', 'id_warga');
	}

    public function terbobot() 
	{
		return $this->hasMany('App\Models\Terbobot', 'id_warga');
	}

    public function dpositif() 
	{
		return $this->hasMany('App\Models\Dpositif', 'id_warga');
	}

    public function Dnegatif() 
	{
		return $this->hasMany('App\Models\Dnegatif', 'id_warga');
	}

    public function preferensi() 
	{
		return $this->hasMany('App\Models\Preferensi', 'id_warga');
	}
}
