<?php

namespace App\Http\Controllers;

use Auth;
use App\Item;
use App\Facture;
use App\Camion;
use App\Commune;
use App\Attachement; 
use App\Wilaya;
use App\Fournisseur;

use Carbon\Carbon;
use Excel;
use Dompdf\Dompdf;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Validator;

class FactureController extends Controller
{
    
    public function index()
    {   
        $factures=Facture::all();
        return view('factures.index',compact('factures'));
    }


    public function camion()
    {   
        $factures=Facture::where('type','=','camion')->get();
        return view('factures.camion',compact('factures'));
    }
    public function attachement()
    {   
        $factures=Facture::where('type','=','attachements')->get();
        
        return view('factures.attachement',compact('factures'));
    }


    public function open($facture)
    {
        $facture = Facture::find($facture);
        $attachements = Item::where('facture',$facture->id)->get();
        return view('factures.view',compact('attachements','facture'))->with('error',"d");
    }
    
    public function show($facture)
    {
        $facture = Facture::find($facture);
        $attachements = Item::where('facture',$facture->id)->get();    
        return view('factures.show',compact('attachements','facture'));
    }


    public function edit($facture)
    {
        $facture = Facture::find($facture);
        $attachements = Item::where('facture',$facture->id)->get();    
        return view('factures.edit',compact('attachements','facture'));
    }

    public function delete($facture)
    {
        $facture = Facture::find($facture);
        Item::where('facture',$facture->id)->delete();    
        $facture->delete();
        return redirect()->route('facture.type.attachement')->with('success', 'facture supprimé !');
    }


    public function store(Request $request)
    {


        $facture  = new Facture();
        $stack = array();
        $totalht = 0;
        $facture->save();
        $array = (array) $request['items'];

        
        $items = json_decode($request['items'],true);
        
        foreach ($items as $array) {
            $item = new  Item();
            $item->designation = $array['designation'];
            $item->quantite = $array['quantite'];
            $item->rotations = $array['rotations'];
            $item->prix = $array['prixht'];
            $item->total = $array['total'];
            $item->facture = $facture->id;
            $totalht = $totalht + $array['total'];
            $item->save();             
        }        
        $facture->reste = $totalht+$totalht*0.19;
        $facture->total = $totalht+$totalht*0.19;

        $facture->totalht = $totalht;

        $facture->type = 'attachements';
        $facture->type_emballage = $request['type_emballage'];
        
        $facture->tva = $request['tva'];
        $facture->numero_facture= $request['numero_facture'];
        $facture->registre= $request['registre'];
        $facture->i_f= $request['i_f'];
        $facture->nis= $request['nis'];
        $facture->ai= $request['ai'];        
        $facture->attachements= $request['attachements'];        

        $facture->assurance= $request['assurance'];
        $facture->gaz= $request['gaz'];
        $facture->gps= $request['gps'];        
        $facture->raison= $request['raison'];
        $facture->adress = $request['adress'];        
        $facture->save();
        return redirect()->route('facture.open',['facture'=>$facture->id])->with('success', 'le process est terminé ! ');


    }

    public function download($id_facture)
    {
        $facture = Facture::find($id_facture);
        $dompdf = new Dompdf();
        $items= Item::where('facture',$facture->id)->get();

        $options = $dompdf->getOptions(); 
        $options->set(array('isRemoteEnabled' => true));
        $dompdf->setOptions($options);
        if ($facture->type == "attachements") {
            $html = Facture::template($facture);
            }else{
            // $html = Facture::template2($facture);
            $html = Facture::template3($facture);

        }



        $dompdf->loadHtml($html);
        $dompdf->render();
        $current = date('Y-m-d');
        $file = "facture_".$current;
        $dompdf->stream("$file", array('Attachment'=>0));
        



    }

    public function save(Request $request)
    {
        $facture  = new Facture();
        $stack = array();
        $totalht = 0;
        $facture->save();
        $array = (array) $request['items'];

        $items = json_decode($request['items'],true);
        foreach ($items as $array) {
            $item = new  Item();
            $item->designation = $array['designation'];
            $item->quantite = $array['quantite'];
            $item->rotations = 1;//$array['rotations'];
            $item->prix = $array['prixht'];
            $item->total = $array['prixht']*$array['quantite'];
            $item->facture = $facture->id;
            $totalht = $totalht + $array['total'];
            $item->save();             
        }        

        $facture->numero_facture= $request['numero_facture'];
        $facture->registre= $request['registre'];
        $facture->i_f= $request['i_f'];
        $facture->nis= $request['nis'];
        $facture->ai= $request['ai'];        
        $facture->assurance= $request['assurance'];
        $facture->gaz= $request['gaz'];
        $facture->gps= $request['gps'];        
        $facture->raison= $request['raison'];
        $facture->adress = $request['adress'];
        $facture->fournisseur = $request['fournisseur'];        
        $facture->attachements= $request['attachements'];                
        $facture->totalht = $totalht;
        $facture->type = 'camion';
        $facture->_type = $request['_type'];
        $facture->type_emballage = $request['type_emballage'];        
        $facture->camion = $request['matricule'];
            $facture->save();
        
        return redirect()->route('facture.type.camion')->with('success', 'le process est terminé ! ');


    }


    public function getItems($id_facture)
    {
        $facture = Facture::find($id_facture);
        $sql = $facture->attachements;
        
        $attachements=DB::select(DB::raw($sql));
        $filter = 0;
        $type="";
        return view('factures.items',compact('filter','attachements','type','facture'));
        
    }

    public function getItems2($id_facture)
    {
        $facture = Facture::find($id_facture);
        $sql = $facture->attachements;

        $clients=DB::select(DB::raw($sql));
        $filter = 0;
        $type="";
        return view('factures.items2',compact('filter','clients','type','facture'));
        
    }


    public function update(Request $request,$facture_id)
    {
        $facture  = Facture::find($facture_id);
        $facture->type_emballage = $request['type_emballage'];        
        $facture->tva = $request['tva'];
        $facture->numero_facture= $request['numero_facture'];
        $facture->registre= $request['registre'];
        $facture->i_f= $request['i_f'];
        $facture->nis= $request['nis'];
        $facture->ai= $request['ai'];        
        $facture->attachements= $request['attachements'];        
        $facture->assurance= $request['assurance'];
        $facture->gaz= $request['gaz'];
        $facture->gps= $request['gps'];        
        $facture->raison= $request['raison'];
        $facture->adress = $request['adress'];        
        $facture->save();
        return redirect()->route('facture.open',['facture'=>$facture->id])->with('success', 'le facture a été modifié! ');

    }




}
