<?php

namespace App\Http\Controllers;

use App\Models\Plantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\log;

class PlanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajoutPlante');
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
        Log::info($request);
        $request->validate(
        [
            'nom' => 'required|max:255',
            'varieter' => 'required|max:255',
            'couleur'=>'required|max:255',
            'conditionnement'=>'required',
            'prix' => 'required|max:255',
            'categorie' => 'required|max:255',

        ]);
        $plantes = Plantes::create([
            'nom'=> $request->nom,
            'varieter'=> $request->varieter,
            'couleur'=>$request->couleur,
            'conditionnement'=>$request->conditionnement,
            'prix'=>$request->prix,
            'categorie'=>$request->categorie

        ]);
        $plantes->save();
        return back()->with('success','les données sont bien enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plante  $plante
     * @return \Illuminate\Http\Response
     */
    public function show(Plante $plante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plante  $plante
     * @return \Illuminate\Http\Response
     */
    public function edit(Plante $plante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plante  $plante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plante $plante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plante  $plante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plante $plante)
    {
        //
    }
}
