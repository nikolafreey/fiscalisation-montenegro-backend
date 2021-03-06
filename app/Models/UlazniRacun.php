<?php

namespace App\Models;

use App\UlazniRacuniIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ScoutElastic\Searchable;
use App\Traits\ImaAktivnost;

class UlazniRacun extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    public const RACUN = 'racun';

    public const GOTOVINSKI = 'gotovinski';

    protected $naziv = 'vrsta_racuna';

    protected $table = 'ulazni_racuni';

    protected $fillable = [
        'kod_operatera',
        'kod_poslovnog_prostora',
        'ikof',
        'jikr',
        'tip_racuna',
        'vrsta_racuna',
        'korektivni_racun',
        'korektivni_racun_vrsta',
        'broj_racuna',
        'datum_izdavanja',
        'datum_za_placanje',
        'kod_poslovnog_prostora_enu',
        'ukupna_cijena_bez_pdv',
        'ukupna_cijena_sa_pdv',
        'ukupan_iznos_pdv',
        'popust_procenat',
        'popust_iznos',
        'popust_na_cijenu_bez_pdv',
        'popust_ukupno',
        'opis',
        'status',
        'partner_id'
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query = $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;

        // if (auth()->user()->can('view all UlazniRacun')) {
        //     return $query;
        // }

        // if (auth()->user()->can('view owned UlazniRacun')) {
        //     return $query->where('user_id', auth()->id());
        // }
    }

    use Searchable;

    protected $indexConfigurator = UlazniRacuniIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    protected $mapping = [
        'properties' => [
            'broj_racuna' => [
                'type' => 'text',
            ],
            'status' => [
                'type' => 'keyword',
            ],
            'created_at' => [
                'type' => 'date',
            ],
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
        $array = $this->only('broj_racuna', 'status', 'created_at');

        $partner = $this->partner;

        if ($partner && $partner->preduzece_id) {
            $array['preduzece_kratki_naziv'] = $partner->preduzece->kratki_naziv;
            $array['preduzece_puni_naziv'] = $partner->preduzece->puni_naziv;
            $array['preduzece_pib'] = $partner->preduzece->pib;
        } else {
            $array['preduzece_kratki_naziv'] = '';
            $array['preduzece_puni_naziv'] = '';
            $array['preduzece_pib'] = '';
        }

        if ($partner && $partner->fizicko_lice_id) {
            $array['fizicko_lice_ime'] = $partner->fizicko_lice->ime;
            $array['fizicko_lice_prezime'] = $partner->fizicko_lice->prezime;
        } else {
            $array['fizicko_lice_ime'] = '';
            $array['fizicko_lice_prezime'] = '';
        }

        return $array;
    }

    public static function filter(Request $request)
    {

        if ($request->has('search')) {
            $query = UlazniRacun::search($request->search . '*')->query(function($query) {
                return $query->filterByPermissions();
            });
        } else {
            $query = UlazniRacun::query();
        }
        if ($request->has('start_date')) {
            $query = $query->where('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date')) {
            $query = $query->where('created_at', '<=', $request->end_date);
        }
        if ($request->has('status')) {
            $query = $query->where('status', $request->status);
        }

        return $query;
    }

    public static function izracunajUkupnuCijenu($query)
    {
        $racuni = $query->get();
        $suma = 0;

        foreach ($racuni as $racun) {
            $suma += $racun->ukupna_cijena_sa_pdv;
        }

        return $suma;
    }

    public function kreirajStavke(Request $request)
    {
        $stavke = [];

        foreach ($request->stavke as $stavka) {
            if ($stavka['usluga_id']) {
                $usluga = Usluga::find($stavka['usluga_id']);
                $stavke[] = $this->kreirajStavkuIzUsluge($usluga, $stavka);
            }
            if ($stavka['roba_id']) {
                $roba = Roba::find($stavka['roba_id']);
                $stavke[] = $this->kreirajStavkuIzRobe($roba, $stavka);
            }
        }

        DB::insert($stavke);
    }

    private function kreirajStavkuIzUsluge(Usluga $usluga, $stavka)
    {
        return StavkaUlazniRacun::make([
            'naziv' => $usluga->naziv,
            'opis' => $usluga->opis,
            'jedinicna_cijena_bez_pdv' => $usluga->cijena_bez_pdv,
            'kolicina' => $stavka->kolicina,
            'pdv_iznos' => $usluga->ukupna_cijena - $usluga->cijena_bez_pdv,
            'odbitni_pdv' => $stavka->odbitni_pdv,

            'popust_procenat' => $stavka->popust_procenat,
            'popust_iznos' => $stavka->popust_iznos,
            'popust_na_jedinicnu_cijenu' => $stavka->popust_na_jedinicnu_cijenu,
            'cijena_sa_pdv' => $usluga->ukupna_cijena * $stavka->kolicina,
            'porez_id' => $usluga->porez_id,
            'jedinica_id' => $stavka->jedinica_id,
            'ulazni_racun_id' => $this->id,
        ]);
    }

    private function kreirajStavkuIzRobe(Roba $roba, $stavka)
    {
        $cijenaRobe = CijenaRobe::where('roba_id', $roba->id)
            ->where('atribut_id', $stavka['atribut_id'])
            ->get();

        return StavkaUlazniRacun::make([
            'naziv' => $roba->naziv,
            'opis' => $roba->opis,
            'jedinicna_cijena_bez_pdv' => $cijenaRobe->cijena_bez_pdv,
            'kolicina' => $stavka->kolicina,
            'pdv_iznos' => $cijenaRobe->ukupna_cijena - $cijenaRobe->cijena_bez_pdv,
            'odbitni_pdv' => $stavka->odbitni_pdv,
            'popust_procenat' => $stavka->popust_procenat,
            'popust_iznos' => $stavka->popust_iznos,
            'popust_na_jedinicnu_cijenu' => $stavka->popust_na_jedinicnu_cijenu,
            'cijena_sa_pdv' => $cijenaRobe->ukupna_cijena * $stavka->kolicina,
            'porez_id' => $cijenaRobe->porezi_id,
            'jedinica_id' => $roba->jedinica_mjere_id,
            'ulazni_racun_id' => $this->id,
        ]);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }

    public function ulazne_stavke()
    {
        return $this->hasMany('App\Models\StavkaUlazniRacun', 'ulazni_racun_id');
    }

    public function porezi()
    {
        return $this->belongsToMany('App\Models\Porez', 'porezi_za_racun', 'ulazni_racun_id', 'porez_id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }

    public function setFileAttribute($value)
    {
        return $this->attributes['file'] = Storage::disk('public')->putFile('ulazniRacuni', $value);
    }
}
