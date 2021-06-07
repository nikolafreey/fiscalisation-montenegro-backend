<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StorePreduzece;
use App\Http\Requests\Api\UpdatePreduzece;
use App\Models\Preduzece;
use App\Models\ZiroRacun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Preduzece
 *
 * Class PreduzeceController
 * @package App\Http\Controllers
 */

class PreduzeceController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Preduzece::class, 'preduzece');
    // }

    /**
     * Izlistavanje resursa
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            return Preduzece::search($request->search . '*')->with('partneri', 'ziro_racuni:id,preduzece_id,broj_racuna', 'djelatnosti')->paginate(50);
        }

        return Preduzece::with('partneri', 'ziro_racuni:id,preduzece_id,broj_racuna', 'djelatnosti')->orderBy('created_at', 'DESC')->paginate(15);
    }

    /**
     * Čuvanje resursa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreduzece $request)
    {
        $preduzece = DB::transaction(
            function () use ($request) {
                $preduzece = Preduzece::make($request->validated());
                $preduzece->pdv_obveznik = $request->pdv_obveznik;

                $preduzece->save();

                if (count($request->ziro_racuni) !== 0) {
                    $ziro_racuni = $request->ziro_racuni;
                    foreach ($ziro_racuni as $ziro_racun) {
                        $zr = ZiroRacun::make($ziro_racun);
                        $zr->user_id = auth()->id();
                        $zr->preduzece_id = $preduzece->id;
                        $zr->save();
                        $ziro_racuni_objects[] = $zr;
                    }
                    $preduzece->ziro_racuni()->saveMany($ziro_racuni_objects);
                }

                DB::insert('insert into preduzece_djelatnost (preduzece_id, djelatnost_id, created_at, updated_at) values (?, ?, now(), now())', [$preduzece->id, $request->djelatnost_id]);

                return $preduzece;
            }
        );

        return response()->json($preduzece, 201);
    }

    /**
     * Prikaz resursa
     *
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function show(Preduzece $preduzece)
    {
        return response()->json($preduzece->load('ovlascena_lica', 'djelatnosti', 'kategorija', 'ziro_racuni'), 200);
    }

    /**
     * Izmjena resursa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreduzece $request, Preduzece $preduzece)
    {
        if ($preduzece->verifikovan === 1) {
            if (
                !auth()->user()->hasRole('Vlasnik')
                ||
                !in_array($preduzece->id, auth()->user()->preduzeca->pluck('id')->toArray())
            ) {
                return response()->json('Nemate pristup ovom preduzecu', 401);
            }
        }

        if ($request->ziro_racuni && count($request->ziro_racuni) !== 0) {
            $preduzece->ziro_racuni()->delete();

            $ziro_racuni = $request->ziro_racuni;
            foreach ($ziro_racuni as $ziro_racun) {
                $zr = ZiroRacun::make($ziro_racun);
                $zr->user_id = auth()->id();
                $zr->preduzece_id = $preduzece->id;
                $zr->save();
                $ziro_racuni_objects[] = $zr;
            }
            $preduzece->ziro_racuni()->saveMany($ziro_racuni_objects);
        }

        if ($request->hasFile('pecat') || $request->has('potpis')) {
            $preduzece->setPecatAttribute($request->pecat);
            $preduzece->pecatSifra = $request->pecatSifra != null ? encrypt($request->pecatSifra) : null;
            $preduzece->setSertifikatAttribute($request->potpis);
            $preduzece->sertifikatSifra =
                $request->sertifikatSifra != null ? encrypt($request->sertifikatSifra) : null;
        } else {
            $preduzece->update(array_filter($request->validated()));
        }

        $preduzece->pdv_obveznik = $request->pdv_obveznik;
        $preduzece->pdv = $request->pdv;

        $preduzece->save();

        DB::update('update preduzece_djelatnost set djelatnost_id = ? AND updated_at = now() where preduzece_id = ?', [$preduzece->id, $request->djelatnost_id]);

        return response()->json($preduzece, 200);
    }

    /**
     * Brisanje resursa
     *
     * @param  \App\Models\Preduzece  $preduzece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preduzece $preduzece)
    {
        if (
            !auth()->user()->hasRole('Vlasnik')
            &&
            !auth()->user()->preduzeca()->where('preduzeca.id', $preduzece->id)->exists()
        ) {
            abort(403);
        }

        $preduzece->delete();

        return response()->json($preduzece, 200);
    }
}
