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
        dd("hier");
        $textbaustein = Baustein::find($baustein->id);
        $textbaustein->delete();
        
        return redirect()->route('bausteins.index')->with('success', 'Der Baustein wurde gelöscht.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Baustein  $baustein
     * @return \Illuminate\Http\Response
     */
    public function edit(Baustein $baustein)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Baustein  $baustein
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Baustein $baustein)
    {
        //
    }

}
