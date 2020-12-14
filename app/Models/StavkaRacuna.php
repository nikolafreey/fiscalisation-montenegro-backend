<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StavkaRacuna extends Model
{
    use HasFactory;

    protected $table = 'stavke_racuna';

    protected $fillable = [
        'naziv',
        'opis',
        'jedinicna_cijena_bez_pdv',
        'kolicina',
        'pdv_iznos',
        'popust_procenat',
        'popust_iznos',
        'popust_na_jedinicnu_cijenu',
        'cijena_sa_pdv',
        'porez_id',
        'jedinica_id',
        'racun_id',
    ];

    public function racun()
    {
        return $this->belongsTo('App\Models\Racun', 'racun_id');
    }

    public function porez()
    {
        return $this->belongsTo('App\Models\Racun', 'porez_id');
    }

    public function jedinica_mjere()
    {
        return $this->belongsTo('App\Models\JedinicaMjere', 'jedinica_id');
    }
}
