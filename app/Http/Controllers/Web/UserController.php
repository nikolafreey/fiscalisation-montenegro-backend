<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePreduzece;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        auth()->user()->can('edit users');

        if ($request->ajax()) {
            return DataTables::eloquent(
                    User::query()->with('roles')
                )
                ->addColumn('action', function ($user) {
                    return view('admin.users.action', compact('user'));
                })
                ->make();
        };

        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        auth()->user()->can('edit users');

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function store(User $user, Request $request)
    {
        auth()->user()->can('edit users');

        $user->syncRoles([$request->role]);

        return redirect(route('users.index'));
    }
}
