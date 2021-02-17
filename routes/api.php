<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RobaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupaController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\PorezController;
use App\Http\Controllers\RacunController;
use App\Http\Controllers\UslugaController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\IzvjestajController;
use App\Http\Controllers\PredracunController;
use App\Http\Controllers\PreduzeceController;
use App\Http\Controllers\ZiroRacunController;
use App\Http\Controllers\CijenaRobeController;
use App\Http\Controllers\DjelatnostController;
use App\Http\Controllers\KategorijaController;
use App\Http\Controllers\AtributRobeController;
use App\Http\Controllers\FizickoLiceController;
use App\Http\Controllers\UlazniRacunController;
use App\Http\Controllers\TipKorisnikaController;
use App\Http\Controllers\JedinicaMjereController;
use App\Http\Controllers\OvlascenoLiceController;
use App\Http\Controllers\KategorijaRobeController;
use App\Http\Controllers\TipoviAtributaController;
use App\Http\Controllers\ProizvodjacRobeController;
use App\Http\Controllers\PodKategorijaRobeController;
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

Auth::routes();

Route::get('sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/fizicka-lica', FizickoLiceController::class)->parameters([
        'fizicka-lica' => 'fizickoLice'
    ]);
    Route::apiResource('/usluge', UslugaController::class)->parameters([
        'usluge' => 'usluga'
    ]);

    Route::get('izvjestaji/fiskalni-presjek-stanja', [IzvjestajController::class, 'fiskalniPresjekStanja']);

    Route::get('izvjestaji/fiskalni-dnevni-izvjestaj', [IzvjestajController::class, 'fiskalniDnevniIzvjestaj']);

    Route::get('izvjestaji/periodicni-fiskalni-izvjestaj', [IzvjestajController::class, 'periodicniFiskalniIzvjestaj']);



    Route::get('robe-racuni', [RobaController::class, 'robaRacuni']);

    Route::get('racuni-status', [RacunController::class, 'racuniStatus']);

    Route::get('racuni-najveci-kupci', [RacunController::class, 'najveciKupci']);

    Route::get('racuni-najveci-duznici', [RacunController::class, 'najveciDuznici']);

    Route::get('racuni-pdv', [RacunController::class, 'racuniPdv']);

    Route::get('ulazni-racuni-pdv', [UlazniRacunController::class, 'ulazniRacuniPdv']);

    Route::get('/me', [UserController::class, 'me']);

    Route::apiResource('/tipovi-atributa', TipoviAtributaController::class)->parameters([
        'tipovi-atributa' => 'tip-atributa'
    ]);

    Route::apiResource('/racuni', RacunController::class)->parameters([
        'racuni' => 'racun'
    ]);

    Route::apiResource('/ulazni-racuni', UlazniRacunController::class)->parameters([
        'ulazni_racuni' => 'ulazni_racun'
    ]);

    Route::apiResource('/predracuni', PredracunController::class)->parameters([
        'racuni' => 'racun'
    ]);

    Route::apiResource('/jedinice_mjere', JedinicaMjereController::class)->parameters([
        'jedinice_mjere' => 'jedinica-mjere'
    ]);

    Route::apiResource('/proizvodjaci-robe', ProizvodjacRobeController::class)->parameters([
        'proizvodjaci-robe' => 'proizvodjaci-robe'
    ]);

    Route::apiResource('/atribut-roba', AtributRobeController::class)->parameters([
        'atribut-roba' => 'atribut-robe'
    ]);

    Route::apiResource('/kategorije-robe', KategorijaRobeController::class)->parameters([
        'kategorije-robe' => 'kategorija-robe'
    ]);

    Route::apiResource('/podkategorije-robe', PodKategorijaRobeController::class)->parameters([
        'podkategorije-robe' => 'podkategorija-robe'
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

    Route::get('/atributi-grupe', [RacunController::class, 'getAtributiGrupe']);
// });
