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
use App\Http\Controllers\UslugaController;
use App\Http\Controllers\GrupaController;
use App\Http\Controllers\JedinicaMjereController;
use App\Http\Controllers\PorezController;
use App\Http\Controllers\ProizvodjacRobeController;
use App\Http\Controllers\RobaController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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

Route::get('/me', [UserController::class, 'me']);



Route::apiResource('/jedinice_mjere', JedinicaMjereController::class)->parameters([
    'jedinice_mjere' => 'jedinica-mjere'
]);

Route::apiResource('/proizvodjaci-robe', ProizvodjacRobeController::class)->parameters([
    'proizvodjaci-robe' => 'proizvodjaci-robe'
]);

Route::apiResource('/porezi', PorezController::class)->parameters([
    'porezi' => 'porez'
]);

Route::apiResource('/grupe', GrupaController::class)->parameters([
    'grupe' => 'grupa'
]);

Route::apiResource('/djelatnosti', DjelatnostController::class)->parameters([
    'djelatnosti' => 'djelatnost'
]);

Route::apiResource('/robe', RobaController::class)->parameters([
    'robe' => 'roba'
]);

Route::apiResource('/moduli', ModulController::class)->parameters([
    'moduli' => 'modul'
]);
Route::apiResource('/ovlascena-lica', OvlascenoLiceController::class)->parameters([
    'ovlascena-lica' => 'ovlasceno-lice'
]);
Route::apiResource('/tipovi-korisnika', TipKorisnikaController::class)->parameters([
    'tipovi-korisnika' => 'tip-korisnika'
]);
Route::apiResource('/kategorije', KategorijaController::class)->parameters([
    'kategorije' => 'kategorija'
]);

Route::apiResource('/preduzeca', PreduzeceController::class)->parameters([
    'preduzeca' => 'preduzece'
]);
Route::apiResource('/ziro-racuni', ZiroRacunController::class)->parameters([
    'ziro-racuni' => 'ziro-racun'
]);
Route::apiResource('/partneri', PartnerController::class)->parameters([
    'partneri' => 'partner'
]);

Auth::routes();
Route::get('sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [UserController::class, 'me']);
    Route::apiResource('/fizicka-lica', FizickoLiceController::class)->parameters([
        'fizicka-lica' => 'fizickoLice'
    ]);
    Route::apiResource('/usluge', UslugaController::class)->parameters([
        'usluge' => 'usluga'
    ]);
});
