<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ActiveUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UlogovaniKorisnikController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                ActiveUser::query()->where('name', 'Api token')->with('user', 'preduzece', 'poslovna_jedinica')
            )
                ->addColumn('action', function ($activeUser) {
                    return view('admin.ulogovaniKorisnici.action', compact('activeUser'));
                })
                ->make();
        }

        return view('admin.ulogovaniKorisnici.index');
    }

    public function destroy($activeUser)
    {
        ActiveUser::find($activeUser)->delete();

        return back();
    }
}
