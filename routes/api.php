<?php

use App\Baustein;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::apiResource('/baustein', 'Api\v1\BausteinApiController');
});

// Route::prefix('v2')->group(function() {
//     Route::apiResource('/baustein', 'Api\v2\BausteinApiController')->only('show');
// });
