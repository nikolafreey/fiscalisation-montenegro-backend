<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preduzece extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'preduzeca';

    protected $fillable = ['kratki_naziv', 'puni_naziv', 'oblik_preduzeca', 'adresa', 'grad', 'drzava', 'telefon', 'telefon_viber', 'telefon_whatsapp', 'telefon_facetime', 'fax', 'email', 'website', 'pib', 'pdv', 'djelatnost', 'iban', 'bic_swift', 'kontakt_ime', 'kontakt_prezime', 'kontakt_telefon', 'kontakt_viber', 'kontakt_whatsapp', 'kontakt_facetime', 'kontakt_email', 'twitter_username', 'instagram_username', 'facebook_username', 'skype_username', 'logotip', 'opis', 'lokacija_lat', 'lokacija_long', 'status', 'privatnost', 'verifikovan', 'kategorija_id'];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function fizickaLica()
    {
        return $this->hasMany('App\Models\FizickoLice');
    }

    public function partneri()
    {
        return $this->hasMany('App\Models\Partner');
    }

    public function ziroRacuni()
    {
        return $this->hasMany('App\Models\ZiroRacun');
    }

    public function djelatnosti()
    {
        return $this->belongsToMany('App\Models\Djelatnost', 'preduzece_djelatnost', 'preduzece_id', 'djelatnost_id');
    }

    public function ovlascena_lica()
    {
        return $this->belongsToMany('App\Models\OvlascenoLice', 'ovlasceno_lice_preduzece', 'preduzece_id', 'ovlasceno_lice_id');
    }

    public function kategorija()
    {
        return $this->belongsTo('App\Models\Kategorija');
    }

    public function roba()
    {
        return $this->belongsTo('App\Models\Roba', 'preduzece_id');
    }
}
