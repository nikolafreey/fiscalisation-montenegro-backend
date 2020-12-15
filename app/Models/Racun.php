<?php

namespace App\Models;

use App\RacuniIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ScoutElastic\Searchable;

class Racun extends Model
{
    use HasFactory;

    protected $table = 'racuni';

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
        'preduzece_id',
        'user_id',
        'partner_id'
    ];

    use Searchable;

    protected $indexConfigurator = RacuniIndexConfigurator::class;

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

        if ($partner->preduzece_id) {
            $array['preduzece_kratki_naziv'] = $partner->preduzece->kratki_naziv;
            $array['preduzece_puni_naziv'] = $partner->preduzece->puni_naziv;
            $array['preduzece_pib'] = $partner->preduzece->pib;
        } else {
            $array['preduzece_kratki_naziv'] = '';
            $array['preduzece_puni_naziv'] = '';
            $array['preduzece_pib'] = '';
        }

        if ($partner->fizicko_lice_id) {
            $array['fizicko_lice_ime'] = $partner->fizicko_lice->ime;
            $array['fizicko_lice_prezime'] = $partner->fizicko_lice->prezime;
        } else {
            $array['fizicko_lice_ime'] = '';
            $array['fizicko_lice_prezime'] = '';
        }

        return $array;
    }
 
    public static function filter(Request $request) {
        
        if ($request->has('search')){
            $query = Racun::search($request->search . '*');       
        } else {
            $query = Racun::query();
        }
        if ($request->has('datum_start')) {
            $query = $query->where('created_at', '>=', $request->datum_start);
        }
        if ($request->has('datum_end')) {
            $query = $query->where('created_at', '<=', $request->datum_end);
        }
        if ($request->has('status')) {
            $query = $query->where('status', $request->status);
        }

        return $query;
    }

    public static function izracunajUkupnuCijenu($query) {
        $racuni = $query->get();
        $suma = 0;

        foreach ($racuni as $racun) {
            $suma += $racun->ukupna_cijena_sa_pdv;
        }

        return $suma;
    }

    public function kreirajStavke(Request $request) {
        $stavke = [];
        
        foreach($request->stavke as $stavka) {
            if($stavka['usluga_id']) {
                $usluga = Usluga::find($stavka['usluga_id']);
                $stavke[] = $this->kreirajStavkuIzUsluge($usluga, $stavka);
            }
            if($stavka['roba_id']) {
                $roba = Roba::find($stavka['roba_id']);
                $stavke[] = $this->kreirajStavkuIzRobe($roba, $stavka);
            }
        }

        DB::insert($stavke);
    }

    private function kreirajStavkuIzUsluge(Usluga $usluga, $stavka) {
        return StavkaRacuna::make([
            'naziv' => $usluga->naziv,
            'opis' => $usluga->opis,
            'jedinicna_cijena_bez_pdv' => $usluga->cijena_bez_pdv,
            'kolicina' => $stavka->kolicina,
            'pdv_iznos' => $usluga->ukupna_cijena - $usluga->cijena_bez_pdv,
            'popust_procenat' => $stavka->popust_procenat,
            'popust_iznos' => $stavka->popust_iznos,
            'popust_na_jedinicnu_cijenu' => $stavka->popust_na_jedinicnu_cijenu,
            'cijena_sa_pdv' => $usluga->ukupna_cijena * $stavka->kolicina,
            'porez_id' => $usluga->porez_id,
            'jedinica_id' => $stavka->jedinica_id,
            'racun_id' => $this->id,
        ]);
    }

    private function kreirajStavkuIzRobe(Roba $roba, $stavka) {
        $cijenaRobe = CijenaRobe::where('roba_id', $roba->id)
            ->where('atribut_id', $stavka['atribut_id'])
            ->get();
        
        return StavkaRacuna::make([
            'naziv' => $roba->naziv,
            'opis' => $roba->opis,
            'jedinicna_cijena_bez_pdv' => $cijenaRobe->cijena_bez_pdv,
            'kolicina' => $stavka->kolicina,
            'pdv_iznos' => $cijenaRobe->ukupna_cijena - $cijenaRobe->cijena_bez_pdv,
            'popust_procenat' => $stavka->popust_procenat,
            'popust_iznos' => $stavka->popust_iznos,
            'popust_na_jedinicnu_cijenu' => $stavka->popust_na_jedinicnu_cijenu,
            'cijena_sa_pdv' => $cijenaRobe->ukupna_cijena * $stavka->kolicina,
            'porez_id' => $cijenaRobe->porezi_id,
            'jedinica_id' => $roba->jedinica_mjere_id,
            'racun_id' => $this->id,
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

    public function stavke()
    {
        return $this->hasMany('App\Models\StavkaRacuna', 'racun_id');
    }

    public function porezi()
    {
        return $this->belongsToMany('App\Models\Porez', 'porezi_za_racun', 'racun_id', 'porez_id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }
}
