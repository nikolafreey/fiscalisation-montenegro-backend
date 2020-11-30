<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

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

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function fizickoLice()
    {
        return $this->belongsTo('App\Models\FizickoLice', 'fizicko_lice_id');
    }

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }
}
