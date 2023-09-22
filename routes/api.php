<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserApiController;
use App\Http\Controllers\Api\v1\BausteinApiController;
use App\Http\Controllers\Api\v1\GruppeApiController;
use App\Http\Controllers\Api\v1\DokumentApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/baustein', BausteinApiController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/gruppe', GruppeApiController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/dokument', DokumentApiController::class);
    Route::get('/dokument/{dokument}/pdf', [DokumentApiController::class, 'pdf']);
    // Route::get('/dokument/{dokument}/pdf', 'Api\v1\DokumentApiController@pdf');
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/user', UserApiController::class);
});