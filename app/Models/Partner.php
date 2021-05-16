<?php

namespace App\Models;

use App\PartnerIndexConfigurator;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use ScoutElastic\Searchable;
use App\Traits\ImaAktivnost;

class Partner extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'kontakt_ime';

    protected $table = 'partneri';

    protected $fillable = [
        'kontakt_ime',
        'kontakt_prezime',
        'kontakt_telefon',
        'kontakt_viber',
        'kontakt_whatsapp',
        'kontakt_facetime',
        'opis',
        'fizicko_lice_id',
        'preduzece_tabela_id',
        'pib',
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query = $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;

        // if (auth()->user()->can('view all Partner')) {
        //     return $query;
        // }

        // if (auth()->user()->can('view owned Partner')) {
        //     return $query->where('user_id', auth()->id());
        // }
    }

    use Searchable;

    protected $indexConfigurator = PartnerIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    protected $mapping = [
        'properties' => [
            'preduzece_partner.kratki_naziv' => [
                'type' => 'text',
            ],
            'preduzece_partner.puni_naziv' => [
                'type' => 'text',
            ],
            // 'preduzece_partner.pib' => [
            //     'type' => 'text',
            // ],
            'fizicko_lice.ime' => [
                'type' => 'text',
            ],
            'fizicko_lice.prezime' => [
                'type' => 'text',
            ],
        ]
    ];

    public function toSearchableArray()
    {
        $array = [];
        if ($this->preduzece_partner) {
            $preduzece = $this->preduzece_partner;
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
        if ($request->has(['filter', 'search'])) {
            $query = Partner::search($request->search . '*')->query(function ($query) {
                return $query->filterByPermissions();
            });
        }

        if ($request->has('search')) {
            $query = Partner::search($request->search . '*')->query(function ($query) {
                return $query->filterByPermissions();
            });
        }

        if ($request->has('filter')) {
            if ($request->filter == "fizicko_lice") {
                return Partner::query()->where('preduzece_tabela_id', null)->filterByPermissions();
            } elseif ($request->filter == "preduzece") {
                return Partner::query()->where('fizicko_lice_id', null)->filterByPermissions();
            }
        }
        return $query;
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

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

    public function preduzece_partner()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_tabela_id', 'id');
    }
}
