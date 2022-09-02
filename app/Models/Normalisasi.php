<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Normalisasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function warga()
    {
        return $this->belongsTo('App\Models\Warga', 'id_warga');
    }
}
