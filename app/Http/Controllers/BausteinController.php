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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Baustein  $baustein
     * @return \Illuminate\Http\Response
     */
    public function destroy(Baustein $baustein)
    {
        //
    }
}
