<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenilaian extends Model
{
    protected $table = 'detail_penilaian';
    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    protected $fillable = [
        'id_penilaian',
        'id_pertanyaan',
        'nilai'
    ];

    // 🔥 RELASI KE PERTANYAAN
    public function pertanyaan()
    {
        return $this->belongsTo(\App\Models\Pertanyaan::class, 'id_pertanyaan');
    }
}