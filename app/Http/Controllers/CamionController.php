<?php

namespace App\Http\Controllers;

use App\Camion;
use App\Attachement;
use App\Fournisseur;

use App\Facture;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class CamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = 0;
        $type = 0;        
        $camions=Camion::all();//DB::select(DB::raw($sql));
        $fournisseurs=Fournisseur::all();//DB::select(DB::raw($sql));        
        return view('camions.index',compact('camions','filter','type','fournisseurs'));//,compact('attachements'));
    }


    public function empty()
    {
        $filter = 0;
        $type = 0;        
        $camions=Camion::where('fournisseur',null)->get();
        $fournisseurs=Fournisseur::all();//DB::select(DB::raw($sql));        
        return view('camions.index',compact('camions','filter','type','fournisseurs'));//,compact('attachements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('camions.create');//,compact('attachements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        ]);
        $camion = new Camion();
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
                'success' => 'camion ajout?? avec succ??s  '
            ]);
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
                'success' => 'les camion sont actualis??s ! '
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
                'success' => 'camion ajout?? avec succ??s  '
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Camion  $camion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_camion)
    {
        $camion = Camion::findOrfail($id_camion);
        $camion->delete();
        return redirect()
            ->back()
            ->with([
                'success' => 'camion supprim?? avec succ??s  '
            ]);

    }
}
