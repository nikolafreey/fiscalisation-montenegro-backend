<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UpdatePreduzece;
use App\Models\Paket;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;
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
        };

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
        $preduzece->update($request->validated());

        return redirect(route('preduzeca.index'));
    }

    public function izmjenitePaket(Preduzece $preduzece)
    {
        return view('admin.preduzeca.dodavanjePaketa', [
            'paketi' => Paket::all(),
            'preduzece' => $preduzece
        ]);
    }

    public function updatePaket(Preduzece $preduzece, Request $request)
    {
        $preduzece->paketi()->attach($request->paket);

        return redirect(route('preduzeca.index'));
    }

}
