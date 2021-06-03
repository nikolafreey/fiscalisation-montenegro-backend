<?php

namespace App\Models;

use App\RacuniIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ScoutElastic\Searchable;
use App\Traits\ImaAktivnost;

class Racun extends Model
{
    use HasFactory, SoftDeletes, ImaAktivnost;

    protected $naziv = 'vrsta_racuna';

    protected $table = 'racuni';

    protected $fillable = [
        'ikof',
        'jikr',
        'qr_url',
        'tip_racuna',
        'vrsta_racuna',
        'korektivni_racun',
        'korektivni_racun_vrsta',
        'broj_racuna',
        'datum_izdavanja',
        'nacin_placanja',
        'datum_za_placanje',
        // 'kod_poslovnog_prostora_enu',
        'ukupna_cijena_bez_pdv',
        'ukupna_cijena_sa_pdv',
        'ukupna_cijena_bez_pdv_popust',
        'ukupna_cijena_sa_pdv_popust',
        'ukupan_iznos_pdv',
        'popust_procenat',
        'popust_iznos',
        'popust_na_cijenu_bez_pdv',
        'popust_ukupno',
        'opis',
        'status',
        'partner_id',
        'oslobodjen_pdv',
    ];

    public function scopeFilterByPermissions($query)
    {
        if (auth()->user()->hasRole('SuperAdmin')) {
            return $query;
        }

        $query = $query->where('preduzece_id', getAuthPreduzeceId(request()));

        return $query;

        // if (auth()->user()->can('view all Racun')) {
        //     return $query;
        // }

        // if (auth()->user()->can('view owned Racun')) {
        //     return $query->where('user_id', auth()->id());
        // }
    }

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
            'redni_broj' => [
                'type' => 'text',
            ],
            // 'status' => [
            //     'type' => 'keyword',
            // ],
            // 'created_at' => [
            //     'type' => 'date',
            // ],
            'partner.preduzece_partner.kratki_naziv' => [
                'type' => 'text',
            ],
            'partner.preduzece_partner.puni_naziv' => [
                'type' => 'text',
            ],
            // 'partner.preduzece.pib' => [
            //     'type' => 'text',
            // ],
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

