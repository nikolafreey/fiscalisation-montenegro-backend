<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\AktivnostiController;
use App\Http\Controllers\Web\DozvoleController;
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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('preduzeca', PreduzeceController::class)->parameters([
        'preduzeca' => 'preduzece'
    ])->only('index', 'edit', 'update');


    Route::resource('users', UserController::class)->only('index', 'edit');
    Route::post('users/store/{user}', [UserController::class, 'store'])->name('users.store');

    Route::resource('aktivnosti', AktivnostiController::class)->only('index', 'show')->parameters([
        'aktivnosti' => 'activity'
    ]);

    Route::resource('dozvole', DozvoleController::class)->only('index', 'create', 'store');

    Route::resource('uloge', UlogeController::class)->only('index', 'create', 'store', 'edit')->parameters([
        'uloge' => 'role'
    ]);
    Route::post('uloge/store/{role}', [UlogeController::class, 'dodajDozvolu'])->name('dodajDozvolu');
});
