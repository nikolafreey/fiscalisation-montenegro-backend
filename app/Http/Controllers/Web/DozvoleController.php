<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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

        return redirect(route('dozvole.index'));
    }
}
