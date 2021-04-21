<?php

namespace App\Models;

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
        'user_id',
        'kod_poslovnog_prostora',
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query= $query->where('preduzece_id', getAuthPreduzeceId(request()));

        if (auth()->user()->can('view all PoslovnaJedinica')) {
            return $query;
        }

        if (auth()->user()->can('view owned PoslovnaJedinica')) {
            return $query->where('user_id', auth()->id());
        }
    }

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
