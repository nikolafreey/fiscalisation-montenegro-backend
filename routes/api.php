<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DjelatnostController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\OvlascenoLiceController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PreduzeceController;
use App\Http\Controllers\ZiroRacunController;
use App\Http\Controllers\KategorijaController;
use App\Http\Controllers\TipKorisnikaController;
use App\Http\Controllers\FizickoLiceController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('/djelatnosti', DjelatnostController::class);
    Route::apiResource('/moduli', ModulController::class);
    Route::apiResource('/ovlascena-lica', OvlascenoLiceController::class);
    Route::apiResource('/tipovi-korisnika', TipKorisnikaController::class);
    Route::apiResource('/kategorije', KategorijaController::class);
    Route::apiResource('/fizicka-lica', FizickoLiceController::class);
    Route::apiResource('/preduzeca', PreduzeceController::class);
    Route::apiResource('/ziro-racuni', ZiroRacunController::class);
    Route::apiResource('/partneri', PartnerController::class);


});


