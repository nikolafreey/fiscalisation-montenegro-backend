<?php

namespace App\Models;

use App\Traits\ImaAktivnost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CijenaRobe extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    protected $table = 'cijene_roba';

    protected $fillable = [
        'nabavna_cijena_bez_pdv',
        'nabavna_cijena_sa_pdv',
        'cijena_bez_pdv',
        'porezi_id',
        'roba_id',
        'atribut_id',
        'pdv_iznos',
        'ukupna_cijena',
        'cijena_bez_pdv_popust',
        'cijena_sa_pdv_popust',
        'iznos_pdv_popust'
    ];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function atribut_robe()
    {
        return $this->belongsTo('App\Models\AtributRobe', 'id');
    }

    public function roba()
    {
        return $this->belongsTo('App\Models\Roba', 'roba_id');
    }

    public function porez()
    {
        return $this->belongsTo('App\Models\Porez', 'porez_id');
    }
}
