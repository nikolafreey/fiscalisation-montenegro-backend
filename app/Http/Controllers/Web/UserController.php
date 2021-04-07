<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserRequest;
use App\Mail\SendPassword;
use App\Models\Preduzece;
use App\Models\User;
use App\Notifications\AccountRegistered;
use App\ViewModels\UserViewModel;
use Coconuts\Mail\MailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        }

        return view('admin.users.index');
    }

    public function create()
    {
        $viewModel = new UserViewModel();

        return view('admin.users.form', $viewModel);
    }

    public function store(UserRequest $request)
    {
        auth()->user()->can('edit users');

        $user = User::create(array_merge($request->validated(), ['password' => Hash::make($request->password)]));

        $user->syncRoles([$request->uloga]);

        $user->preduzeca()->attach($request->preduzece_id);

        if ($request->uloga === 'Vlasnik') {
            foreach ($request->preduzeca as $id) {
                Preduzece::where('id', $id)->firstOrFail()->update(['verifikovan' => true]);
            }
        }

        $password = $request->password;

        if ($request->check === 'on') {
            $user->notify(new AccountRegistered($request, $password));
        }

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        // auth()->user()->can('edit users');

        $viewModel = new UserViewModel($user);

        return view('admin.users.form', $viewModel);
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->validated());

        $user->syncRoles([$request->uloga]);

        $user->preduzeca()->sync($request->preduzece_id);

        return redirect(route('users.index'));
    }

    public function izmjeniteUlogu(User $user)
    {
        return view('admin.users.uloga', [
            'roles' => Role::all(),
            'user' => $user
        ]);
    }

    public function updateUlogu(User $user, Request $request)
    {
        $user->syncRoles([$request->uloga]);

        return redirect(route('users.index'));
    }
}
