<?php

namespace App\Http\Controllers;

use App\Models\Preduzece;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UlogaController extends Controller
{
    public function index()
    {
        return Role::all();
    }
}
