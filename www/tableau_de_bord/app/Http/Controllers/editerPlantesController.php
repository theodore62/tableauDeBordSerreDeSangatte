<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\log;
use Illuminate\Http\Request;
use App\Models\Plantes;

class editerPlantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plantes = Plantes::all();
        return view('editerPlante',['plantes'=>$plantes]);
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
        $plantes = Plantes::where('nom', 'like', '%'.$request->search.'%')
        ->orWhere('varieter', 'like', '%'.$request->search.'%')
        ->orWhere('couleur', 'like', '%'.$request->search.'%')
        ->orWhere('conditionnement', 'like', '%'.$request->search.'%')
        ->orWhere('prix', 'like', '%'.$request->search.'%')
        ->orWhere('categorie', 'like', '%'.$request->search.'%')
        ->orderBy('nom')
        ->paginate(20);
        if($plantes == null ){
            $plantes = Plantes::all();
        }
        Log::info($plantes);
        return view('editerPlante',['plantes'=>$plantes]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([Plantes::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nom' => 'required|max:255',
                'varieter' => 'required|max:255',
                'couleur'=>'required|max:255',
                'conditionnement'=>'required',
                'prix' => 'required|max:255',
                'categorie'=> 'required',
    
            ]);
        $plante = Plantes::findOrFail($request->id);
        $plante->nom = $request->nom;
        $plante->varieter = $request->varieter;
        $plante->couleur = $request->couleur;
        $plante->conditionnement = $request->conditionnement;
        $plante->prix = $request->prix;
        $plante->categorie = $request->categorie;
        $plante->update();
        return back()->with('info', 'la plante a bien été mise à jour.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plante = Plantes::findOrFail($id);
        $plante->delete();
        return back()->with('info', 'la plante à bien était supprimé.');
    }
}
