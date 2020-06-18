<?php

namespace App\Http\Controllers;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dokumentation = App\Dokumentation::find($request->dokumentation_id);
        $dokumentation->bausteins()->attach('baustein_id'); //baustein zu einer dokumentation hinzufügen, auch baustein array möglich attach([1,6,7])
        //entfernen $dokumentation->bausteins()->detach('baustein_id'); //entfernen
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dokumentation  $dokumentation
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumentation $dokumentation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dokumentation  $dokumentation
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumentation $dokumentation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dokumentation  $dokumentation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumentation $dokumentation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dokumentation  $dokumentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumentation $dokumentation)
    {
        //
    }
}
