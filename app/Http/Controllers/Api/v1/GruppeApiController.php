<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Baustein;
use App\Models\Gruppe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GruppeResource;
use App\Http\Resources\v1\GruppeResourceCollection;

class GruppeApiController extends Controller
{
    public function index(Request $request): GruppeResourceCollection{
        $user_id = $request->user()->id;

        if(isset($request->gruppe)){
            return new GruppeResourceCollection(Gruppe::where([
                ['user_id', $user_id]
            ])->get());
        }else{
            return new GruppeResourceCollection(Gruppe::where('user_id', $user_id)->paginate(10));
        }
        
    }

    public function show(Gruppe $gruppe): GruppeResource{
        $gruppe->bausteinGruppe = $gruppe->bausteins->sortBy('gruppe_pos')->toArray();
        
        return new GruppeResource($gruppe);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'bausteinGruppe' => ['array', 'min:1']
        ]);

        $anzahlBausteine = count($request->bausteinGruppe);
        $bausteine = $request->bausteinGruppe;

        $typen = array_column($bausteine, 'typ');
        if(in_array('deckblatt', $typen)){
            $validatedData['hasDeckblatt'] = true;
        }else{
            $validatedData['hasDeckblatt'] = false;
        }

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
        $request->validate([
            'name' => 'required',
            'bausteinGruppe' => ['array', 'min:1']
        ]);
        
        $bausteineAlt = Baustein::where('gruppe_id', $gruppe->id)->get();
        foreach($bausteineAlt as $baustein){
            $baustein->gruppe_id = null;
            $baustein->gruppe_pos = null;
            $baustein->save();
        }

        $anzahlBausteine = count($request->bausteinGruppe);
        $bausteineNeu = $request->bausteinGruppe;

        for($i = 0; $i < $anzahlBausteine; $i++){

            $baustein = Baustein::find($bausteineNeu[$i]['id']);

            $baustein->gruppe_id = $gruppe->id;
            $baustein->gruppe_pos = $i + 1;
            $baustein->save();
        }
        
        $gruppe->anzahlBausteine = $anzahlBausteine;
        $gruppe->name = $request->name;

        $typen = array_column($bausteineNeu, 'typ');
        if(in_array('deckblatt', $typen)){
            $gruppe->hasDeckblatt = true;
        }else{
            $gruppe->hasDeckblatt = false;
        }

        $gruppe->save();

        $gruppe->bausteinGruppe = $gruppe->bausteins;

        return new GruppeResource($gruppe);
    }

    public function destroy(Gruppe $gruppe){
        $bausteineAlt = Baustein::where('gruppe_id', $gruppe->id)->get();

        foreach($bausteineAlt as $baustein){
            $baustein->gruppe_id = null;
            $baustein->gruppe_pos = null;
            $baustein->save();
        }
        
        $gruppe->delete();

        return response()->json();
    }
}

?>