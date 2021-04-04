<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class StavkaUlazniRacun extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'stavke_ulazni_racuni';

    protected $fillable = [
        'naziv',
        'opis',
        'jedinicna_cijena_bez_pdv',
        'kolicina',
        'pdv_iznos',
        'odbitni_pdv',
        'popust_procenat',
        'popust_iznos',
        'popust_na_jedinicnu_cijenu',
        'cijena_sa_pdv',
        'porez_id',
        'jedinica_id',
        'ulazni_racun_id',
    ];

    public function ulazni_racun()
    {
        return $this->belongsTo('App\Models\UlazniRacun', 'ulazni_racun_id');
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
