<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pertanyaan;

class Domain extends Model
{
    protected $table = 'domain'; // sesuai nama tabel kamu

    protected $primaryKey = 'id_domain';

    protected $fillable = [
        'namaDomain',
        'deskripsi'
    ];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_domain');
    }
}