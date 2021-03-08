<?php

use App\Http\Controllers\Web\AktivnostiController;
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
    ])->except('store', 'create', 'show', 'destroy');

    Route::resource('users', UserController::class)->except('store', 'create', 'show', 'destroy');
    Route::post('users/store/{user}', [UserController::class, 'store'])->name('users.store');

    Route::get('aktivnosti', [AktivnostiController::class, 'index'])->name('aktivnosti.index');
});
