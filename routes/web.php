<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\GrammarController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DictionaryController;
use Illuminate\Support\Facades\Auth;


Route::get('locale/{locale}', [MainController::class, 'changeLocale'])->name('locale');

Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin', [MainController::class, 'admin'])->name('admin');
    Route::resource('/admin/news', NewsController::class)->except('show');
    Route::resource('/admin/grammar', GrammarController::class)->except('index');
    Route::put('/admin/{id}/block', [MainController::class, 'blockUser'])->name('user-block');
    Route::put('/admin/{id}/unblock', [MainController::class, 'unblockUser'])->name('user-unblock');

    Route::group(['prefix' => 'leaderboard'], function () {
        Route::put('/reset/daily', [LeaderboardController::class, 'resetDaily'])->name('resetDaily');
        Route::put('/reset/weekly', [LeaderboardController::class, 'resetWeekly'])->name('resetWeekly');
        Route::put('/reset/monthly', [LeaderboardController::class, 'resetMonthly'])->name('resetMonthly');
    });

});


Auth::routes([
    'reset' => false,
    'confirm' => false,
]);

Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('/logout', [LoginController::class, 'logout'])->name('get-logout');
Route::get('leaderboard/', [LeaderboardController::class, 'main'])->name('leaderboard');
Route::get('news/{news}', [NewsController::class, 'show'])->name('news-detail');
Route::get('/grammar', [GrammarController::class, 'index'])->name('grammar.index');

Route::group(['middleware' => ['auth', 'is_not_banned']], function () {

    Route::post('/changetheme', [MainController::class, 'changeTheme'])->name('changeTheme');

    Route::group(['prefix' => 'dictionary'], function () {
        Route::get('/', [DictionaryController::class, 'main'])->name('dictionary');
        Route::post('/load', [DictionaryController::class, 'loadWords'])->name('loadWords');
        Route::post('/add', [DictionaryController::class, 'addWord'])->name('addWord');
        Route::delete('/delete/{id}', [DictionaryController::class, 'deleteWord'])->name('deleteWord');
        Route::put('/edit/{id}', [DictionaryController::class, 'editWord'])->name('editWord');
        Route::put('/reset/{id}', [DictionaryController::class, 'resetWordProgress'])->name('resetWordProgress');
    });


    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/id{id}', [ProfileController::class, 'main'])->name('main');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/save', [ProfileController::class, 'save'])->name('save');
        Route::get('/search', [ProfileController::class, 'getSearch'])->name('search');
    });

    Route::group(['prefix' => 'friends', 'as' => 'friends.'], function () {
        Route::get('add/id{id}', [FriendsController::class, 'getAdd'])->name('add');
        Route::get('accept/id{id}', [FriendsController::class, 'getAccept'])->name('accept');
        Route::get('reject/id{id}', [FriendsController::class, 'getReject'])->name('reject');
        Route::get('cancel/id{id}', [FriendsController::class, 'getCancel'])->name('cancel');
        Route::delete('delete/id{id}', [FriendsController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'exercises'], function () {
        Route::get('/', [ExerciseController::class, 'main'])->name('exercises');
        Route::get('/english-russian', [ExerciseController::class, 'englishRussian'])->name('english-russian');
        Route::get('/russian-english', [ExerciseController::class, 'russianEnglish'])->name('russian-english');
        Route::get('/repetition', [ExerciseController::class, 'repetition'])->name('repetition');
        Route::get('/puzzle', [ExerciseController::class, 'puzzle'])->name('puzzle');
        Route::post('/get-results-exercise', [ExerciseController::class, 'getResultsExercise'])
            ->name('getResultsExercise');
        Route::post('/get-results-repetition', [ExerciseController::class, 'getResultsRepetition'])
            ->name('getResultsRepetition');
        Route::post('/get-results-puzzle', [ExerciseController::class, 'getResultsPuzzle'])
            ->name('getResultsPuzzle');
    });

});

