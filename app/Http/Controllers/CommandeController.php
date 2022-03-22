<?php

namespace App\Http\Controllers;

use Auth;
use App\Type;
use App\Camion;
use App\Commune;
use App\Wilaya;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CamionController extends Controller
{


    
    public function index()
    {
        $camions = DB::table('camions')->orderBy('id', 'DESC');
        return view('camions.index',compact('camions'));
    }


    public function show($camion){
        $camion =  Camion::find($camion);
        return view('camions.view',compact('camion'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('camions.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $camion =  new Camion([
            'matricule'=>$request->get('matricule'),
            'telephone'=>$request->get('telephone'),
            'adress'=>$request->get('adress'),
            'debut'=>$request->get('debut'),
            'numero'=>$request->get('numero'),
            'wilaya'=>$request->get('wilaya'),
            'commune'=>$request->get('commune'),
            'state'=>$request->get('state'),            
        ]);
        $camion->save();
        return redirect()->route('camions.index')->with('success', 'le camion a été inséré avec succés  !  ');

    }

    public function edit($camion)
    {
        $camion = Camion::find($camion);
        return view('camions.edit',compact('camion'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $commande)
    {
        
    }

    public function destroy($camion)
    {
            $c = Camion::find($camion);
            $c->delete();
            return redirect()->route('camion.index')->with('success', 'le camion a été supprimé ');     
    }
}
