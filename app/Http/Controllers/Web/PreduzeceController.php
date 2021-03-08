<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePreduzece;
use App\Models\Preduzece;
use App\Models\Racun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class PreduzeceController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(Preduzece::query())
                ->addColumn('action', function ($preduzece) {
                    return view('admin.preduzeca.action', compact('preduzece'));
                })
                ->make();
        };

        return view('admin.preduzeca.index');
    }

    public function edit(Preduzece $preduzece)
    {
        auth()->user()->can('edit preduzeca');

        return view('admin.preduzeca.edit', [
            'preduzece' => $preduzece
        ]);
    }

    public function update(Preduzece $preduzece, UpdatePreduzece $request)
    {
        auth()->user()->can('edit preduzeca');

        $preduzece->update($request->validated());

        return redirect(route('preduzeca.index'));
    }
}
