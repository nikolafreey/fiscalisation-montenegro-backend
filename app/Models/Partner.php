<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'partneri';

    protected $fillable = [
        'kontakt_ime',
        'kontakt_prezime',
        'kontakt_telefon',
        'kontakt_viber',
        'kontakt_whatsapp',
        'kontakt_facetime',
        'opis',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
