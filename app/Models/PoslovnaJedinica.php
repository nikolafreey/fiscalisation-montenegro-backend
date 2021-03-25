<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImaAktivnost;

class PoslovnaJedinica extends Model
{
    use HasFactory, ImaAktivnost;

    protected $naziv = 'kratki_naziv';

    protected $table = 'poslovne_jedinice';

    protected $fillable = [
        'kratki_naziv',
        'adresa',
        'grad',
        'drzava',
        'preduzce_id',
        'user_id'
    ];

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }

    public function racuni()
    {
        return $this->hasMany('App\Models\Racun', 'poslovna_jedinica_id');
    }

    public function depozitWithdraw()
    {
        return $this->hasMany('App\Models\DepozitWithdraw', 'poslovna_jedinica_id');
    }
}
