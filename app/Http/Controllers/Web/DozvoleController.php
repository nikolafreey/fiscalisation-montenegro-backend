<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class DozvoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                    Permission::query()
                )
                ->make();
        };

        return view('admin.dozvole.index');
    }

    public function create()
    {
        auth()->user()->can('edit users');

        return view('admin.dozvole.create');
    }

    public function store(Request $request)
    {
        auth()->user()->can('edit users');

        Permission::create(['name' => $request->dozvola]);

        $request->session()->flash('success', 'Uspješno ste dodali dozvolu');

        return redirect(route('dozvole.index'));
    }
}
