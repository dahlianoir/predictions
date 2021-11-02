<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\PredictionsController;

Route::prefix('/v1')->middleware('content')->group(function () {
    Route::post('/predictions', [PredictionsController::class, 'create']);
    Route::get('/predictions', [PredictionsController::class, 'index']);
    Route::put('/predictions/{prediction}/status', [PredictionsController::class, 'updateStatus']);
});
