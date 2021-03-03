<?php

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

// Route::middleware('auth')->group(function () {
//     Route::resource('preduzeca', PreduzeceController::class);
    Route::get('preduzeca', [PreduzeceController::class, 'index']);
    Route::get('preduzeca/{preduzece}/edit', [PreduzeceController::class, 'edit'])->name('preduzece.edit');
    Route::patch('preduzeca/{preduzece}/update', [PreduzeceController::class, 'update'])->name('preduzece.update');
// });


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
