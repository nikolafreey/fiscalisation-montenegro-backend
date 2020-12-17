<?php

namespace App\Models;

use App\PartnerIndexConfigurator;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use ScoutElastic\Searchable;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'partneri';

    protected $fillable = [
        'kontakt_ime',
        'kontakt_prezime',
        'kontakt_telefon',
        'kontakt_viber',
        'kontakt_whatsapp',
        'kontakt_facetime',
        'opis',
        'user_id',
        'preduzece_id',
        'fizicko_lice_id'
    ];

    use Searchable;

    protected $indexConfigurator = PartnerIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    protected $mapping = [
        'properties' => [
            'preduzece_kratki_naziv' => [
                'type' => 'text',
            ],
            'preduzece_puni_naziv' => [
                'type' => 'text',
            ],
            'preduzece_pib' => [
                'type' => 'text',
            ],
            'fizicko_lice_ime' => [
                'type' => 'text',
            ],
            'fizicko_lice_prezime' => [
                'type' => 'text',
            ],
        ]
    ];

    public function toSearchableArray()
    {
        if ($this->preduzece_id) {
            $preduzece = $this->preduzece;
            $array['preduzece_kratki_naziv'] = $preduzece->kratki_naziv;
            $array['preduzece_puni_naziv'] = $preduzece->puni_naziv;
            $array['preduzece_pib'] = $preduzece->pib;
            $array['tip'] = 'preduzece';
        }
        
        if ($this->fizicko_lice_id) {
            $fizicko_lice = $this->fizicko_lice;
            $array['fizicko_lice_ime'] = $fizicko_lice->ime;
            $array['fizicko_lice_prezime'] = $fizicko_lice->prezime;
            $array['tip'] = 'fizicko_lice';
        }

        return $array;
    }

    public static function filter(Request $request)
    {
        if ($request->has('search')) {
            $query = Partner::search($request->search . '*');
        } else {
            $query = Partner::query();
        }

        if ($request->has(['filter', 'search'])) {
            $query = $query->where('tip', $request->filter);
        } elseif ($request->has(['filter'])) {
            $query = $query->has($request->filter);
        }
        
        return $query;
    }

    protected static function booted()
    {
        //  static::addGlobalScope(new UserScope);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function fizicko_lice()
    {
        return $this->belongsTo('App\Models\FizickoLice', 'fizicko_lice_id');
    }

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }
}
