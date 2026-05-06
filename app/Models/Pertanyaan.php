<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Domain;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    protected $primaryKey = 'id_pertanyaan';

    public $timestamps = false;
    protected $fillable = [
        'id_domain',
        'pertanyaan',
        'bobot'
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'id_domain');
    }
}