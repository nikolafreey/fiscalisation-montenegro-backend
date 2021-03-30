<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\TipAtributa;
use App\Models\UlazniRacun;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\queue;

class UlazniRacunController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(UlazniRacun::class, 'ulazniRacun');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $searchQuery = UlazniRacun::search($request->search . '*')->orderBy('created_at', 'DESC');

            $paginatedSearch = $searchQuery
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece_id:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.fizicko_lice:id,ime,prezime')->paginate();

            $partneri = [];
            foreach ($searchQuery->get()->toArray() as $partner) {
                $partneri[] = $partner['partner_id'];
            }

            $queryPartneri = Partner::whereIn('id', $partneri)->with('preduzece:id,kratki_naziv', 'fizicko_lice:id,ime,prezime')->get();

            $ukupnaCijenaSearch =
                collect(["ukupna_cijena" => UlazniRacun::izracunajUkupnuCijenu($searchQuery)]);
            $searchData = $ukupnaCijenaSearch->merge($paginatedSearch);

            $searchAllData = $searchData->merge(collect(["partneri" => $queryPartneri]));

            return $searchAllData;
        }

        if ($request->status || $request->startDate || $request->endDate) {
            $query = UlazniRacun::filter($request);

            $paginatedData = $query
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece_id:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.fizicko_lice:id,ime,prezime')->paginate();
            $ukupnaCijena = collect(["ukupna_cijena" => UlazniRacun::izracunajUkupnuCijenu($query)]);
            $data = $ukupnaCijena->merge($paginatedData);

            return $data;
        }

        $queryAll = UlazniRacun::query();

        $paginatedData = $queryAll
            ->with(
                'partner:id,preduzece_id,fizicko_lice_id',
                'partner.preduzece:id,kratki_naziv',
                'partner.fizicko_lice:id,ime,prezime'
            )->paginate();
        $ukupnaCijena = collect(["ukupna_cijena" => UlazniRacun::izracunajUkupnuCijenu($queryAll)]);
        $data = $ukupnaCijena->merge($paginatedData);

        return $data;
    }

    public function ulazniRacuniDanas(Request $request)
    {
        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $pocetakDana = "{$godina}-{$mjesec}-{$dan} 00:00:00";
        $krajDana = "{$godina}-{$mjesec}-{$dan} 23:59:59";

        $queryUlazniRacuniDanas = UlazniRacun::query();

        $queryUlazniRacuniDanas = DB::select(DB::raw('SELECT * FROM ulazni_racuni WHERE vrsta_racuna = "' . UlazniRacun::GOTOVINSKI . '" AND tip_racuna = "' . UlazniRacun::RACUN . '" AND datum_izdavanja BETWEEN "' . $pocetakDana . '" AND "' . $krajDana . '"'));

        $ukupnoUlazniRacuniDanas = 0;

        foreach ($queryUlazniRacuniDanas as $racunDanas) {
            $ukupnoUlazniRacuniDanas += $racunDanas->ukupna_cijena_sa_pdv;
        }

        return collect(['ukupno_ulazni_racuni_danas' => $ukupnoUlazniRacuniDanas]);
    }

    public function ulazniRacuniPdv(Request $request)
    {
        $query = UlazniRacun::query();
        $queryAll = UlazniRacun::query();
        $queryPoredjenje = UlazniRacun::query();

        $dan = Carbon::now()->day;
        $mjesec = Carbon::now()->month;
        $godina = Carbon::now()->year;

        $prviUMjesecu = "{$godina}-{$mjesec}-1 00:00:00";
        $prviUMjesecu = Carbon::parse($prviUMjesecu);
        $prethodniMjesec = Carbon::parse($prviUMjesecu)->subMonthNoOverflow();

        $queryAllPdv = $queryAll->where('tip_racuna', UlazniRacun::RACUN)->get();
        $queryPdv = $query->where('datum_izdavanja', '>=', "{$godina}-{$mjesec}-1 23:59:59")->where('tip_racuna', UlazniRacun::RACUN)->get();
        $queryPoredjenje = DB::select(DB::raw('SELECT * FROM `ulazni_racuni` WHERE datum_izdavanja BETWEEN "' . $prethodniMjesec . '" AND "' . $prviUMjesecu . '"'));

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ulazniracun = UlazniRacun::make($request->validated());
        $ulazniracun->user_id = auth()->id();
        $user = User::find(auth()->id())->load('preduzeca');
        $ulazniracun->preduzece_id = $user['preduzeca'][0]->id;
        $ulazniracun->save();

        $ulazniracun->kreirajStavke($request);

        return response()->json($ulazniracun, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UlazniRacun  $ulazniracun
     * @return \Illuminate\Http\Response
     */
    public function show(UlazniRacun $ulazniracun)
    {
        return $ulazniracun->load(['ulazne_stavke', 'porezi']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UlazniRacun  $ulazniracun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UlazniRacun $ulazniracun)
    {
        $ikof = $request->input('ikof');
        $jikr = $request->input('jikr');

        if (($ikof == null || $ikof == '') && ($jikr == null || $jikr == '')) {

            $ulazniracun->update($request->validated());
            return response()->json($ulazniracun, 200);
        } else {
            return response()->json($ulazniracun, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UlazniRacun  $ulazniracun
     * @return \Illuminate\Http\Response
     */
    public function destroy(UlazniRacun $ulazniracun)
    {
        //
    }
}
