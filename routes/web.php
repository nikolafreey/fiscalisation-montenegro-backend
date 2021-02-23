<?php

use App\Jobs\Fiskalizuj;
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

Route::get('/', function () {
    Fiskalizuj::dispatch();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
