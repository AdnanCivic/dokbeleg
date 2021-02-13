<?php

namespace App\Http\Controllers\Api\v1;

use App\Baustein;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\v1\BausteinResource;
use App\Http\Resources\v1\BausteinResourceCollection;

class BausteinApiController extends Controller
{
    public function index(Request $request): BausteinResourceCollection{
        $user_id = $request->user()->id;
        if(isset($request->gruppe)){
            return new BausteinResourceCollection(Baustein::where([
                ['user_id', $user_id],
                ['gruppe_id', null]
            ])->get());
        }else{
            return new BausteinResourceCollection(Baustein::where('user_id', $user_id)->paginate(5));
        }  
    }
    
    public function show(Baustein $baustein): BausteinResource{
        return new BausteinResource($baustein);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'typ' => 'required',
            'heading' => 'required',
            'content' => 'nullable',
        ]);
        
        $suche = "/«(.*?)»/";
        $html = $request->content;
        $anzahlMarker = preg_match_all($suche, $html, $matches, PREG_SET_ORDER);

        $validatedData['marker'] = $anzahlMarker;
        $validatedData['user_id'] = $request->user()->id;
        $baustein = Baustein::create($validatedData);
        
        return new BausteinResource($baustein);
    }

    public function update(Baustein $baustein, Request $request): BausteinResource{
        $validatedData = $request->validate([
            'name' => 'required',
            'typ' => 'required',
            'heading' => 'required',
            'content' => 'nullable'
        ]);

        $suche = "/«(.*?)»/";
        $html = $request->content;
        $anzahlMarker = preg_match_all($suche, $html, $matches, PREG_SET_ORDER);

        $validatedData['marker'] = $anzahlMarker;
        $baustein->update($validatedData);
        
        return new BausteinResource($baustein);
    }

    public function destroy(Baustein $baustein){
        
        $baustein->delete();

        return response()->json();
    }

}

?>