<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function alternatif() 
	{
		return $this->hasMany('App\Models\Alternatif', 'id_periode');
	}
    public function normalisasi() 
	{
		return $this->hasMany('App\Models\Normalisasi', 'id_periode');
	}
    public function terbobot() 
	{
		return $this->hasMany('App\Models\Terbobot', 'id_periode');
	}
}
