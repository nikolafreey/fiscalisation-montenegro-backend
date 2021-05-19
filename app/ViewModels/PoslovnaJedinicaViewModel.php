<?php

namespace App\ViewModels;

use App\Models\PoslovnaJedinica;
use App\Models\Preduzece;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\ViewModels\ViewModel;

class PoslovnaJedinicaViewModel extends ViewModel
{
    public $action = '';

    public function __construct(PoslovnaJedinica $poslovnaJedinica = null)
    {
        $this->poslovnaJedinica = $poslovnaJedinica;
        $this->action = last(explode('.', Route::currentRouteName()));
    }

    public function poslovnaJedinica()
    {
        return $this->poslovnaJedinica ?? new PoslovnaJedinica();
    }

    public function preduzeca()
    {
        return Preduzece::orderBy('kratki_naziv')->get();
    }

    public function users()
    {
        return User::orderBy('ime')->get();
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
