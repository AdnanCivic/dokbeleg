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
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $anzahlBausteine = count($request->bausteinGruppe);
        $bausteine = $request->bausteinGruppe;

        $validatedData['anzahlBausteine'] = $anzahlBausteine;
        $validatedData['user_id'] = $request->user()->id;

        $gruppeNeu = Gruppe::create($validatedData);

        for($i = 0; $i < $anzahlBausteine; $i++){

            $baustein = Baustein::find($bausteine[$i]['id']);

            $baustein->gruppe_id = $gruppeNeu->id;
            $baustein->gruppe_pos = $i + 1;
            $baustein->save();
        }
        
        return new GruppeResource($gruppeNeu);
    }

    public function update(Gruppe $gruppe, Request $request): GruppeResource{
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        
        //update re
        $gruppe->update($validatedData);
        
        return new GruppeResource($gruppe);
    }

    public function destroy(Gruppe $gruppe){
        
        $gruppe->delete();

        return response()->json();
    }
}

?>