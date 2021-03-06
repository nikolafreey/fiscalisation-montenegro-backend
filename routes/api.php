<?php

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use App\Models\DepozitWithdraw;
use App\Models\KategorijaDokumenta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RobaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupaController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\PorezController;
use App\Http\Controllers\RacunController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UslugaController;
use App\Http\Controllers\DozvolaController;
use App\Http\Controllers\InvitesController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DokumentController;
use App\Http\Controllers\IzvjestajController;
use App\Http\Controllers\PredracunController;
use App\Http\Controllers\PreduzeceController;
use App\Http\Controllers\ZiroRacunController;
use App\Http\Controllers\CijenaRobeController;
use App\Http\Controllers\DjelatnostController;
use App\Http\Controllers\KategorijaController;
use App\Http\Controllers\MobileAuthController;
use App\Http\Controllers\AtributRobeController;
use App\Http\Controllers\FizickoLiceController;
use App\Http\Controllers\PodesavanjeController;
use App\Http\Controllers\UlazniRacunController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\TipKorisnikaController;
use App\Http\Controllers\JedinicaMjereController;
use App\Http\Controllers\OvlascenoLiceController;
use App\Http\Controllers\KategorijaRobeController;
use App\Http\Controllers\TipoviAtributaController;
use App\Http\Controllers\DepozitWithdrawController;
use App\Http\Controllers\ProizvodjacRobeController;
use App\Http\Controllers\OdaberiPreduzeceController;
use App\Http\Controllers\PoslovnaJedinicaController;
use App\Http\Controllers\PodKategorijaRobeController;
use App\Http\Controllers\RacuniInformacijeController;
use App\Http\Controllers\KategorijaDokumentaController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\OdaberiPoslovnuJedinicuController;
use App\Http\Controllers\UlogeKorisnikaPreduzecaController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('invite/{invite}', [InvitesController::class, 'registerFromInvite'])->name('registerFromInvite');

Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

//Autentifikacija za mobilnu app
Route::post("token", [MobileAuthController::class, 'token']);
Route::post('register', [MobileAuthController::class, 'register']);

Route::get('sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('mobilna-posljednja-verzija', function (Request $request) {
        return response()->json([
            "android" => env("ANDROID_VERZIJA"),
            "android_build" => env("ANDROID_BUILD"),
            "android_apk" => url(env("ANDROID_APK")),
            "ios" => env("IOS_VERZIJA")
        ]);
    });

    Route::get('/me', function (Request $request) {
        return auth()->user();
    });


    Route::post('logout', [AuthController::class, 'logout']);

    Route::put('odabir-preduzeca/update', [OdaberiPreduzeceController::class, 'update']);
    Route::get('odabir-preduzeca', [OdaberiPreduzeceController::class, 'index'])->name('odabir.preduzeca');

    Route::middleware('odabranoPreduzece')->group(function () {

        Route::get('/auth-preduzece', function (Request $request) {
            return getAuthPreduzece($request);
        });

        Route::post('odabir-preduzeca/destroy', [OdaberiPreduzeceController::class, 'destroy']);

        Route::put('odabir-poslovne-jedinice/update', [OdaberiPoslovnuJedinicuController::class, 'update']);
        Route::get('odabir-poslovne-jedinice', [OdaberiPoslovnuJedinicuController::class, 'index'])->name('odabir.poslovneJedinice');

        Route::middleware('odabranaPoslovnaJedinica')->group(function () {

            Route::get('/auth-poslovna-jedinica', function (Request $request) {
                return getAuthPoslovnaJedinica($request);
            });

            Route::post('odabir-poslovne-jedinice/destroy', [OdaberiPoslovnuJedinicuController::class, 'destroy']);

            Route::get('dozvole', [DozvolaController::class, 'index'])->name('dozvole.index');

            Route::apiResource('fizicka-lica', FizickoLiceController::class)->parameters([
                'fizicka-lica' => 'fizickoLice'
            ]);

            Route::apiResource('users', UserController::class)->parameters([
                'users' => 'user'
            ]);

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

                Route::get('periodi??ni-analiticki-pregled', [IzvjestajController::class, 'periodicniAnalitickiPregled']);

                Route::get('periodicni-analiticki-pregled-offline', [IzvjestajController::class, 'periodicniAnalitickiPregledOffline']);

                Route::get('periodicni-analiticki-pregled-korektivni', [IzvjestajController::class, 'periodicniAnalitickiPregledKorektivni']);
            });

            //Mobilna Aplikacija AUTH
            Route::get('profile', [MobileAuthController::class, 'profile']);
            Route::get('refresh', [MobileAuthController::class, 'refresh']);

            Route::post('update-status/{racun}', [RacunController::class, 'updateStatus']);

            Route::get('robe-racuni', [RobaController::class, 'robaRacuni']);

            Route::get('racuni-status', [RacunController::class, 'racuniStatus']);

            Route::get('racuni-najveci-kupci', [RacunController::class, 'najveciKupci']);

            Route::get('racuni-najveci-duznici', [RacunController::class, 'najveciDuznici']);

            Route::get('racuni-pdv', [RacunController::class, 'racuniPdv']);

            Route::get('racuni-danas', [RacunController::class, 'izlazniRacuniDanas']);

            Route::get('ulazni-racuni-pdv', [UlazniRacunController::class, 'ulazniRacuniPdv']);

            Route::get('ulazni-racuni-danas', [UlazniRacunController::class, 'ulazniRacuniDanas']);

            Route::get('/me', [UserController::class, 'me']);

            Route::apiResource('tipovi-atributa', TipoviAtributaController::class)->parameters([
                'tipovi-atributa' => 'tip-atributa'
            ]);

            Route::post('dijeljenje-racuna/{racun}', [RacunController::class, 'dijeljenjeRacuna']);

            Route::apiResource('racuni', RacunController::class)->parameters([
                'racuni' => 'racun'
            ]);

            Route::get('nefiskalizovani-racuni', [RacunController::class, 'nefiskalizovaniRacuni']);
            Route::post('nefiskalizovani-racuni/{racun}', [RacunController::class, 'fiskalizujRacun']);
            Route::post('storniraj-racun/{racun}', [RacunController::class, 'stornirajRacun']);
            Route::post('kloniraj-racun/{racun}', [RacunController::class, 'klonirajRacun']);

            Route::apiResource('racuni-informacije', RacuniInformacijeController::class)->only('index');

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

            Route::apiResource('cijena-roba', CijenaRobeController::class)->parameters([
                'cijena-roba' => 'cijena-robe'
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

            Route::get('nefiskalizovani-depoziti', [DepozitWithdrawController::class, 'nefiskalizovaniDepoziti']);

            Route::post('nefiskalizovani-depoziti/{depozit}', [DepozitWithdrawController::class, 'fiskalizujDepozit']);

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

            Route::put('upload-avatar', [UploadController::class, 'uploadAvataraKorisnika']);
            Route::put('upload-ulazniRacun', [UploadController::class, 'uploadUlaznihRacuna']);
            Route::post('upload-ugovora', [UploadController::class, 'uploadUgovora']);

            Route::apiResource('podesavanja', PodesavanjeController::class)->parameters([
                'podesavanja' => 'podesavanje'
            ]);

            Route::get('podesavanja/show', [PodesavanjeController::class, 'show'])->name('podesavanja.show');

            Route::post('podesavanja/dodajKorisnika', [PodesavanjeController::class, 'dodajKorisnika'])
                ->name('dodajKorisnika');
        });
    });
});
