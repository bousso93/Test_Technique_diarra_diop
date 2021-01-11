<?php

namespace App\Http\Controllers;

use App\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Carbon::setLocale('fr');
        $offres = Offre::latest()->paginate(20);
        foreach($offres as $offre){
            $offre->setAttribute('user', $offre->user);
            $offre->setAttribute('sector', $offre->sector);
            $offre->setAttribute('added', Carbon::parse($offre->created_at)->diffForHumans());
            $offre->setAttribute('path', '/offres/'.$offre->slug);
        }
        return response()->json($offres);
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
        Offre::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'text' => $request->text,
            'user_id' => $request->user_id,
            'sector_id' => $request->sector_id,
            'published_by' => $request->user_id,
            'is_published' => $request->is_published
        ]);

        return response()->json(['message' => 'Offre ajouté avec succés']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function show(Offre $offre)
    {
        //
        Carbon::setLocale('fr');
        return response()->json([ 'offre' =>[
           'id' => $offre->id,
           'title' => $offre->title,
           'text' => $offre->text,
           'slug' => $offre->slug,
           'published_by' => $offre->user->name,
           'created_at' => $offre->created_at->diffForHumans(),
           'user' => $offre->user->name,
           'secteur' => $offre->sector->title,
           'is_published' => $offre->is_published,
        
        ]   
        ]);
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function edit(Offre $offre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offre $offre)
    {
        //
     

        // var_dump($);
      
        $offre->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'text' => $request->text,
            'user_id' => $request->user_id,
            'sector_id' => $request->sector_id,
            'published_by' => $request->user_id,
            'is_published' => $request->is_published
        ]);

        return response()->json(['message' => 'Offre modifié avec succés']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offre $offre)
    {
        //
    }
}
