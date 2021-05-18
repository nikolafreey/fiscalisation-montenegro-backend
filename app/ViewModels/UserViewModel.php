<?php

namespace App\ViewModels;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class UserViewModel extends ViewModel
{
    public $action = '';

    public function __construct(User $user = null)
    {
        $this->user = $user;
        $this->action = last(explode('.', Route::currentRouteName()));
    }

    public function user()
    {
        return $this->user ?? new User();
    }

    public function roles()
    {
        return Role::orderBy('name')->get();
    }

    public function preduzeca()
    {
        return Preduzece::orderBy('kratki_naziv')->get();
    }

    public function method()
    {
        if ($this->action === 'edit') {
            return 'PUT';
        }

        return 'POST';
    }

    public function action()
    {
        if ($this->action === 'edit') {
            return true;
        }

        return false;
    }
}
