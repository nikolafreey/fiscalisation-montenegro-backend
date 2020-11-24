<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OvlascenoLice extends Model
{
    protected $table = "ovlascena_lica";

    protected $fillable = array('ime', 'prezime', 'telefon', 'telefon_viber', 'telefon_whatsapp', 'telefon_facetime', 'email');
}
