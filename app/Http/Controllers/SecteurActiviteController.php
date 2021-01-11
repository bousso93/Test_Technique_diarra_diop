<?php

namespace App\Http\Controllers;

use App\SecteurActivite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SecteurActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        //
        return response()->json(['secteurs' => SecteurActivite::get()]);
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
        $uuid = Str::uuid()->toString();
        SecteurActivite::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description
        ]);

        return response()->json(['message' => 'Secteur ajouté avec succés']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SecteurActivite  $secteurActivite
     * @return \Illuminate\Http\Response
     */
    public function show(SecteurActivite $secteurActivite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SecteurActivite  $secteurActivite
     * @return \Illuminate\Http\Response
     */
    public function edit(SecteurActivite $secteurActivite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SecteurActivite  $secteurActivite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SecteurActivite $secteurActivite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SecteurActivite  $secteurActivite
     * @return \Illuminate\Http\Response
     */
    public function destroy(SecteurActivite $secteurActivite)
    {
        //
        var_dump($secteurActivite);die();
        $secteurActivite->delete();
        return response()->json(['message' => 'secteur supprimé']);
    }
}
