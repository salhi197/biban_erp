<?php


namespace App\Http\Controllers;

use Auth;
use App\Type;
use App\Camion;
use App\Commune;
use App\Fichier;
use App\Attachement; 
use App\Sms; 
use App\Wilaya;
use Carbon\Carbon;
use App\Immobilisation;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Validator;

class ImmobilisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $camions = DB::table('camions')
            ->select('matricule')
            ->distinct()
            ->get();
        $filter = 0;
        $matricules = [];
        $types = [];
        $type_emballages = [];
        $type="";
        $immobilisations = Immobilisation::orderBy('id', 'DESC')->limit(300)->get();
        return view('immobilisations.index',compact('type','matricules','camions','immobilisations','filter','types','type_emballages'));//,compact('attachements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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
                DB::table('immobilisations')->insert($insert);
            }
            return redirect()->route('immobilisations.index')->with('success', 'process terminé  !  ');                
        }else{
            return redirect()->route('immobilisations.index')->with('error', $validator->errors()->first());
        }
    }



     


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $wheres = "";
        $index = 0;
        $types = [];
        $type = "";
        
        $debut_entre = "";
        $fin_entre ="";
        $matricules = [];
        $type_emballages = [];

        if($request['type']){
            $type = $request['type'];
            if($index==0){
                if ($request['type'] == "Usine M'Sila") {
                    $wheres =$wheres.'where type="Usine M\'Sila" ';
                }else{
                    $wheres =$wheres."where type='$type' ";                
                }    
            }else{
                if ($request['type'] == "Usine M'Sila") {
                    $wheres =$wheres.'and type="Usine M\'Sila" ';
                }else{
                    $wheres =$wheres."and type='$type' ";                
                }
            }
            $index=2;

        }

        

        if($request['debut_entre']){
            $debut_entre = $request['debut_entre'];
            if($index==0){
                $wheres =$wheres." where date_facture >= '$debut_entre' ";
                $index = 2;
            }else{
                $wheres =$wheres." and date_facture >= '$debut_entre' ";
            }
            $index=2;
        }

        if($request['types']){
            $types = $request['types'];
            if($index==0){
                $wheres =$wheres." where (";
                foreach($request['types'] as $key=>$type){
                    if($key == count($request['types'])-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    if ($type == "Usine M'Sila") {
                        $wheres =$wheres.'site_de_chargement="Usine M\'Sila" '.$operator;
                    }else{
                        $wheres =$wheres."site_de_chargement='$type' ".$operator;
                    }        
                }
                $wheres =$wheres." ) ";                
            }else{
                $wheres =$wheres." and ( ";
                foreach($request['types'] as $key=>$type){
                    if($key == count($request['types'])-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    if ($type == "Usine M'Sila") {
                        $wheres =$wheres.' site_de_chargement="Usine M\'Sila" '.$operator;
                    }else{
                        $wheres =$wheres."site_de_chargement='$type' ".$operator;
                    }        
                }
                $wheres =$wheres." ) "; 
            }
            $index=2;
        }



        if($request['type_emballages']){
            $type_emballages = $request['type_emballages'];
            if($index==0){
                $wheres =$wheres." where (";
                foreach($request['type_emballages'] as $key=>$type_emballage){
                    if($key == count($request['type_emballages'])-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    $wheres =$wheres."type_emballage='$type_emballage' ".$operator;
                }
                $wheres =$wheres." ) ";
            }else{
                $wheres =$wheres."and ( ";
                foreach($request['type_emballages'] as $key=>$type_emballage){
                    if($key == count($request['type_emballages'])-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    $wheres =$wheres."type_emballage='$type_emballage' ".$operator;
                }
                $wheres =$wheres." ) ";
            }
            $index=2;
        }

        if($request['matricules']){

            $matricules = $request['matricules'];
            if($index==0){
                $wheres =$wheres." where (";
                foreach($request['matricules'] as $key=>$matricule){
                    if($key == count($request['matricules'])-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    $wheres =$wheres."camion='$matricule' ".$operator;
                }
                $wheres =$wheres." ) ";
            }else{
                $wheres =$wheres."and ( ";
                foreach($request['matricules'] as $key=>$matricule){
                    if($key == count($request['matricules'])-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    $wheres =$wheres."camion='$matricule' ".$operator;
                }
                $wheres =$wheres." ) ";
            }
            $index=2;
        }
        if($request['fin_entre']){
            $fin_entre = $request['fin_entre'];
            if($index>0){
                $wheres =$wheres." and date_facture <= '$fin_entre'";
            }else{
                $wheres =$wheres." where date_facture <= '$fin_entre'";
                $index=2;
            }
        }

        $sql = "select * from immobilisations as a ";
        $sql = $sql.$wheres;
        $sql = $sql.' ORDER BY STR_TO_DATE(date_facture,"%d-%m-%Y") ASC';

        $immobilisations=DB::select(DB::raw($sql));
        

        // $immobilisations = json_decode($immobilisations,true);
        /** convert  */ 
        $filter = 1;
        $camions = DB::table('camions')
            ->select('matricule')
            ->distinct()
            ->get();

        return view('immobilisations.index',compact('immobilisations','filter','types','type','fin_entre','debut_entre','camions','matricules','type_emballages','sql'));        
    }
     

    
    public function generer(Request $request)
    {
        $wheres = "";
        $index = 0;
        $types = [];
        $type = "";
        $debut_entre = "";
        $fin_entre ="";
        $matricules = [];
        $type_emballages = [];


        if($request['debut_entre']){
            $debut_entre = $request['debut_entre'];
            if($index==0){
                $wheres =$wheres." where date_facture >= '$debut_entre' ";
                $index = 2;
            }else{
                $wheres =$wheres." and date_facture >= '$debut_entre' ";
            }
            $index=2;
        }

        if($request['types'] and count(json_decode($request['types'])) > 0){
            $types = json_decode($request['types']); 
            if($index==0){
                $wheres =$wheres." where (";
                foreach($types as $key=>$type){
                    if($key == count($types)-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    if ($type == "Usine M'Sila") {
                        $wheres =$wheres.'site_de_chargement="Usine M\'Sila" '.$operator;
                    }else{
                        $wheres =$wheres."site_de_chargement='$type' ".$operator;
                    }        
                }
                $wheres =$wheres." ) ";                
            }else{
                $wheres =$wheres." and ( ";
                foreach($types as $key=>$type){
                    if($key == count($types)-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    if ($type == "Usine M'Sila") {
                        $wheres =$wheres.' site_de_chargement="Usine M\'Sila" '.$operator;
                    }else{
                        $wheres =$wheres."site_de_chargement='$type' ".$operator;
                    }        
                }
                $wheres =$wheres." ) "; 
            }
            $index=2;
        }

        if($request['type']){
            $type = $request['type'];
            if($index==0){
                if ($request['type'] == "Usine M'Sila") {
                    $wheres =$wheres.'where type="Usine M\'Sila" ';
                }else{
                    $wheres =$wheres."where type='$type' ";                
                }    
            }else{
                if ($request['type'] == "Usine M'Sila") {
                    $wheres =$wheres.'and type="Usine M\'Sila" ';
                }else{
                    $wheres =$wheres."and type='$type' ";                
                }
    
            }
            $index=2;
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




        if($request['type_emballages'] and count(json_decode($request['type_emballages'])) > 0){
            $type_emballages = json_decode($request['type_emballages']);
            if($index==0){
                $wheres =$wheres." where (";
                foreach($type_emballages as $key=>$type_emballage){
                    if($key == count($type_emballages)-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    $wheres =$wheres."type_emballage='$type_emballage' ".$operator;
                }
                $wheres =$wheres." ) ";
            }else{
                $wheres =$wheres."and ( ";
                foreach($type_emballages as $key=>$type_emballage){
                    if($key == count($type_emballages)-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    $wheres =$wheres."type_emballage='$type_emballage' ".$operator;
                }
                $wheres =$wheres." ) ";
            }
            $index=2;
        }

        if($request['matricules'] and count(json_decode($request['matricules'])) > 0){
            $matricules = json_decode($request['matricules']);
            if($index==0){
                $wheres =$wheres." where (";
                foreach($matricules as $key=>$matricule){
                    if($key == count($matricules)-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    $wheres =$wheres."camion='$matricule' ".$operator;
                }
                $wheres =$wheres." ) ";
            }else{
                $wheres =$wheres."and ( ";
                foreach($matricules as $key=>$matricule){
                    if($key == count($matricules)-1){
                        $operator = '';
                    }else{
                        $operator = 'or ';
                    }
                    $wheres =$wheres."camion='$matricule' ".$operator;
                }
                $wheres =$wheres." ) ";
            }
            $index=2;
            $camion = Camion::where('matricule',$matricule)->first();
            $fournisseur = $camion->fournisseur;

        }

        if($request['fin_entre']){
            $fin_entre = $request['fin_entre'];
            if($index>0){
                $wheres =$wheres." and date_facture <= '$fin_entre'";
            }else{
                $wheres =$wheres." where date_facture <= '$fin_entre'";
                $index=2;
            }
        }

        $_sql = "select mois_de_la_prestation,date_facture,reservation,mission,produit,camion,chauffeur,code_client,raison_sociale,ville,wilaya,categorie,somme_de_qte_facturee,somme_de_cout,type from attachements ";
        $_sql = $_sql.$wheres;
        $_sql = $_sql.' order by wilaya,ville desc';
        $ids = $_sql;

        $sql = "select  a.ville,a.wilaya,somme_de_qte_facturee as qte_facturee from attachements as a ";
        $sql = $sql.$wheres; 
        
        $immobilisations=DB::select(DB::raw($sql));
        // $attachements = json_decode($attachements,true);
        /** convert  */ 
        $filter = 1;
        $type  = 'camion';
        $_type = $request['type']; 

        

        return view('immobilisations.results',compact('type','_type','immobilisations','filter','type','matricule','fin_entre','debut_entre','type_emballage','ids','fournisseur'));        
    }





    public function vider()
    {   
        $sql = "delete from immobilisations where 1=1";
        $attachements=DB::select(DB::raw($sql));
        $filter = 0;
        $type="";
        return redirect()->route('immobilisation.index')->with('success', 'process terminé  !  ');
    }

}
