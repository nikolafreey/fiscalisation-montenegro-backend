<?php

namespace App\Models;

use App\MyIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class FizickoLice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fizicka_lica';

    protected $fillable = [
        'ime',
        'prezime',
        'jmbg',
        'ib',
        'adresa',
        'telefon',
        'email',
        'zanimanje',
        'radno_mjesto',
        'drzavljanstvo',
        'nacionalnost',
        'cv_link',
        'avatar',
        'preduzece_id'
    ];

    use Searchable;

    protected $indexConfigurator = MyIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    protected $mapping = [
        'properties' => [
            'ime' => [
                'type' => 'text',
            ],
            'prezime' => [
                'type' => 'text',
            ],
        ]
    ];

    public function toSearchableArray()
    {
        $array = $this->only('ime', 'prezime');

        return $array;
    }

    public function ziro_racuni() {
        return $this->hasMany('App\Models\ZiroRacun', 'fizicko_lice_id');
    }

    public function preduzeca()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }
}
