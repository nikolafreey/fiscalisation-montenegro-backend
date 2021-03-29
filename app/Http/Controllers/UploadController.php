<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Upload\UploadAvataraKorisnikaRequest;
use App\Http\Requests\Api\Upload\UploadUgovoraRequest;
use App\Http\Requests\Api\Upload\UploadUlaznihRacunaRequest;
use App\Models\Ugovor;
use App\Models\UlazniRacun;
use App\Models\User;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadAvataraKorisnika(User $user, UploadAvataraKorisnikaRequest $request)
    {
        $user->update($request->validated());

        return response()->json($user->avatar);
    }

    public function uploadUlaznihRacuna(UploadUlaznihRacunaRequest $request, UlazniRacun $ulazniRacun)
    {
        $ulazniRacun->update($request->validated());

        return response()->json($ulazniRacun->file);
    }

    public function uploadUgovora(UploadUgovoraRequest $request)
    {
        $ugovor = Ugovor::create($request->validated());

        return response()->json($ugovor);
    }
}
