<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;

class DozvolaController extends Controller
{
    public function index()
    {
        return Permission::all();
    }
}
