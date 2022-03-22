<?php

namespace App\Http\Controllers;

use Auth;
use App\Type;
use App\Fichier;
use App\Camion;
use App\Commune;
use App\Attachement; 
use App\Wilaya;
use File;
use Carbon\Carbon;
use Excel;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Validator;

class FichierController extends Controller
{
    
    public function index()
    {   
        $fichiers=Fichier::all();
        return view('fichiers.index',compact('fichiers'));
    }


    public function open($facture)
    {
        $facture = Facturefind($facture);
        $attachements = Item::where('facture',$facture)->get();
        return view($facture->type.'resutls',compact('attachements'));
    }
    
    public function delete($id_fichier)
    {
        $fichier = Fichier::find($id_fichier);
        File::delete($fichier->path);        
        $fichier->delete();
        return redirect()->route('fichier.index')->with('success', 'process terminé  !  ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facture  = new Facture();
        $subtotal = 0;
        $total = 0;
        $tva = $request['tva'];
        foreach ($variable as $key => $value) {
            
        }
        
        $facture->total = $total;
        $facture->tva = $tva;
        $facture->subtotal = $subtotal;
        $facture->save();

    }
}
