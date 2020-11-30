<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OvlascenoLice extends Model
{
    use SoftDeletes;

    protected $table = "ovlascena_lica";

    protected $fillable = array('ime', 'prezime', 'telefon', 'telefon_viber', 'telefon_whatsapp', 'telefon_facetime', 'email');

    public function preduzeca()
    {
        return $this->belongsToMany('App\Models\Preduzece', 'ovlasceno_lice_preduzece', 'ovlasceno_lice_id', 'preduzece_id');
    }
}
