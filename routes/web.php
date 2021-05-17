<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\AktivnostiController;
use App\Http\Controllers\Web\BlogCategoryController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\DozvoleController;
use App\Http\Controllers\Web\FailedJobsCustomController;
use App\Http\Controllers\Web\ImageController;
use App\Http\Controllers\Web\UlogeController;
use App\Http\Controllers\Web\UlogovaniKorisnikController;
use App\Http\Controllers\Web\UserController;
use Coconuts\Mail\MailMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\PreduzeceController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Jenssegers\Agent\Agent;

Route::group(['prefix' => 'okmnoifaonfa'], function(){
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
});

Route::middleware('auth')->prefix('okmnoifaonfa')->group(function () {

    Route::group(['middleware' => ['role:SuperAdmin']], function () {

        Route::resource('preduzeca', PreduzeceController::class)->parameters([
            'preduzeca' => 'preduzece'
        ])->only('index', 'edit', 'update');

        Route::resource('uloge', UlogeController::class)->only('index', 'create', 'store', 'edit')->parameters([
            'uloge' => 'role'
        ]);

        Route::resource('users', UserController::class);
        Route::get('uloge/{user}', [UserController::class, 'izmjeniteUlogu'])->name('izmjeniteUlogu');
        Route::put('uloge/{user}', [UserController::class, 'updateUlogu'])->name('updateUlogu');

        Route::get('paket/{preduzece}', [PreduzeceController::class, 'izmjenitePaket'])->name('izmjenitePaket');
        Route::put('paket/{preduzece}', [PreduzeceController::class, 'updatePaket'])->name('updatePaket');

        Route::resource('aktivnosti', AktivnostiController::class)->only('index', 'show')->parameters([
            'aktivnosti' => 'activity'
        ]);

        Route::resource('dozvole', DozvoleController::class)->only('index', 'create', 'store');

        Route::post('uloge/store/{role}', [UlogeController::class, 'dodajDozvolu'])->name('dodajDozvolu');

        Route::post('cropper/image-upload', [ImageController::class, 'store'])->name('cropper.images');

        Route::resource('blogs', BlogController::class)->except('show');

        Route::resource('blogCategories', BlogCategoryController::class)->except('show');

        Route::resource('ulogovaniKorisnici', UlogovaniKorisnikController::class)->only('index', 'destroy')->parameters([
            'ulogovaniKorisnici' => 'ulogovaniKorisnik'
        ]);

        Route::get('failedJobs', [FailedJobsCustomController::class, 'index'])->name('failedJobs.index');

    });
});
