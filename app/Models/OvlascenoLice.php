<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class OvlascenoLice extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'ime';

    protected $table = "ovlascena_lica";

    protected $fillable = [
        'ime',
        'prezime',
        'telefon',
        'email',
        'telefon_viber',
        'telefon_whatsapp',
        'telefon_facetime',
    ];

    public function preduzeca()
    {
        return $this->belongsToMany('App\Models\Preduzece', 'ovlasceno_lice_preduzece', 'ovlasceno_lice_id', 'preduzece_id');
    }
}
