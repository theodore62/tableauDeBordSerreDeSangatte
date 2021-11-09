<?php

namespace App\Http\Controllers;
use App\Models\Plantes;
use App\Models\FichierExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\log;
use Rap2hpoutre\FastExcel\FastExcel;
// Importation de SheetCollection
use Rap2hpoutre\FastExcel\SheetCollection; 

class generationExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantes = Plantes::all();
        return view('generationExcel',['plantes'=>$plantes]);
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

        $request->validate(
        [
            'nomFichier' => 'required|min:3',    
        ]);
        $resultPlantes = [
            'annuelles'=> [],   
            'vivaces'=>[],
            'aromatiques'=>[],
            'legumes'=>[],
            'fruits'=>[],           
        ];
        $tableau= [];
        $annuelles = 'annuelles';
        $vivaces = 'vivaces';
        $aromatiques = 'aromatiques';
        $legumes = 'legumes';
        $fruits = 'fruits'; 
        $tableauAnnuelles=[];
        $tableauVivaces=[];
        $tableauAromatiques=[];
        $tableauLegumes=[];
        $tableauFruits=[];
        foreach ($request as $key => $value) {
            foreach ($value as $keyvalues => $values) {
                if (strpos($keyvalues,$annuelles) !== false) {
                    $tableau[] = $this->tableauId($keyvalues,$annuelles,$values);
                }    
                if (strpos($keyvalues,$vivaces) !== false) {
                    $tableau[] = $this->tableauId($keyvalues,$vivaces,$values);
                }   
                if (strpos($keyvalues,$aromatiques) !== false) {
                    $tableau[] =   $this->tableauId($keyvalues,$aromatiques,$values);
                } 
                if (strpos($keyvalues,$legumes) !== false) {
                    $tableau[] = $this->tableauId($keyvalues,$legumes,$values);
                }   
                if (strpos($keyvalues,$fruits) !== false) {
                    $tableau[] = $this->tableauId($keyvalues,$fruits,$values);
                }        
            }       
        }  
        foreach ($tableau as $key => $value) { 
            $plante = Plantes::findOrFail($value);
            if($plante->categorie ===  $annuelles){
                $resultPlantes[$annuelles][] =  $this->tableauPlante($plante);                
            }
            if($plante->categorie ===  $vivaces){
                $resultPlantes[$vivaces][] = $this->tableauPlante($plante);  
            }  
            if($plante->categorie ===  $aromatiques){
                $resultPlantes[$aromatiques][] =  $this->tableauPlante($plante);                   
            }  
            if($plante->categorie ===  $legumes){
                $resultPlantes[$legumes][] =  $this->tableauPlante($plante);                    
            }   
            if($plante->categorie ===  $fruits){
                $resultPlantes[$fruits][] =  $this->tableauPlante($plante);                   
            }          
        }
        foreach ($resultPlantes['annuelles'] as $key => $value) {
            $tableauAnnuelles[]=$value;           
        }
        foreach ($resultPlantes['vivaces'] as $key => $value) {
            $tableauVivaces[]=$value;           
        }
        foreach ($resultPlantes['aromatiques'] as $key => $value) {
            $tableauAromatiques[]=$value;           
        }
        foreach ($resultPlantes['legumes'] as $key => $value) {
            $tableauLegumes[]=$value;           
        }
        foreach ($resultPlantes['fruits'] as $key => $value) {
            $tableauFruits[]=$value;           
        }
        $listAnnuelles = collect($tableauAnnuelles);
        $listVivaces = collect($tableauVivaces);
        $listAromatiques = collect($tableauAromatiques);
        $listLegumes = collect($tableauLegumes);
        $listFruits = collect($tableauFruits);

        $sheets = new SheetCollection([
            "Annuelles" => $listAnnuelles,
            "Vivaces" => $listVivaces,
            "Aromatiques" => $listAromatiques,
            "Légumes" => $listLegumes,
            "Fruits" => $listFruits,
        ]);
        $url = "storage/fichier_Excel/$request->nomFichier.xlsx";
        $nomDuFichier = "$request->nomFichier.xlsx";
        $date = new \DateTime();

        $verifiaction = false;
        $fichierVerif = FichierExcel::where('nom', 'like', '%'.$request->nomFichier.'%')->get();
        if( count($fichierVerif) > 0){
            foreach ($fichierVerif as $key => $value) {
                    if($value->nom !== $request->nomFichier ){
                        $verifiaction = true;
                    }
                    else
                    {
                        $verifiaction = false;
                    }
            }
        }else{
            $verifiaction = true;
        }
     
       if($verifiaction){
            $chemin = (fastexcel($sheets))->export($url);
            $fichier = FichierExcel::create([
                'nom'=> $request->nomFichier,
                'url'=> $url,
                'nomFichier'=>$nomDuFichier,
                'date'=> $date->format("d/m/Y"),
            ]);
            $fichier->save();
            $verifiaction = false;
            return (fastexcel($sheets))->download($url);
            // return back()->with('success', 'le fichier à était crée avec succé.');      
       }else{
            Log::info('ici');
            return back()->with('info', 'un fichier comporte déjà le même nom.');            
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    
    

    function tableauId($keyvalues,$categorie,$values){        
        if (strpos($keyvalues,$categorie) !== false) {
            return $values;
        }  
    }
    function tableauPlante($plante){
      return [
            'id'=> $plante->id,
            'nom'=> $plante->nom,
            'varieter'=> $plante->varieter,
            'couleur'=> $plante->couleur,
            'conditionnement'=> $plante->conditionnement,
            'prix'=> $plante->prix,
            'categorie'=> $plante->categorie,
        ];                  
    }
    



}
