<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\LeaderboardController;
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
    'reset' => false,
    'confirm' => false
]);
Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MainController::class, 'main'])->name('main');
    Route::get('/exercises', [ExerciseController::class, 'main'])->name('exercises');
    Route::get('/leaderboard', [LeaderboardController::class, 'main'])->name('leaderboard');

    Route::resource('words', 'App\Http\Controllers\WordsController', [
        'only' => ['create', 'destroy', 'edit']
    ]);

    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('/admin-panel', [MainController::class, 'adminPanel'])->name('admin-panel');
    });
});



