<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImaAktivnost;

class JedinicaMjere extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'naziv';

    protected $table = 'jedinice_mjere';

    protected $fillable = [
        'naziv',
        'kratki_naziv'
    ];

    public function usluge()
    {
        return $this->hasMany('App\Models\Usluga', 'jedinica_mjere_id');
    }

    public function roba()
    {
        return $this->hasOne('App\Models\Roba', 'jedinica_mjere_id');
    }
}
