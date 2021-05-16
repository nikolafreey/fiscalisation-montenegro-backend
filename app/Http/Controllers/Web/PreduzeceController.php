<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UpdatePreduzece;
use App\Models\Paket;
use App\Models\PoslovnaJedinica;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class PreduzeceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Preduzece::class, 'preduzece');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                Preduzece::query()->with('paketi')
            )
                ->addColumn('action', function ($preduzece) {
                    return view('admin.preduzeca.action', compact('preduzece'));
                })
                ->make();
        }

        return view('admin.preduzeca.index');
    }

    public function edit(Preduzece $preduzece)
    {
        return view('admin.preduzeca.edit', [
            'preduzece' => $preduzece
        ]);
    }

    public function update(Preduzece $preduzece, UpdatePreduzece $request)
    {
        $preduzece->update(array_filter($request->validated()));

        if($request->poslovneJedinice !== null) {
            foreach($request->poslovneJedinice as $row){
                $poslovnaJedinica = PoslovnaJedinica::find($row['id']);
                $poslovnaJedinica->kod_poslovnog_prostora = $row['kod_poslovnog_prostora'];
                $poslovnaJedinica->save();
            }
        }

        $request->session()->flash('success', 'Uspješno ste izmijenili sertifikat preduzeća');

        return redirect(route('preduzeca.index'));
    }

    public function izmjenitePaket(Preduzece $preduzece)
    {
        return view('admin.preduzeca.dodavanjePaketa', [
            'paketi' => Paket::all(),
            'preduzece' => $preduzece,
            'osnovniCount' => $preduzece->paketi->where('naziv', 'Osnovni')->count(),
            'startCount' => $preduzece->paketi->where('naziv', 'Start')->count(),
            'proCount' => $preduzece->paketi->where('naziv', 'Pro')->count(),
        ]);
    }

    public function updatePaket(Preduzece $preduzece, Request $request)
    {
        $preduzece->paketi()->sync([]);

        $osnovni = Paket::where('naziv', 'Osnovni')->first()->id;
        for ($a = 1; $a <= $request->osnovni; $a++) {
            $preduzece->paketi()->attach($osnovni);
        }

        $start = Paket::where('naziv', 'Start')->first()->id;
        for ($b = 1; $b <= $request->start; $b++) {
            $preduzece->paketi()->attach($start);
        }

        $pro = Paket::where('naziv', 'Pro')->first()->id;
        for ($c = 1; $c <= $request->pro; $c++) {
            $preduzece->paketi()->attach($pro);
        }

        $preduzece->update([
            'vazenje_paketa_do' => $request->datum
        ]);

        $request->session()->flash('success', 'Uspješno ste izmijenili pakete preduzeća');

        return redirect(route('preduzeca.index'));
    }

}
