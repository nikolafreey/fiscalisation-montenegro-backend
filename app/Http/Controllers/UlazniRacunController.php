<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreUlazniRacun;
use App\Models\Partner;
use App\Models\UlazniRacun;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $searchQuery = UlazniRacun::filterByPermissions()->search($request->search . '*')->orderBy('created_at', 'DESC');

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

            return $searchData->merge(collect(["partneri" => $queryPartneri]));
        }

        if ($request->status || $request->startDate || $request->endDate) {
            $query = UlazniRacun::filter($request)->filterByPermissions();

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

        $queryAll = UlazniRacun::query()->filterByPermissions();

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
    public function store(StoreUlazniRacun $request)
    {
        $ulazniRacun = UlazniRacun::make($request->validated());
        $ulazniRacun->user_id = auth()->id();

        $ulazniRacun->preduzece_id = getAuthPreduzeceId($request);
        $ulazniRacun->save();

        $ulazniRacun->kreirajStavke($request);

        return response()->json($ulazniRacun, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UlazniRacun  $ulazniRacun
     * @return \Illuminate\Http\Response
     */
    public function show(UlazniRacun $ulazniRacun)
    {
        return $ulazniRacun->load(['ulazne_stavke', 'porezi']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UlazniRacun  $ulazniRacun
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUlazniRacun $request, UlazniRacun $ulazniRacun)
    {
        $ikof = $request->input('ikof');
        $jikr = $request->input('jikr');

        if (($ikof == null || $ikof == '') && ($jikr == null || $jikr == '')) {

            $ulazniRacun->update($request->validated());
            return response()->json($ulazniRacun, 200);
        } else {
            return response()->json($ulazniRacun, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UlazniRacun  $ulazniRacun
     * @return \Illuminate\Http\Response
     */
    public function destroy(UlazniRacun $ulazniRacun)
    {
        //
    }
}
