<?php

namespace App\Models;

use App\Scopes\UserScope;
use App\UslugaIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class Usluga extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'usluge';
    protected $fillable = [
        'naziv',
        'opis',
        'cijena_bez_pdv',
        'ukupna_cijena',
        'status',
        'user_id',
        'grupa_id',
        'jedinica_mjere_id',
        'porez_id',
        'iznos_pdv_popust',
        'cijena_bez_pdv_popust',
        'cijena_sa_pdv_popust',
    ];
    use Searchable;
    protected $indexConfigurator = UslugaIndexConfigurator::class;
    protected $searchRules = [
        //
    ];
    protected $mapping = [
        'properties' => [
            'naziv' => [
                'type' => 'text',
            ],
        ]
    ];
    public function toSearchableArray()
    {
        $array = $this->only('naziv');
        return $array;
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function grupa()
    {
        return $this->belongsTo('App\Models\Grupa', 'grupa_id');
    }
    public function jedinica_mjere()
    {
        return $this->belongsTo('App\Models\JedinicaMjere', 'jedinica_mjere_id');
    }
    public function porez()
    {
        return $this->belongsTo('App\Models\Porez', 'porez_id');
    }
}
