<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Racun;
use Illuminate\Http\Request;

class PredracunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        auth()->user()->can('view Predracun');

        if ($request->search) {
            $searchQuery = Racun::search($request->search . '*')->query(function ($query) {
                return $query->filterByPermissions();
            })->orderBy('created_at', 'DESC');

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

            $partneriQuery = Partner::whereIn('id', $partneri)->with('preduzece:id,kratki_naziv', 'fizicko_lice:id,ime,prezime')->get();

            $ukupnaCijenaSearch =
                collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($searchQuery)]);
            $searchData = $ukupnaCijenaSearch->merge($paginatedSearch);

            $searchAllData = $searchData->merge(collect(["partneri" => $partneriQuery]));

            return $searchAllData;
        }

        if ($request->status || $request->startDate || $request->endDate) {
            $query = Racun::filter($request)->query(function ($query) {
                return $query->filterByPermissions();
            });

            $query = $query->where('tip_racuna', Racun::PREDRACUN);

            $paginatedData = $query
                ->with(
                    'partner:id,preduzece_id,fizicko_lice_id',
                    'partner.preduzece_id:id,kratki_naziv',
                    'partner.fizicko_lice:id,ime,prezime'
                )->with('partner.preduzece:id,kratki_naziv')->with('partner.preduzece:id,ime,prezime')->paginate();
            $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($query)]);
            $data = $ukupnaCijena->merge($paginatedData);

            return $data;
        }

        $queryAll = Racun::query()->filterByPermissions()->orderBy('created_at', 'DESC');
        $queryAll = $queryAll->where('tip_racuna', Racun::PREDRACUN);

        $paginatedData = $queryAll
            ->with(
                'partner:id,preduzece_id,fizicko_lice_id',
                'partner.preduzece:id,kratki_naziv',
                'partner.fizicko_lice:id,ime,prezime'
            )->paginate();
        $ukupnaCijena = collect(["ukupna_cijena" => Racun::izracunajUkupnuCijenu($queryAll)]);
        $data = $ukupnaCijena->merge($paginatedData);

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
        auth()->user()->can('store Predracun');

        $racun = Racun::make($request->validated());
        $racun->tip_racuna = Racun::PREDRACUN;
        $racun->user_id = auth()->id();
        $racun->preduzece_id = getAuthPreduzeceId($request);
        $racun->save();

        $racun->kreirajStavke($request);

        return response()->json($racun, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */
    public function show(Racun $racun)
    {
        auth()->user()->can('show Predracun');

        return $racun->load(['stavke', 'porezi']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Racun  $racun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Racun $racun)
    {
        auth()->user()->can('update Predracun');

        $ikof = $request->input('ikof');
        $jikr = $request->input('jikr');

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
}
