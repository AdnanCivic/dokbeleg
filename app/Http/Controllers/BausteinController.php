<?php

namespace App\Http\Controllers;

use App\Baustein;
use Illuminate\Http\Request;

class BausteinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alleBausteine = Baustein::all();
        return view('bausteine.index', compact('alleBausteine'));
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
     * Display the specified resource.
     *
     * @param  \App\Baustein  $baustein
     * @return \Illuminate\Http\Response
     */
    public function show(Baustein $baustein)
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
