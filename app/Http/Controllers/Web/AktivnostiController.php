<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Preduzece;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class AktivnostiController extends Controller
{
    public function index(Request $request)
    {
        $aktivnosti = Activity::latest()->get();

        if ($request->ajax()) {
            return DataTables::of($aktivnosti)
                ->make();
        };

        return view('admin.aktivnosti.index');
    }
}
