<?php

namespace App\Http\Controllers;

use App\Camion;
use App\Attachement;
use App\Fdr;

use App\Facture;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class FdrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fdrs=Fdr::all();
        return view('fdrs.index',compact('fdrs'));//,'filter','type','fournisseurs'));//,compact('attachements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $fdr  = new Fdr();
        $fdr->titre = $request['titre'];
        $fdr->path = $request['fdr']->store(
            'fdr',
            'public'
        );
        $fdr->save();
        return redirect()->route('fdr.index')->with('success', 'F.D.R Inséré  !  ');
    }




     /**
     * Display the specified resource.
     *
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function reload()
    {
        $sql = "delete from camions where 1=1" ;
        DB::select(DB::raw($sql));
        $sql = "insert into camions (matricule,nom_contacte,telephone) select DISTINCT(a.matricule_camion) as matricule ,a.nom_contacte,a.tel_contacte as telephone from clients a " ;
        $camions=DB::select(DB::raw($sql));
        
        return redirect()
            ->route('camion.index')
            ->with([
                'success' => 'les camion sont actualisés ! '
            ]);
    }

    public function facture($camion)
    {
        $factures = Facture::where(['camion'=>$camion,'type'=>'camion'])->get();
        $camion=Camion::where('matricule',$camion)->get();//DB::select(DB::raw($sql));
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
        $camion = Camion::find($camion);
        return view('camions.edit',compact('camion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camion $camion)
    {
            
        $camion = Camion::findOrfail($request['id']);
        $camion->matricule = $request['matricule']; 
        $camion->telephone = $request['telephone']; 
        $camion->adress = $request['adress']; 
        $camion->ville = $request['ville']; 
        $camion->debut = Carbon::parse($request['debut'])->format('Y-m-d');         
        if($request->file('fichier')){
            $fichier = $request->file('fichier')->store(
                'camions/fichiers',
                'public'
            );
        $camion->fichier = $fichier;
        }
        $camion->save();
        
        return redirect()
            ->route('camion.index')
            ->with([
                'success' => 'camion ajouté avec succés  '
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_decharge)
    {
        $fdr = Decharge::find($id_decharge);
        $fdr->delete();
        return redirect()
            ->route('decharge.index')
            ->with([
                'success' => 'décharge supprimé !   '
            ]);
    }
}
