<?php

namespace App\Http\Controllers\Api\v1;

use App\Baustein;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\BausteinResource;
use App\Http\Resources\v1\BausteinResourceCollection;

class BausteinApiController extends Controller
{
    public function index(): BausteinResourceCollection{
        return new BausteinResourceCollection(Baustein::all());
    }
    
    public function show(Baustein $baustein): BausteinResource{
        return new BausteinResource($baustein);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'nummer' => ['required', 'unique:bausteins'],
            'marker' => 'required',
            'html' => 'required',
        ]);

        $baustein = Baustein::create($request->all());
        
        return new BausteinResource($baustein);
    }

    public function update(Baustein $baustein, Request $request): BausteinResource{

        $baustein->update($request->all());
        
        return new BausteinResource($baustein);
    }

    public function destroy(Baustein $baustein){
        
        $baustein->delete();

        return response()->json();
    }

}
