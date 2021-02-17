<?php

namespace App\Models;

use App\RacuniIndexConfigurator;
use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ScoutElastic\Searchable;

class Racun extends Model
{
    use HasFactory, SoftDeletes;

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
        'partner_id'
    ];

    public const RACUN = 'racun';
    public const PREDRACUN = 'predracun';

    public const GOTOVINSKI = 'gotovinski';

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
            'partner.preduzece.kratki_naziv' => [
                'type' => 'text',
            ],
            'partner.preduzece.puni_naziv' => [
                'type' => 'text',
            ],
            'partner.preduzec.pib' => [
                'type' => 'text',
            ],
            'partner.fizicko_lice.ime' => [
                'type' => 'text',
            ],
            'partner.fizicko_lice.prezime' => [
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
        }

        if ($partner && $partner->fizicko_lice_id) {
            $array['fizicko_lice_ime'] = $partner->fizicko_lice->ime;
            $array['fizicko_lice_prezime'] = $partner->fizicko_lice->prezime;
        }

        return $array;
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserScope);
    // }

    public static function filter(Request $request)
    {

        if ($request->has('search')) {
            $query = Racun::search($request->search . '*');
        } else {
            $query = Racun::query();
        }
        if ($request->has('startDate')) {
            $query = $query->where('created_at', '>=', $request->startDate);
        }
        if ($request->has('endDate')) {
            $query = $query->where('created_at', '<=', $request->endDate);
        }
        if ($request->has('status')) {
            $query = $query->where('status', $request->status);
        }

        return $query;
    }

    public static function getAll(Request $request)
    {
        return Racun::query();
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
            if (array_key_exists('usluga_id', $stavka)) {
                $usluga = Usluga::find($stavka['usluga_id']);
                $stavke[] = $this->kreirajStavkuIzUsluge($usluga, $stavka);
            }
            if (array_key_exists('roba_id', $stavka)) {
                $roba = Roba::find($stavka['roba_id']);
                $stavke[] = $this->kreirajStavkuIzRobe($roba, $stavka);
            }
        }

        DB::table('stavke_racuna')->insert($stavke);
    }

    private function kreirajStavkuIzUsluge(Usluga $usluga, $stavka)
    {
        $grupa = $usluga->grupa;

        $jedinica_id = @$stavka['jedinica_id'] ?: $usluga->jedinica_mjere_id;
        $porez_id = @$stavka['porez_id'] ?: $usluga->porez_id;

        return StavkaRacuna::make([
            'naziv' => $usluga->naziv,
            'opis' => $usluga->opis,
            'jedinicna_cijena_bez_pdv' => $usluga->cijena_bez_pdv,
            'kolicina' => $stavka['kolicina'],
            'pdv_iznos' => $usluga->ukupna_cijena - $usluga->cijena_bez_pdv,
            'popust_procenat' => $grupa ? $grupa->popust_procenti : 0,
            'popust_iznos' => $stavka['kolicina'] * ($grupa ? $grupa->popust_iznos : 0),
            'popust_na_jedinicnu_cijenu' => $grupa ? $grupa->popust_iznos : 0,
            'cijena_sa_pdv' => $usluga->ukupna_cijena * $stavka['kolicina'],
            'porez_id' => $porez_id,
            'jedinica_id' => $jedinica_id,
            'racun_id' => $this->id,
        ])->toArray();
    }

    private function kreirajStavkuIzRobe(Roba $roba, $stavka)
    {
        $cijenaRobe = CijenaRobe::where('roba_id', $roba->id)
            ->where('atribut_id', $stavka['atribut_id'])
            ->first();

        $atribut = AtributRobe::where('id', $stavka['atribut_id'])->first();

        $popust_na_jedinicnu_cijenu = $atribut
            ? $atribut->popust_procenti * $cijenaRobe->ukupna_cijena / 100
            : 0;

        $jedinica_id = @$stavka['jedinica_id'] ?: $roba->jedinica_mjere_id;
        $porez_id = @$stavka['porez_id'] ?: $cijenaRobe->porezi_id;

        return StavkaRacuna::make([
            'naziv' => $roba->naziv,
            'opis' => $roba->opis,
            'jedinicna_cijena_bez_pdv' => $cijenaRobe->cijena_bez_pdv,
            'kolicina' => $stavka['kolicina'],
            'pdv_iznos' => $stavka['kolicina'] * ($cijenaRobe->ukupna_cijena - $cijenaRobe->cijena_bez_pdv),
            'popust_procenat' => $atribut ? $atribut->popust_procenti : 0,
            'popust_iznos' => $stavka['kolicina'] * $popust_na_jedinicnu_cijenu,
            'popust_na_jedinicnu_cijenu' => $popust_na_jedinicnu_cijenu,
            'cijena_sa_pdv' => $cijenaRobe->ukupna_cijena * $stavka['kolicina'],
            'porez_id' => $porez_id,
            'jedinica_id' => $jedinica_id,
            'racun_id' => $this->id,
        ])->toArray();
    }

    public function izracunajUkupneCijene()
    {
        $query = StavkaRacuna::where('racun_id', $this->id);
        $this->ukupna_cijena_sa_pdv = $query->sum('cijena_sa_pdv');
        $this->ukupan_iznos_pdv = $query->sum('pdv_iznos');
        $this->ukupna_cijena_bez_pdv = $this->ukupna_cijena_sa_pdv - $this->ukupan_iznos_pdv;

        $this->save();
    }

    public function izracunajPoreze()
    {
        $porezi_za_racun = StavkaRacuna::groupBy('porez_id', 'racun_id')
            ->selectRaw('sum(pdv_iznos) as pdv_iznos_ukupno, racun_id, porez_id')
            ->where('racun_id', $this->id)
            ->get()->toArray();

        DB::table('porezi_za_racun')->insert($porezi_za_racun);
    }

    public static function izracunajBrojRacuna()
    {
        $broj_racuna = DB::table('racuni')->max('broj_racuna');
        return $broj_racuna + 1;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function poslovnaJedinica()
    {
        return $this->belongsTo('App\Models\PoslovnaJedinica', 'poslovna_jedinica_id');
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
