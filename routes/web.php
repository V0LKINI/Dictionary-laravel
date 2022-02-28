<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DictionaryController;
use Illuminate\Support\Facades\Auth;


Auth::routes([
    'reset' => false,
    'confirm' => false,
]);

Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [MainController::class, 'main'])->name('main');

    Route::group(['middleware' => 'is_admin'], function () {
        Route::get('/admin', [MainController::class, 'admin'])->name('admin');
    });

    Route::group(['prefix' => 'dictionary'], function () {
        Route::get('/', [DictionaryController::class, 'main'])->name('dictionary');
        Route::post('/load', [DictionaryController::class, 'loadWords'])->name('loadWords');
        Route::post('/add', [DictionaryController::class, 'addWord'])->name('addWord');
        Route::delete('/delete/{id}', [DictionaryController::class, 'deleteWord'])->name('deleteWord');
        Route::put('/edit/{id}', [DictionaryController::class, 'editWord'])->name('editWord');
        Route::put('/reset/{id}', [DictionaryController::class, 'resetWordProgress'])->name('resetWordProgress');
    });

    Route::group(['prefix' => 'leaderboard'], function () {
        Route::get('/', [LeaderboardController::class, 'main'])->name('leaderboard');
        Route::put('/reset/daily', [LeaderboardController::class, 'resetDaily'])->name('resetDaily');
        Route::put('/reset/weekly', [LeaderboardController::class, 'resetWeekly'])->name('resetWeekly');
        Route::put('/reset/monthly', [LeaderboardController::class, 'resetMonthly'])->name('resetMonthly');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/id{id}', [ProfileController::class, 'main'])->name('profile.main');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/save', [ProfileController::class, 'save'])->name('profile.save');
        Route::get('/search', [ProfileController::class, 'getSearch'])->name('profile.search');
    });

    Route::group(['prefix' => 'friends'], function () {
        Route::get('add/id{id}', [FriendsController::class, 'getAdd'])->name('friends.add');
        Route::get('accept/id{id}', [FriendsController::class, 'getAccept'])->name('friends.accept');
        Route::get('reject/id{id}', [FriendsController::class, 'getReject'])->name('friends.reject');
        Route::get('cancel/id{id}', [FriendsController::class, 'getCancel'])->name('friends.cancel');
        Route::delete('delete/id{id}', [FriendsController::class, 'delete'])->name('friends.delete');
    });

    Route::group(['prefix' => 'exercises'], function () {
        Route::get('/', [ExerciseController::class, 'main'])->name('exercises');
        Route::get('/english-russian', [ExerciseController::class, 'englishRussian'])->name('english-russian');
        Route::get('/russian-english', [ExerciseController::class, 'russianEnglish'])->name('russian-english');
        Route::get('/repetition', [ExerciseController::class, 'repetition'])->name('repetition');
        Route::post('/get-results-exercise', [ExerciseController::class, 'getResultsExercise'])
            ->name('getResultsExercise');
        Route::post('/get-results-repetition', [ExerciseController::class, 'getResultsRepetition'])
            ->name('getResultsRepetition');
    });

});



