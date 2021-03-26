<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Upload\UploadAvataraKorisnikaRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadAvataraKorisnika(User $user, UploadAvataraKorisnikaRequest $request)
    {
        $user->update($request->validated());

        return response()->json($user);
    }

    public function uploadUlaznihRacuna()
    {

    }

    public function uploadUgovora()
    {

    }

    public function uploadDokumenata()
    {

    }

}
