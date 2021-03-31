<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\AktivnostiController;
use App\Http\Controllers\Web\BlogCategoryController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\DozvoleController;
use App\Http\Controllers\Web\ImageController;
use App\Http\Controllers\Web\UlogeController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\AtributRobeController;
use App\Http\Controllers\Web\PreduzeceController;
use App\Jobs\Depozit;
use App\Jobs\Fiskalizuj;
use App\Models\DepozitWithdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('preduzeca', PreduzeceController::class)->parameters([
        'preduzeca' => 'preduzece'
    ])->only('index', 'edit', 'update');

    Route::resource('uloge', UlogeController::class)->only('index', 'create', 'store', 'edit')->parameters([
        'uloge' => 'role'
    ]);

    Route::resource('users', UserController::class);
    Route::get('uloge/{user}', [UserController::class, 'izmjeniteUlogu'])->name('izmjeniteUlogu');
    Route::put('uloge/{user}', [UserController::class, 'updateUlogu'])->name('updateUlogu');

    Route::resource('aktivnosti', AktivnostiController::class)->only('index', 'show')->parameters([
        'aktivnosti' => 'activity'
    ]);

    Route::resource('dozvole', DozvoleController::class)->only('index', 'create', 'store');

    Route::post('uloge/store/{role}', [UlogeController::class, 'dodajDozvolu'])->name('dodajDozvolu');

    Route::post('cropper/image-upload', [ImageController::class, 'store'])->name('cropper.images');

    Route::resource('blogs', BlogController::class)->except('show');

    Route::resource('blogCategories', BlogCategoryController::class)->except('show');
});
