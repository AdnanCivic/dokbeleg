<?php

namespace App\Http\Controllers;

use App\Baustein;
use App\Dokumentation;
use Illuminate\Http\Request;

class DokumentationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alleDokumentationen = Dokumentation::all();
        
        return view('dokumentationen.index', compact('alleDokumentationen'));
    }

    public function show(Dokumentation $dokumentation)
    {
        $dbdokumentation = Dokumentation::find($dokumentation->id);

        return view('dokumentationen.show', compact('dbdokumentation'));
    }

    public function create()
    {
        $bausteine = Baustein::all();
        return view('dokumentationen.create', compact('bausteine'));
    }

    public function getBausteine(Request $request){
        if($request->has('bausteine')){
            if($request->bausteine){
                $response = Baustein::find($request->bausteine);
            } 
        }

        $suche = "/«(.*?)»/";

        foreach($response as $baustein){
            
            preg_match_all($suche, $baustein->html, $matches, PREG_PATTERN_ORDER);

            $markerInhalt = [];
            $anzahl = $baustein->marker;

            for($i = 0; $i < $anzahl; $i++){
                array_push($markerInhalt, $matches[1][$i]);
            }

            $baustein->markerInhaltArray = $markerInhalt;
        }

        return $response;
    }

    public function store(Request $request)
    {
        if($request->has('bausteine')){
            $response = Baustein::find($request->bausteine);
        }

        $temp = $request->all();

        $response = $temp;

        //return $response;
        //$dokumentation = App\Dokumentation::create();
        //baustein zu einer dokumentation hinzufügen, auch baustein array möglich attach([1,6,7])
        //entfernen $dokumentation->bausteins()->detach('baustein_id'); //entfernen
    }

    public function edit(Dokumentation $dokumentation)
    {
        $dokumentation = App\Dokumentation::find($request->dokumentation_id);
        $dokumentation->bausteins()->attach('baustein_id'); 
    }
}