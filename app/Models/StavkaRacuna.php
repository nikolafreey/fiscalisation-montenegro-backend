<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StavkaRacuna extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stavke_racuna';

    protected $fillable = [
        'naziv',
        'opis',
        'jedinicna_cijena_bez_pdv',
        'cijena_bez_pdv_popust',
        'cijena_sa_pdv',
        'cijena_sa_pdv_popust',
        'ukupna_bez_pdv',
        'ukupna_sa_pdv',
        'ukupna_bez_pdv_popust',
        'ukupna_sa_pdv_popust',
        'kolicina',
        'pdv_iznos',
        'pdv_iznos_ukupno',
        'popust_procenat',
        'popust_iznos',
        'popust_na_jedinicnu_cijenu',
        'porez_id',
        'jedinica_id',
        'jedinica_naziv',
        'racun_id',
    ];

    public function racun()
    {
        return $this->belongsTo('App\Models\Racun', 'racun_id');
    }

    public function porez()
    {
        return $this->belongsTo('App\Models\Porez', 'porez_id');
    }

    public function jedinica_mjere()
    {
        return $this->belongsTo('App\Models\JedinicaMjere', 'jedinica_id');
    }
}
