<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function kriteria()
    {
        return $this->belongsTo('App\Models\Kriteria', 'id_kriteria');
    }
}
