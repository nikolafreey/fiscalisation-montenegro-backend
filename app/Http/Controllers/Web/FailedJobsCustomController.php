<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FailedJobsCustom;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FailedJobsCustomController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                FailedJobsCustom::query()
            )
                ->make();
        };

        return view('admin.fejlovaniPoslovi.index');
    }
}
