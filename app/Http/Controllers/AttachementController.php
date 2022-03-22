<?php

namespace App\Http\Controllers;

use Auth;
use App\Type;
use App\Camion;
use App\Commune;
use App\Fichier;
use App\Attachement; 
use App\Wilaya;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Validator;

class AttachementController extends Controller
{
    
    public function index()
    {   
            $sql = "select mois_de_la_prestation,
                    date_facture,
                    reservation,
                    mission,
                    produit,
                    camion,
                    chauffeur,
                    code_client,
                    raison_sociale,
                    ville,
                    wilaya,
                    categorie,
                    somme_de_qte_facturee,
                    somme_de_cout
                    ,type from attachements  order by wilaya desc";
            // $sql = $sql.' group by a.adresse,a.ville';
        $attachements=DB::select(DB::raw($sql));
        $filter = 0;
        $type="";
        return view('attachements.index',compact('filter','attachements','type','user'));
    }

    public function vider()
    {   
        $sql = "delete from attachements where 1=1";
        $attachements=DB::select(DB::raw($sql));
        $filter = 0;
        $type="";
        return redirect()->route('attachement.index')->with('success', 'process terminé  !  ');
    }


    public function insert(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'example-file-input-custom'=>'required|mimes:xlxs,xls,csv,xlsx'
        ]);
        if($validator->passes()){
            $file = $request->file('example-file-input-custom');
            $dateTime = date('Ymd_His');
            $fileName = $dateTime . '-' . $file->getClientOriginalName();; // rename image
            $fichier = $file->store(
                '',
                'public'
            );
            $sheets = [];
            $savePath = 'storage/app/public/'.$fichier;            
            $fichier = new Fichier();
            $fichier->path = $savePath;
            $fichier->type = 'attachement';
            $fichier->save();                
    
            //            $sheets = Excel::load($savePath)->getSheetNames();//, function($reader) {})->get();
            $sheets = [
                0=>'SAC LCM',
                1=>'VRAC LCM',
                2=>'SAC LCO',
                3=>'VRAC LCO',
                4=>'SAC CILAS',
                5=>'VRAC CILAS'
            ];
            foreach($sheets as $key=>$sheet){
                $data = Excel::selectSheets($sheet)->load($savePath)->get();
                //$length = $data->count()-1;
                if(!empty($data) && $data->count() > 0){
                    foreach ($data as $key => $value) {

                        if(!empty($value) && $value['mois_de_la_prestation'] != "Total général"){
                            $insert[] = [
                                'type'=>$sheet, 
                                'mois_de_la_prestation'=> $value['mois_de_la_prestation'],
                                'date_facture'=> $value['date_facture'],
                                'reservation'=> $value['n0_reservation'],
                                'mission'=> $value['n0_mission'],
                                'produit'=> $value['produit'],
                                'camion'=> $value['camion'],
                                'chauffeur'=> $value['chauffeur'],
                                'code_client'=> $value['code_client'],
                                'raison_sociale'=> $value['raison_sociale'],
                                'ville'=> $value['ville'],
                                'wilaya'=> $value['wilaya'],
                                'categorie'=> $value['categorie'],
                                'somme_de_qte_facturee'=> $value['somme_de_qte_facturee'] ?? $value['qte_facturee'],
                                'somme_de_cout'=> $value['somme_de_cout'] ?? $value['totale_ht'],
                                'fichier'=>$fichier->id,
                                'user'=>$request['user']
                            ];        
                        }
                    }
                }
            }
            // Somme de Qté Facturée

            // Somme de COUT

            // Totale HT

            // Qté Facturée

            if(!empty($insert)){                    
                DB::table('attachements')->insert($insert);
            }
            return redirect()->route('attachement.index')->with('success', 'process terminé  !  ');                
        }else{
            return redirect()->route('attachement.index')->with('error', $validator->errors()->first());
        }
    }


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
    public function filter(Request $request)
    {
        /**
         * requete sql ak chayef 
         */

        $wheres = "";
        $index = 0;
        $type = "";
        $debut_entre = "";
        $fin_entre ="";
        if($request['type']){
            $type = $request['type'];
            if ($request['type'] == "Usine M'Sila") {
                $wheres =$wheres.'where type="Usine M\'Sila" ';
            }else{
                $wheres =$wheres."where type='$type' ";                
            }
            $index=1;
        }
        if($request['debut_entre']){
            $debut_entre = $request['debut_entre'];
            if($index==0){
                $wheres =$wheres."where date_facture >= '$debut_entre'";
                $index = 2;
            }else{
                $wheres =$wheres."and date_facture >= '$debut_entre'";
                $index=2;
            }
        }
        if($request['fin_entre']){
            $fin_entre = $request['fin_entre'];
            if($index>0){
                $wheres =$wheres." and date_facture <= '$fin_entre'";
            }else{
                $wheres =$wheres."where date_facture <= '$fin_entre'";
                $index=2;
            }
        }
        $sql = "select mois_de_la_prestation,date_facture,reservation,mission,produit,camion,chauffeur,code_client,raison_sociale,ville,wilaya,categorie,somme_de_qte_facturee,somme_de_cout,type from attachements ";
        $sql = $sql.$wheres;
        $sql = $sql.' order by ville,wilaya desc';
        // $sql = $sql.' group by a.adresse,a.ville';
        $attachements=DB::select(DB::raw($sql));
        // $attachements = json_decode($attachements,true);
        /** convert  */ 
        $filter = 1;

        return view('attachements.index',compact('attachements','filter','type','fin_entre','debut_entre'));        
    }


    public function generer(Request $request)
    {
        $wheres = "";
        $index = 0;
        if($request['type']){
            $type = $request['type'];
            if ($request['type'] == "Usine M'Sila") {
                $wheres =$wheres.'where type="Usine M\'Sila" ';
            }else{
                $wheres =$wheres."where type='$type' ";                
            }
            $index=2;
        }
        if($request['debut_entre']){
            $debut_entre = $request['debut_entre'];
            if($index==0){
                $wheres =$wheres."where date_facture >= '$debut_entre' ";
            }else{
                $wheres =$wheres."and date_facture >= '$debut_entre' ";
            }
            $index=2;

        }
        if($request['fin_entre']){
            
            $fin_entre = $request['fin_entre'];
            
            if($index==0){
                $wheres =$wheres."where date_facture <= '$fin_entre' ";
            }else{
                $wheres =$wheres."and date_facture <= '$fin_entre' ";
                $index=2;
            }
        }

        $_sql = "select mois_de_la_prestation,date_facture,reservation,mission,produit,camion,chauffeur,code_client,raison_sociale,ville,wilaya,categorie,somme_de_qte_facturee,somme_de_cout,type from attachements ";
        $_sql = $_sql.$wheres;
        $_sql = $_sql.' order by wilaya,ville desc';
        $ids = $_sql;

        $sql = "select  a.ville,a.wilaya,sum(a.somme_de_qte_facturee) as quantite,count(*) as rotations from attachements as a ";
        $sql = $sql.$wheres; 
        $sql = $sql.' group by a.ville,a.wilaya order by wilaya';
        
        $attachements=DB::select(DB::raw($sql));
        // $attachements = json_decode($attachements,true);
        /** convert  */ 
        $filter = 1;
        $type  = 'attachements';
        $_type = $request['type']; 

        return view('attachements.results',compact('attachements','filter','type','_type','ids'));        
    }


}
