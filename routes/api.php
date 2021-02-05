<?php

use App\Baustein;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('/baustein', 'Api\v1\BausteinApiController');
});

Route::prefix('v1')->group(function() {
    Route::apiResource('/dokument', 'Api\v1\DokumentApiController');
});

// Route::prefix('v2')->group(function() {
//     Route::apiResource('/baustein', 'Api\v2\BausteinApiController')->only('show');
// });
