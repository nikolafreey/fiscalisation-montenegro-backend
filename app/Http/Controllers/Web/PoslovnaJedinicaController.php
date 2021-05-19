<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\PoslovnaJedinicaRequest;
use App\Http\Requests\Web\PreduzeceRequest;
use App\Http\Requests\Web\UpdatePreduzece;
use App\Models\Djelatnost;
use App\Models\Kategorija;
use App\Models\Paket;
use App\Models\PoslovnaJedinica;
use App\Models\Preduzece;
use App\ViewModels\PoslovnaJedinicaViewModel;
use App\ViewModels\UserViewModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PoslovnaJedinicaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                PoslovnaJedinica::query()
            )
                ->addColumn('action', function ($poslovnaJedinica) {
                    return view('admin.poslovneJedinice.action', compact('poslovnaJedinica'));
                })
                ->make();
        }

        return view('admin.poslovneJedinice.index');
    }

    public function create()
    {
        $viewModel = new PoslovnaJedinicaViewModel();

        return view('admin.poslovneJedinice.form', $viewModel);
    }

    public function store(PoslovnaJedinicaRequest $request)
    {
        PoslovnaJedinica::create($request->validated());

        $request->session()->flash('success', 'Uspješno ste dodali poslovnu jedinicu');

        return redirect(route('poslovneJedinice.index'));
    }

    public function edit(PoslovnaJedinica $poslovnaJedinica)
    {
        $viewModel = new PoslovnaJedinicaViewModel($poslovnaJedinica);

        return view('admin.poslovneJedinice.form', $viewModel);
    }

    public function update(PoslovnaJedinica $poslovnaJedinica, PoslovnaJedinicaRequest $request)
    {
        $poslovnaJedinica->update(array_filter($request->validated()));

        $request->session()->flash('success', 'Uspješno ste izmijenili poslovnu jedinicu');

        return redirect(route('poslovneJedinice.index'));
    }
}
