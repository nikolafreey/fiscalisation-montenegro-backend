<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\EditUserRequest;
use App\Http\Requests\Web\UserRequest;
use App\Mail\SendPassword;
use App\Models\Preduzece;
use App\Models\User;
use App\Notifications\NalogRegistrovan;
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
        $user = User::create(array_merge($request->validated(), ['password' => Hash::make($request->password)]));

        $user->syncRoles([$request->uloga]);

        $user->preduzeca()->attach($request->preduzece_id);

        if ($request->uloga === 'Vlasnik') {
            foreach ($request->preduzece_id as $id) {
                Preduzece::find($id)->firstOrFail()->update(['verifikovan' => true]);
            }
        }

        $password = $request->password;

        if ($request->check === 'on') {
            $user->notify(new NalogRegistrovan($request, $password));
        }

        $request->session()->flash('success', 'Uspješno ste dodali korisnika');

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        $viewModel = new UserViewModel($user);

        return view('admin.users.form', $viewModel);
    }

    public function update(User $user, EditUserRequest $request)
    {
        $user->update($request->validated());

        if ($request->password != null) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->syncRoles([$request->uloga]);

        $user->preduzeca()->sync($request->preduzece_id);

        $request->session()->flash('success', 'Uspješno ste izmijenili korisnika');

        return redirect(route('users.index'));
    }

    public function izmjeniteUlogu(User $user)
    {
        return view('admin.users.uloga', [
            'roles' => Role::orderBy('name')->get(),
            'user' => $user
        ]);
    }

    public function updateUlogu(User $user, Request $request)
    {
        $user->syncRoles([$request->uloga]);

        $request->session()->flash('success', 'Uspješno ste dodijelili ulogu');

        return redirect(route('users.index'));
    }
}
