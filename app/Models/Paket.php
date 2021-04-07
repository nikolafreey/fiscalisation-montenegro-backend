<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $naziv = 'naziv';

    protected $table = 'paketi';

    protected $fillable = [
        'naziv',
        'broj_uredjaja'
    ];

    public function preduzeca()
    {
        return $this->belongsToMany('App\Models\Preduzece', 'paket_preduzece', 'paket_id', 'preduzece_id');
    }
}
