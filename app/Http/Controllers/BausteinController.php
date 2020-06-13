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
        // dd($request);
        request()->validate([
            'name' => ['required'],
            'textbaustein' => ['required']
        ]);

        $baustein = Baustein::create([
            'name' => request('name'),
            'html' => request('textbaustein')
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
        $textbaustein->html = $baustein->html;
        dd($baustein);
        $textbaustein->save();

        return back()->with('success', 'Die Änderungen wurden gespeichert.');
    }

    public function edit(Baustein $baustein)
    {
        //
    }

}
