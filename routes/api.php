<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/baustein', 'Api\v1\BausteinApiController');
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/gruppe', 'Api\v1\GruppeApiController');
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/dokument', 'Api\v1\DokumentApiController');
    Route::get('/dokument/{dokument}/pdf', 'Api\v1\DokumentApiController@pdf');
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/user', 'Api\v1\UserApiController')->only('show');
});

// Route::prefix('v2')->group(function() {
//     Route::apiResource('/baustein', 'Api\v2\BausteinApiController')->only('show');
// });
