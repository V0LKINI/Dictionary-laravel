<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes([
    'reset'=>false,
    'confirm'=>false
]);
Route::get('/logout', [ LoginController::class, 'logout' ])->name('get-logout');

Route::get('/', [ MainController::class, 'main' ])->name('main');
Route::get('/exercises', [ MainController::class, 'exercises' ])->name('exercises');

