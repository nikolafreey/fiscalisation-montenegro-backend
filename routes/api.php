<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DokumentController;
use App\Http\Controllers\DozvolaController;
use App\Http\Controllers\KategorijaDokumentaController;
use App\Http\Controllers\OdaberiPreduzeceController;
use App\Http\Controllers\UlogeKorisnikaPreduzecaController;
use App\Http\Controllers\UploadController;
use App\Models\KategorijaDokumenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
use App\Http\Controllers\DepozitWithdrawController;
use App\Http\Controllers\ProizvodjacRobeController;
use App\Http\Controllers\PoslovnaJedinicaController;
use App\Http\Controllers\PodKategorijaRobeController;
use App\Http\Controllers\MobileAuthController;
use App\Models\DepozitWithdraw;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Laravel\Sanctum\Sanctum;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

//Autentifikacija za mobilnu app
Route::post("token", [MobileAuthController::class, 'token']);
Route::post('register', [MobileAuthController::class, 'register']);

Route::get('sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

// TODO: Uncomment this

// Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', function (Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::put('odabirPreduzeca/update', [OdaberiPreduzeceController::class, 'update']);
    Route::get('odabirPreduzeca', [OdaberiPreduzeceController::class, 'index'])->name('odabir.preduzeca');

    // Route::middleware('odabranoPreduzece')->group(function () {
        Route::post('odabirPreduzeca/destroy', [OdaberiPreduzeceController::class, 'destroy']);

        Route::get('dozvole', [DozvolaController::class, 'index'])->name('dozvole.index');

        Route::apiResource('fizicka-lica', FizickoLiceController::class)->parameters([
            'fizicka-lica' => 'fizickoLice'
        ]);

        Route::apiResource('usluge', UslugaController::class)->parameters([
            'usluge' => 'usluga'
        ]);

        Route::prefix('izvjestaji')->group(function () {
            Route::get('fiskalni-presjek-stanja', [IzvjestajController::class, 'fiskalniPresjekStanja']);

            Route::get('fiskalni-dnevni-izvjestaj', [IzvjestajController::class, 'fiskalniDnevniIzvjestaj']);

            Route::get('periodicni-fiskalni-izvjestaj', [IzvjestajController::class, 'periodicniFiskalniIzvjestaj']);

            Route::get('periodični-analiticki-pregled', [IzvjestajController::class, 'periodicniAnalitickiPregled']);

            Route::get('periodicni-analiticki-pregled-offline', [IzvjestajController::class, 'periodicniAnalitickiPregledOffline']);

            Route::get('periodicni-analiticki-pregled-korektivni', [IzvjestajController::class, 'periodicniAnalitickiPregledKorektivni']);
        });

        //Mobilna Aplikacija AUTH
        Route::get('profile', [MobileAuthController::class, 'profile']);
        Route::get('refresh', [MobileAuthController::class, 'refresh']);

        Route::get('robe-racuni', [RobaController::class, 'robaRacuni']);

        Route::get('racuni-status', [RacunController::class, 'racuniStatus']);

        Route::get('racuni-najveci-kupci', [RacunController::class, 'najveciKupci']);

        Route::get('racuni-najveci-duznici', [RacunController::class, 'najveciDuznici']);

        Route::get('racuni-pdv', [RacunController::class, 'racuniPdv']);

        Route::get('racuni-danas', [RacunController::class, 'izlazniRacuniDanas']);

        Route::get('ulazni-racuni-pdv', [UlazniRacunController::class, 'ulazniRacuniPdv']);

        Route::get('ulazni-racuni-danas', [UlazniRacunController::class, 'ulazniRacuniDanas']);

        // Route::get('/me', [UserController::class, 'me']);

        Route::apiResource('tipovi-atributa', TipoviAtributaController::class)->parameters([
            'tipovi-atributa' => 'tip-atributa'
        ]);

        Route::post('dijeljenjeRacuna/{racun}', [RacunController::class, 'dijeljenjeRacuna']);

        Route::apiResource('racuni', RacunController::class)->parameters([
            'racuni' => 'racun'
        ]);

        Route::apiResource('ulazni-racuni', UlazniRacunController::class)->parameters([
            'ulazni_racuni' => 'ulazni_racun'
        ]);

        Route::apiResource('predracuni', PredracunController::class)->parameters([
            'racuni' => 'racun'
        ]);

        Route::apiResource('jedinice_mjere', JedinicaMjereController::class)->parameters([
            'jedinice_mjere' => 'jedinica-mjere'
        ]);

        Route::apiResource('proizvodjaci-robe', ProizvodjacRobeController::class)->parameters([
            'proizvodjaci-robe' => 'proizvodjaci-robe'
        ]);

        Route::apiResource('atribut-roba', AtributRobeController::class)->parameters([
            'atribut-roba' => 'atribut-robe'
        ]);

        Route::apiResource('kategorije-robe', KategorijaRobeController::class)->parameters([
            'kategorije-robe' => 'kategorija-robe'
        ]);

        Route::apiResource('podkategorije-robe', PodKategorijaRobeController::class)->parameters([
            'podkategorije-robe' => 'podkategorija-robe'
        ]);

        Route::apiResource('kategorije-dokumenta', KategorijaDokumentaController::class)->parameters([
            'kategorije-dokumenta' => 'kategorija-dokumenta'
        ]);

        Route::apiResource('dokumenti', DokumentController::class)->parameters([
            'dokumenti' => 'dokument'
        ]);

        Route::apiResource('porezi', PorezController::class)->parameters([
            'porezi' => 'porez'
        ]);

        Route::apiResource('grupe', GrupaController::class)->parameters([
            'grupe' => 'grupa'
        ]);

        Route::apiResource('djelatnosti', DjelatnostController::class)->parameters([
            'djelatnosti' => 'djelatnost'
        ]);

        Route::apiResource('robe', RobaController::class)->parameters([
            'robe' => 'roba'
        ]);

        Route::apiResource('moduli', ModulController::class)->parameters([
            'moduli' => 'modul'
        ]);
        Route::apiResource('ovlascena-lica', OvlascenoLiceController::class)->parameters([
            'ovlascena-lica' => 'ovlasceno-lice'
        ]);
        Route::apiResource('tipovi-korisnika', TipKorisnikaController::class)->parameters([
            'tipovi-korisnika' => 'tip-korisnika'
        ]);
        Route::apiResource('kategorije', KategorijaController::class)->parameters([
            'kategorije' => 'kategorija'
        ]);

        Route::apiResource('poslovne-jedinice', PoslovnaJedinicaController::class)->parameters([
            'poslovne-jedinice' => 'poslovna-jedinica'
        ]);

        Route::apiResource('preduzeca', PreduzeceController::class)->parameters([
            'preduzeca' => 'preduzece'
        ]);

        Route::apiResource('depozit-withdraws', DepozitWithdrawController::class)->parameters([
            'depozit-withdraws' => 'depozit-withdraw'
        ]);

        Route::get('get-depozit-today', [DepozitWithdrawController::class, 'getDepozitToday']);

        Route::apiResource('ziro-racuni', ZiroRacunController::class)->parameters([
            'ziro-racuni' => 'ziro-racun'
        ]);
        Route::apiResource('partneri', PartnerController::class)->parameters([
            'partneri' => 'partner'
        ]);

        Route::get('atributi-grupe', [RacunController::class, 'getAtributiGrupe']);

        Route::apiResource('blogs', BlogController::class);

        Route::apiResource('blogCategories', BlogCategoryController::class);

        Route::get('uloga-korisnika-preduzeca/{preduzece}', [UlogeKorisnikaPreduzecaController::class, 'index']);
        Route::post('uloga-korisnika-preduzeca/{preduzece}', [UlogeKorisnikaPreduzecaController::class, 'store']);

        Route::put('uploadAvatar', [UploadController::class, 'uploadAvataraKorisnika']);
        Route::put('uploadUlazniRacun', [UploadController::class, 'uploadUlaznihRacuna']);

    // });
// });
