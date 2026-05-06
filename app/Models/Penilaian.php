<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tanggal'
    ];

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function detailPenilaian()
{
    return $this->hasMany(\App\Models\DetailPenilaian::class, 'id_penilaian');
}
}