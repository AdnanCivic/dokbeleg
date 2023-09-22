<?php

namespace App\Http\Controllers\Api\v2;

use App\Baustein;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v2\BausteinResource;

class BausteinApiController extends Controller
{
    public function show(Baustein $baustein): BausteinResource{
        return new BausteinResource($baustein);
    }
}
