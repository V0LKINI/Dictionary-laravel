<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WordsController;
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
    'confirm' => false,
]);
Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MainController::class, 'main'])->name('main');
    Route::post('/load', [MainController::class, 'load'])->name('words-load');

    Route::group(['prefix' => 'leaderboard'], function () {
        Route::get('/', [LeaderboardController::class, 'main'])->name('leaderboard');
        Route::put('/reset/daily', [LeaderboardController::class, 'resetDaily'])->name('resetDaily');
        Route::put('/reset/weekly', [LeaderboardController::class, 'resetWeekly'])->name('resetWeekly');
        Route::put('/reset/monthly', [LeaderboardController::class, 'resetMonthly'])->name('resetMonthly');
    });

    Route::group(['prefix' => 'words'], function () {
        Route::post('/add', [WordsController::class, 'add'])->name('words-add');
        Route::delete('/delete/{id}', [WordsController::class, 'delete'])->name('words-delete');
        Route::put('/edit/{id}', [WordsController::class, 'edit'])->name('words-edit');
        Route::put('/reset/{id}', [WordsController::class, 'resetProgress'])->name('words-reset');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'main'])->name('profile.main');
        Route::put('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    });

    Route::group(['prefix' => 'exercises'], function () {
        Route::get('/', [ExerciseController::class, 'main'])->name('exercises');        Route::get('/english-russian', [ExerciseController::class, 'englishRussian'])->name('english-russian');
        Route::get('/russian-english', [ExerciseController::class, 'russianEnglish'])->name('russian-english');
        Route::get('/repetition', [ExerciseController::class, 'repetition'])->name('repetition');
        Route::post('/checkAnswer', [ExerciseController::class, 'checkAnswer'])->name('checkAnswer');
        Route::post('/checkAnswerRepetition', [ExerciseController::class, 'checkAnswerRepetition'])
            ->name('checkAnswerRepetition');
        Route::post('/getResults', [ExerciseController::class, 'getResults'])->name('getResults');
    });

    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('/admin', [MainController::class, 'admin'])->name('admin');
    });
});



