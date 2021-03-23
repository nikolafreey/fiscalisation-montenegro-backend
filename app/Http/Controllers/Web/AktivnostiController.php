<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class AktivnostiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                    Activity::latest()
                )
                ->addColumn('action', function ($activity) {
                    return view('admin.aktivnosti.action', compact('activity'));
                })
                ->make();
        };

        return view('admin.aktivnosti.index');
    }

    public function show(Activity $activity)
    {
        return view('admin.aktivnosti.show', [
            'aktivnost' => $activity
        ]);
    }
}
