<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UlogeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                    Role::query()->with('permissions')
                )
                ->addColumn('action', function ($role) {
                    return view('admin.uloge.action', compact('role'));
                })
                ->make();
        };

        return view('admin.uloge.index');
    }

    public function create()
    {
        return view('admin.uloge.create');
    }

    public function store(Request $request)
    {
        Role::create(['name' => $request->uloga]);

        $request->session()->flash('success', 'Uspješno ste dodali ulogu');

        return redirect(route('uloge.index'));
    }

    public function edit(Role $role)
    {
        return view('admin.uloge.edit', [
            'role' => $role,
            'dozvole' => Permission::all()
        ]);
    }

    public function dodajDozvolu(Role $role, Request $request)
    {
        $role->syncPermissions([$request->dozvola]);

        $request->session()->flash('success', 'Uspješno ste dodijelili dozvolu');

        return redirect(route('uloge.index'));
    }
}