        if ($partner && $partner->preduzece_partner) {
            $array['preduzece_kratki_naziv'] = $partner->preduzece_partner->kratki_naziv;
            $array['preduzece_puni_naziv'] = $partner->preduzece_partner->puni_naziv;
            $array['preduzece_pib'] = $partner->preduzece_partner->pib;
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
        // if ($request->has('search')) {
        //     $query = Racun::search($request->search . '*')->query(function ($query) {
        //         return $query->filterByPermissions();
        //     });
        // } else {
        $query = Racun::query()->filterByPermissions();
        // }
        if ($request->has('startDate')) {
            $query = $query->whereDate('created_at', '>=', $request->startDate);
        }
        if ($request->has('endDate')) {
            $query = $query->whereDate('created_at', '<=', $request->endDate);
        }
        if ($request->has('status')) {
            $query = $query->where('status', $request->status);
        }

        return
            $query->orderBy('created_at', 'DESC');;
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
                $stavke[] = $this->kreirajStavkuIzUsluge($usluga, $stavka, $request->vrsta_racuna);
            }
            if (array_key_exists('roba_id', $stavka)) {
                $roba = Roba::find($stavka['roba_id']);
                $stavke[] = $this->kreirajStavkuIzRobe($roba, $stavka, $request->vrsta_racuna);
            }
        }

        DB::table('stavke_racuna')->insert($stavke);
    }

    private function kreirajStavkuIzUsluge(Usluga $usluga, $stavka, $vrsta_racuna)
    {
        //$uslov = ($usluga) ? $usluga['cijena_bez_pdv_popust'] : $stavka['cijena_bez_pdv_popust'];false=gotovinski

        if ($vrsta_racuna !== "gotovinski") {
            $popust_procenat = 0;
            $popust_iznos = 0;
            if(array_key_exists('tip_popusta', $stavka)){
                if($stavka['tip_popusta'] == 'procenat'){
                    $popust_procenat = $stavka['popust'];
                } else if ($stavka['tip_popusta'] == 'iznos'){
                    $popust_iznos = $stavka['popust'];
                }
            }

            // TODO: Popuste na grupe pregledati ponovo da se ukljuce u popuste
            // $popust = round($stavka['ukupna_cijena'] - $stavka['cijena_sa_pdv_popust'], 2);
            // if ($popust > 0) {
            //     // $grupa = $usluga->grupa;
            //     if (!array_key_exists('tip_popusta', $stavka)) {

            //         $popust_iznos = $stavka['grupa']['popust_iznos'] ? $stavka['grupa']['popust_iznos'] : 0;
            //         $popust_procenti = $stavka['grupa']['popust_procenti'] ? $stavka['grupa']['popust_procenti'] : 0;
            //         if ($popust_iznos > 0) {
            //             $tip_popusta = 'iznos';
            //         }
            //         if ($popust_procenti > 0) {
            //             $tip_popusta = 'procenat';
            //         }
            //     } else {
            //         $tip_popusta = $stavka['tip_popusta'];
            //     }
            // } else {
            //     $tip_popusta = 'nema';
            // };

            if (!array_key_exists('kolicina', $stavka)) {
                $stavka['kolicina'] = 1;
            }


            return StavkaRacuna::make([
                'naziv' => $usluga->naziv,
                'opis' => isset($stavka['opis']) ? $stavka['opis'] : '',
                'jedinicna_cijena_bez_pdv' => $stavka['cijena_bez_pdv'],
                'cijena_bez_pdv_popust' => $stavka['cijena_bez_pdv_popust'],
                'cijena_sa_pdv' => $stavka['ukupna_cijena'],
                'cijena_sa_pdv_popust' => $stavka['cijena_sa_pdv_popust'],
                'kolicina' => $stavka['kolicina'],
                'pdv_iznos' => $stavka['cijena_sa_pdv_popust'] - $stavka['cijena_bez_pdv_popust'],
                'pdv_iznos_ukupno' => ($stavka['cijena_sa_pdv_popust'] - $stavka['cijena_bez_pdv_popust']) * $stavka['kolicina'],
                'popust_procenat' => $popust_procenat > 0 ? $popust_procenat : 0,
                'popust_iznos' => $popust_iznos > 0 ? $popust_iznos : 0,
                'popust_na_jedinicnu_cijenu' =>  $stavka['ukupna_cijena'] - $stavka['cijena_sa_pdv_popust'],
                'ukupna_bez_pdv' => $stavka['cijena_bez_pdv'] * $stavka['kolicina'],
                'ukupna_sa_pdv' => $stavka['ukupna_cijena'] * $stavka['kolicina'],
                'ukupna_bez_pdv_popust' => $stavka['cijena_bez_pdv_popust'] * $stavka['kolicina'],
                'ukupna_sa_pdv_popust' => $stavka['cijena_sa_pdv_popust'] * $stavka['kolicina'],
                'porez_id' => $stavka['porez_id'],
                'jedinica_id' => $stavka['jedinica_mjere_id'],
                'jedinica_naziv' => $stavka['jedinica_mjere']['naziv'],
                'racun_id' => $this->id,
                // 'naziv' => $usluga->naziv,
                // 'opis' => $usluga->opis,
                // 'jedinicna_cijena_bez_pdv' => round($stavka['cijena_bez_pdv'], 2),
                // 'cijena_bez_pdv_popust' => round($stavka['cijena_bez_pdv_popust'], 2),
                // 'cijena_sa_pdv' => round($stavka['ukupna_cijena'], 2),
                // 'cijena_sa_pdv_popust' => round($stavka['cijena_sa_pdv_popust'], 2),
                // 'kolicina' => $stavka['kolicina'],
                // 'pdv_iznos' => round(($stavka['cijena_sa_pdv_popust'] - $stavka['cijena_bez_pdv_popust']), 2),
                // 'pdv_iznos_ukupno' => round(($stavka['cijena_sa_pdv_popust'] - $stavka['cijena_bez_pdv_popust']) * $stavka['kolicina'], 2),
                // 'popust_procenat' => $tip_popusta == 'procenat' ? round($popust, 2) : 0,
                // 'popust_iznos' => $tip_popusta == 'iznos' ? round($popust, 2) : 0,
                // 'popust_na_jedinicnu_cijenu' =>  round($stavka['ukupna_cijena'] - $stavka['cijena_sa_pdv_popust'], 2),
                // 'ukupna_bez_pdv' => round($stavka['cijena_bez_pdv'], 2) * round($stavka['kolicina'], 2),
                // 'ukupna_sa_pdv' => round($stavka['ukupna_cijena'], 2) * round($stavka['kolicina'], 2),
                // 'ukupna_bez_pdv_popust' => round($stavka['cijena_bez_pdv_popust'] * $stavka['kolicina'], 2),
                // 'ukupna_sa_pdv_popust' => round($stavka['cijena_sa_pdv_popust'] * $stavka['kolicina'], 2),
                // 'porez_id' => $stavka['porez_id'],
                // 'jedinica_id' => $stavka['jedinica_mjere_id'],
                // 'jedinica_naziv' => $stavka['jedinica_mjere']['naziv'],
                // 'racun_id' => $this->id,
            ])->toArray();
        } else {
            //Log::info($usluga, $stavka);
            $grupa = $usluga->grupa;

            $jedinica_id = @$stavka['jedinica_id'] ?: $usluga->jedinica_mjere_id;
            $porez_id = @$stavka['porez_id'] ?: $usluga->porez_id;

            if (property_exists('grupa', $usluga)) {
                $popust_procenat = $grupa ? $grupa->popust_procenti : 0;
                $popust_iznos = $grupa ? $grupa->popust_iznos : 0;

                if ($popust_procenat > 0) {
                    $cijena_bez_pdv_popust = $usluga->cijena_bez_pdv * (100 - $popust_procenat) / 100;
                    $cijena_sa_pdv_popust = $usluga->ukupna_cijena * (100 - $popust_procenat) / 100;
                } else {

                    $cijena_sa_pdv_popust = $usluga->ukupna_cijena - $popust_iznos;
                    $cijena_bez_pdv_popust =  $cijena_sa_pdv_popust / (1 + $stavka['pdv_iznos']);
                }
            } else {
                $popust_procenat =  0;
                $popust_iznos =  0;
                $cijena_sa_pdv_popust = $usluga->ukupna_cijena;
                $cijena_bez_pdv_popust =  $cijena_sa_pdv_popust / (1 + $stavka['pdv_iznos']);
            }
            
            return StavkaRacuna::make([
                'naziv' => $usluga->naziv,
                'opis' => $usluga->opis, // kod gotovinskih upisuje opis stavke iz baze ne iz fronta
                'jedinicna_cijena_bez_pdv' => $usluga->cijena_bez_pdv,
                'cijena_bez_pdv_popust' => $cijena_bez_pdv_popust,
                'cijena_sa_pdv' => $usluga->ukupna_cijena,
                'cijena_sa_pdv_popust' => $cijena_sa_pdv_popust,
                'kolicina' => $stavka['kolicina'],
                'pdv_iznos' => $cijena_sa_pdv_popust / (1 + $stavka['pdv_iznos']) * $stavka['pdv_iznos'],
                'pdv_iznos_ukupno' => $cijena_sa_pdv_popust / (1 + $stavka['pdv_iznos']) * $stavka['pdv_iznos'] * $stavka['kolicina'],
                'popust_procenat' => $popust_procenat,
                'popust_iznos' =>   $popust_iznos,
                //'popust_na_jedinicnu_cijenu' => $grupa ? $grupa->popust_iznos : 0,
                'ukupna_bez_pdv' => $usluga->cijena_bez_pdv * $stavka['kolicina'],
                'ukupna_sa_pdv' => $usluga->ukupna_cijena * $stavka['kolicina'],
                // TODO: ukupna bez pdv popust ne racuna kako treba
                'ukupna_bez_pdv_popust' => $cijena_bez_pdv_popust * $stavka['kolicina'],
                'ukupna_sa_pdv_popust' => $cijena_sa_pdv_popust * $stavka['kolicina'],
                'porez_id' => $porez_id,
                'jedinica_id' => $jedinica_id,
                'racun_id' => $this->id,
            ])->toArray();
        }
    }
    //roba!!!
    private function kreirajStavkuIzRobe(Roba $roba, $stavka, $vrsta_racuna)
    {
        if ($vrsta_racuna !== "gotovinski") {
            // $cijenaRobe = CijenaRobe::first();

            // $atribut = AtributRobe::where('id', $stavka['atribut_id'])->first();

            // $popust_na_jedinicnu_cijenu = $atribut
            //     ? $atribut->popust_procenti * $cijenaRobe->ukupna_cijena / 100
            //     : 0;
            $popust = round($stavka['ukupna_cijena'] - $stavka['cijena_sa_pdv_popust'], 2);
            if ($popust > 0) {
                $atribut = AtributRobe::where('id', $stavka['atribut_id'])->first();

                if (!array_key_exists('tip_popusta', $stavka)) {
                    $popust_iznos = $atribut ? $atribut->popust_iznos : 0;
                    $popust_procenti = $atribut ? $atribut->popust_procenti : 0;
                    // $popust_iznos = $stavka['grupa']['popust_iznos'] ? $stavka['grupa']['popust_iznos'] : 0;
                    // $popust_procenti = $stavka['grupa']['popust_procenti'] ? $stavka['grupa']['popust_procenti'] : 0;
                    if ($popust_iznos > 0) {
                        $tip_popusta = 'iznos';
                    }
                    if ($popust_procenti > 0) {
                        $tip_popusta = 'procenat';
                    }
                } else {
                    $tip_popusta = $stavka['tip_popusta'];
                }
            } else {
                $tip_popusta = 'nema_popusta';
            }

            if (!array_key_exists('kolicina', $stavka)) {
                $stavka['kolicina'] = 1;
            }

            return StavkaRacuna::make([
                'naziv' => $roba->naziv,
                'opis' => isset($stavka['opis']) ? $stavka['opis'] : '',
                'jedinicna_cijena_bez_pdv' => round($stavka['cijena_bez_pdv'], 2),
                'cijena_bez_pdv_popust' => round($stavka['cijena_bez_pdv_popust'], 2),
                'cijena_sa_pdv' => round($stavka['ukupna_cijena'], 2),
                'cijena_sa_pdv_popust' => round($stavka['cijena_sa_pdv_popust'], 2),
                'kolicina' => $stavka['kolicina'],
                'pdv_iznos' => round(($stavka['cijena_sa_pdv_popust'] - $stavka['cijena_bez_pdv_popust']), 2),
                'pdv_iznos_ukupno' => round(($stavka['cijena_sa_pdv_popust'] - $stavka['cijena_bez_pdv_popust']) * $stavka['kolicina'], 2),
                'popust_procenat' => $tip_popusta == 'procenat' ? round($popust, 2) : 0,
                'popust_iznos' => $tip_popusta == 'iznos' ? round($popust, 2) : 0,
                'popust_na_jedinicnu_cijenu' =>  round($stavka['ukupna_cijena'] - $stavka['cijena_sa_pdv_popust'], 2),
                'ukupna_bez_pdv' => round($stavka['cijena_bez_pdv']  * $stavka['kolicina'], 2),
                'ukupna_sa_pdv' => round($stavka['ukupna_cijena'] * $stavka['kolicina'], 2),
                'ukupna_bez_pdv_popust' => round($stavka['cijena_bez_pdv_popust'] * $stavka['kolicina'], 2),
                'ukupna_sa_pdv_popust' => round($stavka['cijena_sa_pdv_popust'] * $stavka['kolicina'], 2),
                'porez_id' => $stavka['porez_id'],
                'jedinica_id' => $stavka['jedinica_mjere_id'],
                'jedinica_naziv' => $stavka['jedinica_mjere']['naziv'],
                'racun_id' => $this->id,
            ])->toArray();
        } else {
            $cijenaRobe = CijenaRobe::first();
            // $popust_na_jedinicnu_cijenu = $atribut
            //     ? $atribut->popust_procenti * $cijenaRobe->ukupna_cijena / 100
            //     : 0;

            $jedinica_id = @$stavka['jedinica_id'] ?: $roba->jedinica_mjere_id;
            $porez_id = @$stavka['porez_id'] ?: $roba->porez_id;

            if (property_exists('atribut', $roba)) {
                $atribut = AtributRobe::where('id', $stavka['atribut_id'])->first();

                $popust_procenat =  $atribut->popust_procenti;
                $popust_iznos =  $atribut->popust_iznos;

                if ($popust_procenat > 0) {
                    $cijena_bez_pdv_popust =  $cijenaRobe->cijena_bez_pdv * (100 - $popust_procenat) / 100;
                    $cijena_sa_pdv_popust =  $cijenaRobe->ukupna_cijena * (100 - $popust_procenat) / 100;
                } else {
                    $cijena_sa_pdv_popust =  $cijenaRobe->ukupna_cijena - $popust_iznos;
                    $cijena_bez_pdv_popust =  $cijena_sa_pdv_popust / (1 + $stavka['pdv_iznos']);
                }
            } else {
                $popust_procenat =  0;
                $popust_iznos =  0;
                $cijena_sa_pdv_popust =  $cijenaRobe->ukupna_cijena;
                $cijena_bez_pdv_popust =  $cijena_sa_pdv_popust / (1 + $stavka['pdv_iznos']);
            }

            return StavkaRacuna::make([
                'naziv' => $roba->naziv,
                'opis' => $roba->opis, // kod gotovinskih upisuje opis stavke iz baze ne iz fronta
                'jedinicna_cijena_bez_pdv' => $cijenaRobe->cijena_bez_pdv,
                'cijena_bez_pdv_popust' => $cijena_bez_pdv_popust,
                'cijena_sa_pdv' => $cijenaRobe->ukupna_cijena,
                'cijena_sa_pdv_popust' => $cijena_sa_pdv_popust,
                'kolicina' => $stavka['kolicina'],
                'pdv_iznos' => $cijena_sa_pdv_popust / (1 + $stavka['pdv_iznos']) * $stavka['pdv_iznos'],
                'pdv_iznos_ukupno' => $cijena_sa_pdv_popust / (1 + $stavka['pdv_iznos']) * $stavka['pdv_iznos'] * $stavka['kolicina'],
                'popust_procenat' => $popust_procenat,
                'popust_iznos' =>   $popust_iznos,
                //'popust_na_jedinicnu_cijenu' => $grupa ? $grupa->popust_iznos : 0,
                'ukupna_bez_pdv' => $cijenaRobe->cijena_bez_pdv * $stavka['kolicina'],
                'ukupna_sa_pdv' => $cijenaRobe->ukupna_cijena * $stavka['kolicina'],
                'ukupna_bez_pdv_popust' => $cijena_bez_pdv_popust * $stavka['kolicina'],
                'ukupna_sa_pdv_popust' => $cijena_sa_pdv_popust * $stavka['kolicina'],
                'porez_id' => $porez_id,
                'jedinica_id' => $jedinica_id,
                'racun_id' => $this->id,
            ])->toArray();
        }
    }

    public function izracunajUkupneCijene()
    {
        $query = StavkaRacuna::where('racun_id', $this->id);
        $this->ukupna_cijena_bez_pdv = $query->sum('ukupna_bez_pdv');
        $this->ukupna_cijena_sa_pdv = $query->sum('ukupna_sa_pdv');
        $this->ukupna_cijena_bez_pdv_popust = $query->sum('ukupna_bez_pdv_popust');
        $this->ukupna_cijena_sa_pdv_popust = $query->sum('ukupna_sa_pdv_popust');
        $this->ukupan_iznos_pdv = $query->sum('pdv_iznos_ukupno');
        //$this->ukupna_cijena_bez_pdv = $this->ukupna_cijena_sa_pdv - $this->ukupan_iznos_pdv;
        $this->popust_ukupno =  $this->ukupna_cijena_sa_pdv -  $this->ukupna_cijena_sa_pdv_popust;
        //$this->popust_ukupno = $query->sum('popust_na_jedinicnu_cijenu');
        $this->save();
    }

    public function izracunajPoreze()
    {
        $porezi_za_racun = StavkaRacuna::groupBy('racun_id', 'porez_id')
            ->selectRaw('sum(pdv_iznos*kolicina) as pdv_iznos_ukupno, racun_id, porez_id')
            ->where('racun_id', $this->id)
            ->get()->toArray();

        DB::table('porezi_za_racun')->insert($porezi_za_racun);
    }

    // public static function izracunajBrojRacuna()
    // {
    //     $broj_racuna = DB::table('racuni')->where('tip_racuna', Racun::RACUN)->whereNotNull('qr_url')->max('broj_racuna');      #moze i bez provjere za tip_racuna
    //     return $broj_racuna + 1;
    // }

    public static function izracunajRedniBrojRacuna()
    {
        // whereNotNull('qr_url') ako treba da se ne dodjeljuje redni broj nefiskalizovanim racunima
        if (Racun::filterByPermissions()->where('tip_racuna', Racun::RACUN)->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->first() == null) {
            $podesavanjeRedniBroj = Podesavanje::filterByPermissions()->select('redni_broj')->first();
            $redni_broj = $podesavanjeRedniBroj ? $podesavanjeRedniBroj->redni_broj : 1;
        } else {
            $redni_broj = Racun::filterByPermissions()->where('tip_racuna', Racun::RACUN)->whereYear('created_at', \Carbon\Carbon::now()->format('Y'))->max('redni_broj') + 1;
        }

        return $redni_broj;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function guestUsers()
    {
        return $this->belongsToMany('App\Models\User', 'users_racuni', 'racun_id', 'user_id');
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

    public function preduzece()
    {
        return $this->belongsTo('App\Models\Preduzece', 'preduzece_id');
    }
}
