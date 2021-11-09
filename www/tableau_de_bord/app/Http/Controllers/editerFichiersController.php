<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\log;
use Illuminate\Http\Request;
use App\Models\FichierExcel;
// USE App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Storage;

class editerFichiersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichiers = FichierExcel::all();
        return view('editerFichiers',['fichiers'=>$fichiers]);
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
        $fichiers = FichierExcel::where('nom', 'like', '%'.$request->search.'%')
        ->orWhere('url', 'like', '%'.$request->search.'%')
        ->orWhere('nomFichier', 'like', '%'.$request->search.'%')
        ->orWhere('date', 'like', '%'.$request->search.'%')
        ->orderBy('nom')
        ->paginate(20);
        if($fichiers == null ){
            $fichiers = FichierExcel::all();
        }
        Log::info($fichiers);
        return view('editerFichiers',['fichiers'=>$fichiers]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info($id);
        $fichiers = FichierExcel::findOrFail($id);       
        if( is_file($fichiers->url) )
        {
            // $url= asset($fichiers->url);
            $url=Storage::url('teste.xlsx');
            Log::info($url);
            // \Storage::download($url);
            // return back()->with('success', 'le fichier à bien était télécharger.');
            // return asset($fichiers->url);
        }
        else
        {
            return back()->with('info', 'le fichier n\'a pas pu être télécharger.');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fichiers = FichierExcel::findOrFail($id);       
        if( is_file($fichiers->url) )
        {
            $url= 'public/fichier_Excel/'.$fichiers->nomFichier;
            Log::info($url);
            \Storage::delete($url);
            $fichiers->delete();
            return back()->with('success', 'le fichier à bien était supprimé.');
        }
        else
        {
            return back()->with('info', 'le fichier n\'a pas pu être supprimé.');
        }

    }
}
