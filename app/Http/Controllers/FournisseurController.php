<?php

namespace App\Http\Controllers;

use App\Camion;
use App\Fournisseur;

use App\Facture;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();//limit(200)->get();

        return view('fournisseurs.index',compact('fournisseurs'));//,compact('attachements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fournisseurs.create');//,compact('attachements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fournisseur = new Fournisseur();
        $fournisseur->nom =$request['nom']; 
        $fournisseur->prenom =$request['prenom']; 
        $fournisseur->telephone =$request['telephone']; 
        $fournisseur->rib =$request['rib']; 
        $fournisseur->adress =$request['adress']; 
        // $fournisseur->permis = $request['permis']->store(
        //     'fournisseurs/permis',
        //     'public'
        // );

        $fournisseur->save();
        foreach ($request['dynamic_form']['dynamic_form'] as $array) {
            $camion = Camion::where('matricule',$array['matricule'])->first();
            if(!$camion){
                $camion = new Camion();
            }
            $camion->matricule = $array['matricule'];
            $camion->fournisseur = $fournisseur->id;
            if (isset($array['carte_grise'])) {
                $camion->carte_grise = $array['carte_grise']->store(
                    'camion/carte_grise',
                    'public'
                );
                }
            $camion->save();
        }

        return redirect()
            ->route('fournisseur.index')
            ->with([
                'success' => 'client ajouté avec succés  '
            ]);
    }

    public function affecter(Request $request)
    {
        $camion = new Camion();
        $camion->matricule = $request['matricule'];
        $camion->fournisseur = $request['fournisseur'];
        $camion->save();
        return redirect()
            ->back()
            ->with([
                'success' => 'matricule affécté avec succés  '
            ]);
    }


    public function affecterUpdate(Request $request)
    {
        $camion = Camion::find($request['matricule']);
        $camion->fournisseur = $request['fournisseur'];
        $camion->save();

        return redirect()
            ->back()
            ->with([
                'success' => 'modification efféctué  '
            ]);
    }



    public function reload()
    {
        $sql = "delete from camions where 1=1" ;
        DB::select(DB::raw($sql));
        $sql = "insert into camions (matricule,nom_contacte,telephone) select DISTINCT(a.matricule_camion) as matricule ,a.nom_contacte,a.tel_contacte as telephone from clients a " ;
        $fournisseurs=DB::select(DB::raw($sql));
        
        return redirect()
            ->route('camion.index')
            ->with([
                'success' => 'les camion sont actualisés ! '
            ]);
    }

    public function facture($camion)
    {
        $factures = Facture::where(['camion'=>$camion,'type'=>'camion'])->get();
        $camion=Fournisseur::where('matricule',$camion)->get();//DB::select(DB::raw($sql));
        return view('factures.camion',compact('factures','camion'));

        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function edit($camion)
    {
        $fournisseur = Fournisseur::find($camion);
        $camions = Camion::where('fournisseur',$fournisseur->id)->get();        
        return view('fournisseurs.edit',compact('fournisseur','camions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$fournisseur_id)
    {
        $fournisseur = Fournisseur::find($fournisseur_id);
        $fournisseur->nom =$request['nom']; 
        $fournisseur->prenom =$request['prenom']; 
        $fournisseur->telephone =$request['telephone']; 
        $fournisseur->rib =$request['rib']; 
        $fournisseur->adress =$request['adress']; 
        $fournisseur->save();
        foreach ($request['dynamic_form']['dynamic_form'] as $array) {

            $camion = Camion::where('matricule',$array['matricule'])->first();
            if(!$camion){
                $camion = new Camion();
            }
            $camion->matricule = $array['matricule'];
            $camion->fournisseur = $fournisseur->id;
            $camion->permis = $array['permis']->store(
                'camion/permis',
                'public'
            );
            $camion->carte_grise = $array['carte_grise']->store(
                'camion/carte_grise',
                'public'
            );
            $camion->save();

        }

        return redirect()
            ->route('fournisseur.index')
            ->with([
                'success' => 'client ajouté avec succés  '
            ]);
            

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function destroy($fournisseur_id)
    {
        $fournisseur = Fournisseur::find($fournisseur_id);
        $fournisseur->delete();
        return redirect()
            ->route('fournisseur.index')
            ->with([
                'success' => 'Supprimé avec succés   '
            ]);


    }
}
