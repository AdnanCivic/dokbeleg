<?php

namespace App\Http\Controllers\Api\v1;

use App\Baustein;
use App\Gruppe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GruppeResource;
use App\Http\Resources\v1\GruppeResourceCollection;

class GruppeApiController extends Controller
{
    public function index(Request $request): GruppeResourceCollection{
        $user_id = $request->user()->id;
        return new GruppeResourceCollection(Gruppe::where('user_id', $user_id)->paginate(5));
    }

    public function show(Gruppe $gruppe): GruppeResource{
        return new GruppeResource($gruppe);
    }

    public function store(Request $request){
        
    }
}

?>