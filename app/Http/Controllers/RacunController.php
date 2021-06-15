<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\DijeljenjeRacunaRequest;
use App\Http\Requests\Api\StoreRacun;
use App\Jobs\Fiskalizuj;
use App\Jobs\Storniraj;
use App\Models\AtributRobe;
use App\Models\DepozitWithdraw;
use App\Models\FailedJobsCustom;
use App\Models\FizickoLice;
use App\Models\Grupa;
use App\Models\Invite;
use App\Models\Partner;
use App\Models\Preduzece;
use App\Models\Racun;
use App\Models\User;
use App\Notifications\PodijeliRacunGostu;
use App\Notifications\PodijeliRacunKorisniku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use ScoutElastic\Searchable;

class RacunController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Racun::class, 'racun');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use Searchable;

    public function index(Request $request)
    {
        if ($request->search && !$request->status && !$request->startDate && !$request->endDate) {
            $searchQuery = Racun::search($request->search . '*')->query(function ($query) {
                return $query->filterByPermissions();
            })->orderBy('created_at', 'DESC');

            $paginatedSearch = $searchQuery
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id,preduzece_tabela_id',
                    'partner.preduzece:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime',
                    'partner.preduzece_partner'
                )->paginate(10);

            $partneri = [];
            foreach ($searchQuery->get()->toArray() as $partner) {
                $partneri[] = $partner['partner_id'];
            }

            $queryPartneri = Partner::whereIn('id', $partneri)->with('preduzece:id,kratki_naziv', 'fizicko_lice:id,ime,prezime', 'preduzece_partner')->get();

            $ukupnaCijenaSearch =
                collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($searchQuery)]);
            $searchData = $ukupnaCijenaSearch->merge($paginatedSearch);

            $searchDataAll = $searchData->merge(collect(["partneri" => $queryPartneri]));

            return $searchDataAll;
        }

        if ($request->status || $request->startDate || $request->endDate) {
            $query = Racun::filter($request);

            $query = $query->where('tip_racuna', Racun::RACUN);

            $paginatedData = $query
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id,preduzece_tabela_id',
                    'partner.preduzece:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime',
                    'partner.preduzece_partner'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.fizicko_lice:id,ime,prezime')->paginate(200); //TODO: Napraviti Paginaciju na frontu
            $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($query)]);
            $data = $ukupnaCijena->merge($paginatedData);

            return $data;
        }

        $queryAll = Racun::query()->filterByPermissions()->orderBy('created_at', 'DESC');
        $queryAll = $queryAll->where('tip_racuna', Racun::RACUN);

        $paginatedData = $queryAll
            ->with(
                'partner:id,preduzece_id,fizicko_lice_id,preduzece_tabela_id',
                'partner.preduzece:id,kratki_naziv',
                'partner.fizicko_lice:id,ime,prezime',
                'partner.preduzece_partner'
            )->paginate(10);
        $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($queryAll)]);
        $data = $ukupnaCijena->merge($paginatedData);

        return $data;
    }

    public function najveciKupci(Request $request)
    {
        // return Racun::where('tip_racuna', 'racun')
        //     ->where('status', 'placen')
        //     ->where('preduzece_id', getAuthPreduzeceId($request))
        //     ->where('created_at', '>', $sameDayLastYear)
        //     ->selectRaw("SUM(racuni.ukupan_iznos_pdv) as ukupan_promet")
        //     ->with('preduzece', 'preduzece.partneri')
        //     // ->groupBy('partner_id')
        //     ->get();

        return DB::select("SELECT SUM(racuni.ukupan_iznos_pdv) as ukupan_promet, preduzeca.* FROM racuni, partneri, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'placen' AND racuni.preduzece_id = ? AND racuni.partner_id = partneri.id AND partneri.preduzece_tabela_id = preduzeca.id GROUP BY partner_id", [getAuthPreduzeceId($request)]);
        // return DB::select("SELECT SUM(racuni.ukupan_iznos_pdv) AS ukupan_promet, preduzeca.*, racuni.* FROM racuni, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'placen' AND racuni.preduzece_id = ? AND racuni.created_at >= curdate() - interval 1 year", [getAuthPreduzeceId($request)]);
    }

    public function najveciDuznici(Request $request)
    {
        return DB::select("SELECT SUM(racuni.ukupan_iznos_pdv) as ukupan_promet, preduzeca.* FROM racuni, partneri, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'cekase' AND racuni.preduzece_id = ? AND racuni.partner_id = partneri.id AND partneri.preduzece_tabela_id = preduzeca.id GROUP BY partner_id", [getAuthPreduzeceId($request)]);

        // return DB::select("SELECT SUM(racuni.ukupan_iznos_pdv) AS ukupan_promet, preduzeca.*, racuni.* FROM racuni, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'cekase' AND racuni.preduzece_id = ? AND racuni.created_at >= curdate() - interval 1 year", [getAuthPreduzeceId($request)]);
    }

    public function izlazniRacuniDanas(Request $request)
    {
        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $pocetakDana = "{$godina}-{$mjesec}-{$dan} 00:00:00";
        $krajDana = "{$godina}-{$mjesec}-{$dan} 23:59:59";

        $queryRacuniDanas = DB::select(DB::raw('SELECT * FROM racuni WHERE deleted_at IS NULL AND vrsta_racuna = "' . Racun::GOTOVINSKI . '" AND tip_racuna = "' . Racun::RACUN . '" AND datum_izdavanja BETWEEN "' . $pocetakDana . '" AND "' . $krajDana . '"'));

        $ukupnoRacuniDanas = 0;

        foreach ($queryRacuniDanas as $racunDanas) {
            $ukupnoRacuniDanas += $racunDanas->ukupna_cijena_sa_pdv;
        }

        return collect(['ukupno_izlazni_racuni_danas' => $ukupnoRacuniDanas]);
    }

    public function racuniPdv(Request $request)
    {
        $query = Racun::query();
        $queryAll = Racun::query();
        $queryPoredjenje = Racun::query();

        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $prviUMjesecu = "{$godina}-{$mjesec}-1 00:00:00";
        $prviUMjesecu = Carbon::parse($prviUMjesecu);
        $prethodniMjesec = Carbon::parse($prviUMjesecu)->subMonthNoOverflow();

        $queryAllPdv = $queryAll->filterByPermissions()->where('tip_racuna', Racun::RACUN)->get();
        $queryPdv = $query->filterByPermissions()->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->where('tip_racuna', Racun::RACUN)->get();
        $queryPoredjenje = DB::select(DB::raw('SELECT * FROM `racuni` WHERE deleted_at IS NULL AND datum_izdavanja BETWEEN "' . $prethodniMjesec . '" AND "' . $prviUMjesecu . '"'));

        $ukupnaSuma = 0;
        $poslednjiMjesecSuma = 0;
        $poredjenjeSuma = 0;

        foreach ($queryAllPdv as $racunPdv) {
            $ukupnaSuma += $racunPdv->ukupan_iznos_pdv;
        }

        foreach ($queryPdv as $racun) {
            $poslednjiMjesecSuma += $racun->ukupan_iznos_pdv;
        }

        foreach ($queryPoredjenje as $racun) {
            $poredjenjeSuma += $racun->ukupna_cijena_sa_pdv;
        }

        $data = collect(["ukupan_iznos_pdv" => $ukupnaSuma, "ukupan_iznos_poslednji_mjesec" => $poslednjiMjesecSuma, "poredjenje_pdv" => $poredjenjeSuma]);

        return $data;
    }

    public function racuniStatus(Request $request)
    {
        $queryP = Racun::query();
        $queryN = Racun::query();
        $queryC = Racun::query();

        $queryPlacen = $queryP->filterByPermissions()->where('status', 'placen')->where('tip_racuna', Racun::RACUN)->get();
        $queryNenaplativ = $queryN->filterByPermissions()->where('status', 'nenaplativ')->where('tip_racuna', Racun::RACUN)->get();
        $queryCekaSe = $queryC->filterByPermissions()->where('status', 'cekase')->where('tip_racuna', Racun::RACUN)->get();

        $ukupnaCijenaPlacenSuma = 0;
        $ukupnaCijenaNenaplativSuma = 0;
        $ukupnaCijenaCekaSeSuma = 0;


        foreach ($queryPlacen as $racun) {
            $ukupnaCijenaPlacenSuma += $racun->ukupna_cijena_sa_pdv;
        }

        foreach ($queryNenaplativ as $racun) {
            $ukupnaCijenaNenaplativSuma += $racun->ukupna_cijena_sa_pdv;
        }

        foreach ($queryCekaSe as $racun) {
            $ukupnaCijenaCekaSeSuma += $racun->ukupna_cijena_sa_pdv;
        }

        $ukupnaCijenaPlacen = collect(["ukupna_cijena_placeni" => $ukupnaCijenaPlacenSuma]);
        $ukupnaCijenaNenaplativ = collect(["ukupna_cijena_nenaplativ" => $ukupnaCijenaNenaplativSuma]);
        $ukupnaCijenaCekaSe = collect(["ukupna_cijena_ceka_se" => $ukupnaCijenaCekaSeSuma]);

        $data = $ukupnaCijenaPlacen;
        $data = $data->merge($ukupnaCijenaCekaSe);
        $data = $data->merge($ukupnaCijenaNenaplativ);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRacun $request)
    {
        $racun = DB::transaction(function () use ($request) {
            $racun = Racun::make($request->validated());

            $preduzece = Preduzece::find(getAuthPreduzeceId($request));
            $date = \Illuminate\Support\Carbon::createFromDate(now()->year);

            //ispitamo da li postoji fizicko lice sa ime_korisnika
            if ($request->vrsta_racuna === 'gotovinski') {

                $depozit = DepozitWithdraw::filterByPermissions()->whereDate('created_at', Carbon::today())->first();
                if (!$depozit) {
                    abort(400, 'Neophodno je dodati depozit prije izdavanja gotovinskog računa!');
                }

                $fizickoLice = FizickoLice::where('ime', 'Anonimni')->first();
                if (!$fizickoLice) {
                    $fizickoLice = FizickoLice::make([
                        'ime' => 'Anonimni',
                        'prezime' => 'Kupac',
                        'jmbg' => '1234567891111',
                        'ib' => '12345678',
                        'adresa' => 'Adresa',
                        'grad' => 'Grad',
                        'drzava' => 'Drzava',
                        'status' => 'Status',
                        'telefon' => 'Telefon',
                        'telefon_viber' => 0,
                        'telefon_whatsapp' => 0,
                        'telefon_facetime' => 0,
                        'email' => 'anonimni.kupac@gmail.com',
                        'zanimanje' => 'Zanimanje',
                        'radno_mjesto' => 'RadnoMjesto',
                        'drzavljanstvo' => 'Drzavljanstvo',
                        'nacionalnost' => 'Nacionalnost',
                        'cv_link' => 'CvLink',
                        'avatar' => 'Avatar',
                    ]);

                    $fizickoLice->user_id = auth()->id();
                    $fizickoLice->preduzece_id = getAuthPreduzeceId($request);
                    $fizickoLice->save();

                    $partner = Partner::where('fizicko_lice_id', $fizickoLice->id)->first();
                    if (!$partner) {
                        $partner = Partner::make([
                            'kontakt_ime' => 'Anonimni',
                            'kontakt_prezime' => 'Kupac',
                            'fizicko_lice_id' => $fizickoLice->id,
                        ]);

                        $partner->user_id = auth()->id();
                        $partner->preduzece_id = getAuthPreduzeceId($request);
                        $partner->save();
                    }
                    $racun->partner_id = $partner->id;
                } else {
                    $partner = Partner::where('fizicko_lice_id', $fizickoLice->id)->first();
                    if (!$partner) {
                        $partner = Partner::make([
                            'kontakt_ime' => 'Anonimni',
                            'kontakt_prezime' => 'Kupac',
                            'fizicko_lice_id' => $fizickoLice->id,
                        ]);

                        $partner->user_id = auth()->id();
                        $partner->preduzece_id = getAuthPreduzeceId($request);
                        $partner->save();
                    }
                    $racun->partner_id = $partner->id;
                }

                $racun->status = 'placen';
            } else {
                $racun->partner_id = $request->partner_id;
            }

            // $racun->tip_racuna = Racun::RACUN;
            // InvNum="{{ implode('/', [$taxpayer['BU'], $racun->broj_racuna, $racun->created_at->format('Y'), $taxpayer['CR']]) }}"
            $ovaGodina = date('Y');

            $request->datum_izdavanja ? $racun->datum_izdavanja = $request->datum_izdavanja : $racun->datum_izdavanja = now();
            $racun->nacin_placanja = $request->nacin_placanja;
            $racun->tip_racuna = Racun::RACUN;

            $racun->user_id = auth()->id();

            $racun->preduzece_id = getAuthPreduzeceId($request);

            $racun->poslovna_jedinica_id = getAuthPoslovnaJedinicaId($request);

            // $startOfYear = $date->copy()->startOfYear();
            // $endOfYear   = $date->copy()->endOfYear();

            // if ($preduzece->racuni->whereBetween('created_at', [$startOfYear, $endOfYear]) === null) {
            //     $racun->redni_broj = $preduzece->podesavanje->redni_broj ? $preduzece->podesavanje->redni_broj : 1;
            // } else {
            //     $racun->redni_broj = $preduzece->racuni->max('redni_broj') + 1;
            // }

            $racun->redni_broj = Racun::izracunajRedniBrojRacuna();

            //TODO: Prepraviti poslovne_jedinice, treba da se proslijedi tacna poslovna jedinica a ne da se uzima prvi iz niza.
            $racun->broj_racuna = implode('/', [$preduzece->poslovne_jedinice[0]->kod_poslovnog_prostora, $racun->redni_broj, $ovaGodina, $preduzece->enu_kod]);

            $racun->save();

            // TODO: ispitati da li ovo radi
            // if ($preduzece->podesavanje !== null) {
            //     if ($preduzece->podesavanje->slanje_kupcu) {
            //         $kupacEmail = $racun->partner->fizicko_lice->email;

            //         if (User::where('email', $kupacEmail)->exists()) {
            //             User::where('email', $kupacEmail)->first()->guestRacuni()->attach($racun->id);

            //             $user = User::where('email', $kupacEmail)->first();
            //             $user->notify(new PodijeliRacunKorisniku($racun, $user));
            //         } else {
            //             $invite = Invite::create([
            //                 'email' => $kupacEmail,
            //                 'route' => route('racuni.show', $racun),
            //                 'token' => Str::random(40),
            //                 'racun_id' => $racun->id,
            //             ]);

            //             Notification::route('mail', $kupacEmail)->notify(new PodijeliRacunGostu($invite));
            //         }
            //     }
            // }

            $racun->kreirajStavke($request);
            Log::info('suma: ' . var_export($racun->izracunajUkupneCijene(), true));

            $racun->izracunajUkupneCijene();
            $racun->izracunajPoreze();

            return $racun;
        });

        Fiskalizuj::dispatch($racun)->onConnection('sync');

        return response()->json($racun->fresh()->load('porezi', 'stavke'), 201);
    }

    public function stornirajRacun(Racun $racun, Request $request)
    {
        if (! getAuthPreduzeceId($request) === $racun->preduzece_id) {
            return response()->json('Nemate dozvolu da stornirate ovaj racun!', 400);
        }

        if ($racun->status === 'storniran') {
            abort(400, 'Račun je već storniran');
        }

        $storniranRacun = $racun->replicate()->fill([
            'created_at' => Carbon::now(),
            'status' => 'storniran'
        ]);

        $storniranRacun->save();

        if (isset($request->stavke) || !empty($request->stavke)) {
            foreach ($racun->stavke as $stavka) {
                if (!in_array($stavka->id, $request->stavke)) {
                    $stavka = $stavka->replicate()->fill([
                        'racun_id' => $storniranRacun->id,
                    ]);

                    $stavka->save();
                } else {
                    $stavka = $stavka->replicate()->fill([
                        'ukupna_bez_pdv' => $stavka->ukupna_bez_pdv * -1,
                        'ukupna_sa_pdv' => $stavka->ukupna_sa_pdv * -1,
                        'kolicina' => $stavka->kolicina * -1,
                        'racun_id' => $storniranRacun->id,
                    ]);

                    $stavka->save();
                }
            }
        } else {
            foreach ($racun->stavke as $stavka) {
                $stavka = $stavka->replicate()->fill([
                    'ukupna_bez_pdv' => $stavka->ukupna_bez_pdv * -1,
                    'ukupna_sa_pdv' => $stavka->ukupna_sa_pdv * -1,
                    'kolicina' => $stavka->kolicina * -1,
                    'racun_id' => $storniranRacun->id,
                ]);

                $stavka->save();
            }
        }

        foreach ($racun->porezi as $porez) {
            $storniranRacun->porezi()->attach($porez);
        }

        Storniraj::dispatch(
            $storniranRacun,
            $racun->ikof,
            $racun->created_at,
            $request->stavke,
            $racun->stavke
        )
            ->onConnection('sync');

        return response()->json($storniranRacun->load('stavke', 'porezi'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */
    public function show(Racun $racun, Request $request)
    {
        if (
            getAuthPreduzeceId($request) != $racun->preduzece_id
            &&
            !in_array(auth()->id(), $racun->guestUsers->pluck('id')->toArray(), true)
        ) {
            return response()->json(['message' => 'Nemate pristup ovom racunu'], 401);
        }

        return $racun->load(['stavke', 'porezi', 'partner', 'preduzece', 'partner.preduzece_partner', 'partner.fizicko_lice', 'partner.fizicko_lice.ziro_racuni', 'preduzece.users', 'preduzece.ziro_racuni']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */

    public function update(StoreRacun $request, Racun $racun)
    {
        $ikof = $request->input('ikof');
        $jikr = $request->input('jikr');

        Log::info('update1: ' . var_export($request->input('jikr'), true));

        if (($ikof == null || $ikof == '') && ($jikr == null || $jikr == '')) {

            $racun->update($request->validated());
            return response()->json($racun, 200);
        } else {
            return response()->json($racun, 400);
        }
    }

    public function updateStatus(Request $request, Racun $racun)
    {
        $ikof = $request->input('ikof');
        $jikr = $request->input('jikr');
        $status = $request->input('status');

        if (($ikof != null || $ikof != '') && ($jikr != null || $jikr != '')) {

            $racun->status = $status;
            $racun->save();
            return response()->json($request->status, 200);
        }

        return response()->json('Račun mora biti fiskalizovan i sačuvan da bi ste izmjenili status!', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Racun $racun)
    {
        //
    }

    public function getAtributiGrupe()
    {
        $tipovi_atributa = AtributRobe::filterByPermissions()->get(['id AS tip_atributa_id', 'naziv'])->toArray();
        $grupe = Grupa::filterByPermissions()->get(['id AS grupa_id', 'naziv'])->toArray();
        return array_merge($tipovi_atributa, $grupe);
    }

    public function dijeljenjeRacuna(Racun $racun, DijeljenjeRacunaRequest $request)
    {
        if (!in_array($racun->id, auth()->user()->racuni->pluck('id')->toArray())) {
            return response()->json('Nemate pravo da dijelite ovaj racun', 401);
        }

        if (User::where('email', $request->email)->exists()) {
            User::where('email', $request->email)->first()->guestRacuni()->attach($racun->id);

            $user = User::where('email', $request->email)->first();
            $user->notify(new PodijeliRacunKorisniku($racun, $user));
        } else {
            $invite = Invite::create([
                'email' => $request->email,
                'route' => route('racuni.show', $racun),
                'token' => Str::random(40),
                'racun_id' => $racun->id,
            ]);

            Notification::route('mail', $request->email)->notify(new PodijeliRacunGostu($invite));
        }

        return response()->json('Uspjesno ste poslali racun na mejl korisnika');
    }

    public function nefiskalizovaniRacuni()
    {
        return Racun::filterByPermissions()->whereNull('jikr')->get();
    }

    public function fiskalizujRacun(Racun $racun)
    {
        if ($racun->jikr !== null) {
            return response()->json('Ovaj racun je vec fiskalizovan!', 400);
        }

        Fiskalizuj::dispatch($racun, $racun->ikof)->onConnection('sync');

        FailedJobsCustom::where('payload', $racun->id)->delete();

        return response()->json('Uspjesno ste fiskalizovali racun', 200);
    }
}
