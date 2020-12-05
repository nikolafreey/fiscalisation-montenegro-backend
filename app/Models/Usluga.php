<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usluga extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'usluge';

    protected $fillable = [
        'naziv',
        'opis',
        'cijena_bez_pdv',
        'ukupna_cijena',
        'pdv_iznos',
        'status',
        'user_id',
        'grupa_id',
        'jedinica_mjere_id',
        'porez_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function grupa()
    {
        return $this->belongsTo('App\Models\Grupa', 'grupa_id');
    }

    public function jedinicaMjere()
    {
        return $this->belongsTo('App\Models\JedinicaMjere', 'jedinica_mjere_id');
    }

    public function porez()
    {
        return $this->belongsTo('App\Models\Porez', 'porez_id');
    }
}
