<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatisticController;

Route::group(['prefix' => 'stats'], function () {
    Route::put('update-answers', [StatisticController::class, 'updateAnswers']);
    Route::put('update-finished-status', [StatisticController::class, 'updateFinishedStatus']);
});
