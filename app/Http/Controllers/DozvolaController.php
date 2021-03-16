<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DozvolaController extends Controller
{
    public function index()
    {
        return Role::all();
    }
}
