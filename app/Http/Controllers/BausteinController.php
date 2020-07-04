<?php

namespace App\Http\Controllers;

use App\Baustein;
use Illuminate\Http\Request;

class BausteinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alleBausteine = Baustein::all();
        return view('bausteine.index', compact('alleBausteine'));
    }

    public function show(Baustein $baustein)
    {
        $dbBaustein = Baustein::find($baustein->id);
        return view('bausteine.show', compact('dbBaustein'));
    }

    public function create()
    {
        return view('bausteine.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required'],
            'textbaustein' => ['required']
        ]);

        $text = request('textbaustein');
        $suche = "/«(.*?)»/";
        
        $anzahlMarker = preg_match_all($suche, $text, $matches, PREG_SET_ORDER);

        $baustein = Baustein::create([
            'name' => request('name'),
            'html' => request('textbaustein'),
            'marker' => $anzahlMarker
        ]);

        return redirect()->route('bausteins.index')->with('success', 'Ein neuer Baustein wurde erstellt.');
    }
    
    public function destroy(Baustein $baustein)
    {
        $textbaustein = Baustein::find($baustein->id);
        $textbaustein->delete();
        
        return redirect()->route('bausteins.index')->with('success', 'Der Baustein wurde gelöscht.');
    }

    public function update(Request $request, Baustein $baustein)
    {
        $textbaustein = Baustein::find($baustein->id);
        
        if($textbaustein->name == $request->name && $request->newHTML == null){
            return back()->with('success', 'Es gibt keine Änderungen.');
        }

        if($request->newHTML != null){
            $neuerText = $request->newHTML;
            $textbaustein->html = $neuerText;  
        }
        
        if($textbaustein->name != $request->name){
            $textbaustein->name = $request->name;
        }

        $suche = "/«(.*?)»/";
        $html =  $textbaustein->html;
        $anzahlMarker = preg_match_all($suche, $html, $matches, PREG_SET_ORDER);
    
        $textbaustein->marker = $anzahlMarker;
        $textbaustein->save();

        return back()->with('success', 'Die Änderungen wurden gespeichert.');
    }

    // public function edit(Baustein $baustein)
    // {
        
    // }

}
