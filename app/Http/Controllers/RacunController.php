<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\DijeljenjeRacunaRequest;
use App\Http\Requests\Api\StoreRacun;
use App\Jobs\Fiskalizuj;
use App\Models\AtributRobe;
use App\Models\Grupa;
use App\Models\Invite;
use App\Models\Partner;
use App\Models\Preduzece;
use App\Models\Racun;
use App\Models\User;
use App\Notifications\NalogRegistrovan;
use App\Notifications\PodijeliRacunGostu;
use App\Notifications\PodijeliRacunKorisniku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
        Log::info('ssssss', array($request->all()));
        if ($request->search) {
            $searchQuery = Racun::filterByPermissions()->search($request->search . '*')->orderBy('created_at', 'DESC');

            $paginatedSearch = $searchQuery
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->paginate(10);

            $partneri = [];
            foreach ($searchQuery->get()->toArray() as $partner) {
                $partneri[] = $partner['partner_id'];
            }

            $queryPartneri = Partner::whereIn('id', $partneri)->with('preduzece:id,kratki_naziv', 'fizicko_lice:id,ime,prezime')->get();

            $ukupnaCijenaSearch =
                collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($searchQuery)]);
            $searchData = $ukupnaCijenaSearch->merge($paginatedSearch);

            $searchDataAll = $searchData->merge(collect(["partneri" => $queryPartneri]));

            return $searchDataAll;
        }

        if ($request->status || $request->startDate || $request->endDate) {
            $query = Racun::filter($request)->filterByPermissions();

            $query = $query->where('tip_racuna', Racun::RACUN);

            $paginatedData = $query
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.fizicko_lice:id,ime,prezime')->paginate(10);
            $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($query)]);
            $data = $ukupnaCijena->merge($paginatedData);

            return $data;
        }

        $queryAll = Racun::query()->filterByPermissions()->orderBy('created_at', 'DESC');
        $queryAll = $queryAll->where('tip_racuna', Racun::RACUN);

        $paginatedData = $queryAll
            ->with(
                'partner:id,preduzece_id,fizicko_lice_id',
                'partner.preduzece:id,kratki_naziv',
                'partner.fizicko_lice:id,ime,prezime'
            )->paginate(10);
        $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($queryAll)]);
        $data = $ukupnaCijena->merge($paginatedData);

        return $data;
    }

    public function najveciKupci(Request $request)
    {
        $data = DB::select(DB::raw("SELECT SUM(racuni.ukupan_iznos_pdv) AS ukupan_promet, preduzeca.*, racuni.* FROM racuni, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'Plaćen' AND racuni.preduzece_id = preduzeca.id GROUP BY preduzeca.id ORDER BY ukupan_promet DESC LIMIT 3"));

        return $data;
    }

    public function najveciDuznici(Request $request)
    {
        $data = DB::select(DB::raw("SELECT SUM(racuni.ukupan_iznos_pdv) AS ukupan_promet, preduzeca.*, racuni.* FROM racuni, preduzeca WHERE tip_racuna='racun' AND racuni.status = 'Čeka se' AND racuni.preduzece_id = preduzeca.id GROUP BY preduzeca.id ORDER BY ukupan_promet DESC LIMIT 3"));

        return $data;
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

        $queryAllPdv = $queryAll->where('tip_racuna', Racun::RACUN)->get();
        $queryPdv = $query->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->where('tip_racuna', Racun::RACUN)->get();
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

        $queryPlacen = $queryP->where('status', 'Plaćen')->where('tip_racuna', Racun::RACUN)->get();
        $queryNenaplativ = $queryN->where('status', 'Nenaplativ')->where('tip_racuna', Racun::RACUN)->get();
        $queryCekaSe = $queryC->where('status', 'Čeka se')->where('tip_racuna', Racun::RACUN)->get();

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
            // $racun->tip_racuna = Racun::RACUN;
            $racun->broj_racuna = Racun::izracunajBrojRacuna();
            $racun->datum_izdavanja = now();

            $racun->user_id = auth()->id();

            $racun->preduzece_id = getAuthPreduzeceId($request);

            $racun->poslovna_jedinica_id = getAuthPoslovnaJedinicaId($request);

            $date = \Illuminate\Support\Carbon::createFromDate(now()->year);

            $startOfYear = $date->copy()->startOfYear();
            $endOfYear   = $date->copy()->endOfYear();

            $preduzece = Preduzece::find(getAuthPreduzeceId($request));

            if ($preduzece->racuni->whereBetween('created_at', [$startOfYear, $endOfYear]) === null) {
                $racun->redni_broj = $preduzece->podesavanje->redni_broj;
            } else {
                $racun->redni_broj = $preduzece->racuni->max('redni_broj') + 1;
            }

            $racun->save();

            if ($preduzece->podesavanje !== null) {
                if ($preduzece->podesavanje->slanje_kupcu) {
                    $kupacEmail = $racun->partner->fizicko_lice->email;

                    if (User::where('email', $kupacEmail)->exists()) {
                        User::where('email', $kupacEmail)->first()->guestRacuni()->attach($racun->id);

                        $user = User::where('email', $kupacEmail)->first();
                        $user->notify(new PodijeliRacunKorisniku($racun, $user));
                    } else {
                        $invite = Invite::create([
                            'email' => $kupacEmail,
                            'route' => route('racuni.show', $racun),
                            'token' => Str::random(40),
                            'racun_id' => $racun->id,
                        ]);

                        Notification::route('mail', $kupacEmail)->notify(new PodijeliRacunGostu($invite));
                    }
                }
            }

            $racun->kreirajStavke($request);
            Log::info('suma: ' . var_export($racun->izracunajUkupneCijene(), true));

            $racun->izracunajUkupneCijene();
            $racun->izracunajPoreze();


            return $racun;
        });

        Fiskalizuj::dispatch($racun)->onConnection('sync');

        return response()->json($racun->fresh()->load('porezi', 'stavke'), 201);
    }

    public function stornirajRacun(Racun $racun)
    {
        $ukupna_cijena_bez_pdv = $racun->ukupna_cijena_bez_pdv * -1;
        $ukupna_cijena_bez_pdv_popust = $racun->ukupna_cijena_bez_pdv_popust * -1;
        $ukupna_cijena_sa_pdv = $racun->ukupna_cijena_sa_pdv * -1;
        $ukupna_cijena_sa_pdv_popust = $racun->ukupna_cijena_sa_pdv_popust * -1;
        $ukupan_iznos_pdv = $racun->ukupan_iznos_pdv * -1;

        $storniranRacun = $racun->replicate()->fill([
            'status' => 'storniran',
            'korektivni_racun_vrsta' => 'CORRECTIVE',
            'ukupna_cijena_bez_pdv' => $ukupna_cijena_bez_pdv,
            'ukupna_cijena_bez_pdv_popust' => $ukupna_cijena_bez_pdv_popust,
            'ukupna_cijena_sa_pdv' => $ukupna_cijena_sa_pdv,
            'ukupna_cijena_sa_pdv_popust' => $ukupna_cijena_sa_pdv_popust,
            'ukupan_iznos_pdv' => $ukupan_iznos_pdv,
        ]);

        $storniranRacun->save();

        foreach ($racun->stavke as $stavka) {
            $jedinicna_cijena_bez_pdv = $stavka->jedinicna_cijena_bez_pdv * -1;
            $jedinicna_cijena_sa_pdv = $stavka->jedinicna_cijena_sa_pdv * -1;
            $cijena_bez_pdv = $stavka->cijena_bez_pdv * -1;
            $pdv_iznos = $stavka->pdv_iznos * -1;
            $popust_iznos = $stavka->popust_iznos * -1;
            $cijena_sa_pdv = $stavka->cijena_sa_pdv * -1;


            $cijena_bez_pdv_popust = $stavka->cijena_bez_pdv_popust * -1;
            $cijena_sa_pdv_popust = $stavka->cijena_sa_pdv_popust * -1;
            $ukupna_bez_pdv = $stavka->ukupna_bez_pdv * -1;
            $ukupna_sa_pdv = $stavka->ukupna_sa_pdv * -1;
            $ukupna_sa_pdv_popust = $stavka->ukupna_sa_pdv_popust * -1;
            $ukupna_bez_pdv_popust = $stavka->ukupna_bez_pdv_popust * -1;
            $pdv_iznos_ukupno = $stavka->pdv_iznos_ukupno * -1;

            $storniranaStavka = $stavka->replicate()->fill([
                'racun_id' => $storniranRacun->id,
                'jedinicna_cijena_bez_pdv' =>  $jedinicna_cijena_bez_pdv,
                'jedinicna_cijena_sa_pdv' =>  $jedinicna_cijena_sa_pdv,
                'cijena_bez_pdv' =>  $cijena_bez_pdv,
                'pdv_iznos' =>  $pdv_iznos,
                'popust_iznos' =>  $popust_iznos,
                'cijena_sa_pdv' =>  $cijena_sa_pdv,
                'cijena_bez_pdv_popust' =>  $cijena_bez_pdv_popust,
                'cijena_sa_pdv_popust' => $cijena_sa_pdv_popust,
                'ukupna_bez_pdv' => $ukupna_bez_pdv,
                'ukupna_sa_pdv_popust' => $ukupna_sa_pdv_popust,
                'ukupna_sa_pdv' => $ukupna_sa_pdv,
                'ukupna_bez_pdv_popust' => $ukupna_bez_pdv_popust,
                'pdv_iznos_ukupno' => $pdv_iznos_ukupno,
            ]);

            $storniranaStavka->save();
        }

        return response()->json($storniranRacun->load('stavke'), 201);
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

        return $racun->load(['stavke', 'porezi', 'partner', 'preduzece']);
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
        $tipovi_atributa = AtributRobe::get(['id AS tip_atributa_id', 'naziv'])->toArray();
        $grupe = Grupa::get(['id AS grupa_id', 'naziv'])->toArray();
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
        return Racun::filterByPermissions()->whereNull('ikof')->get();
    }

    public function fiskalizujRacun(Racun $racun)
    {
        Fiskalizuj::dispatch($racun)->onConnection('sync');

        return response()->json($racun, 201);
    }
}
