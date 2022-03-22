<?php


namespace App\Http\Controllers;

use Auth;
use App\Type;
use App\Camion;
use App\Commune;
use App\Fichier;
use App\Attachement; 

use App\Sms; 
use App\Fournisseur; 
use App\Wilaya;
use Carbon\Carbon;
use App\Client;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $camions = Camion::all();
        // ')
        //     ->select('matricule')
        //     ->distinct()
        //     ->get();
        $filter = 0;
        $matricules = [];
        $types = [];
        $type_emballages = [];
        
        $clients = Client::orderBy('id', 'DESC')->limit(300)->get();
        return view('clients.index',compact('matricules','camions','clients','filter','types','type_emballages'));//,compact('attachements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function insert(Request $request)
    {
        $tmp = 1;
        // $validator = Validator::make($request->all(),[
        //     'example-file-input-custom'=>'required|mimes:xlxs,xls,csv'
        // ]);

        $file = $request->file('example-file-input-custom');
        $dateTime = date('Ymd_His');
        $fileName = $dateTime . '-' . $file->getClientOriginalName();; // rename image
        $fichier = $file->store(
            '',
            'public'
        );
        $savePath = 'storage/app/public/'.$fichier;            
        $fichier = new Fichier();
        $fichier->path = $savePath;
        $fichier->type = 'attachement';
        $fichier->save();                

        $data = Excel::load($savePath)->get();
        if(!empty($data) && $data->count() > 0){
            foreach ($data as $key => $value) {
                $insert[] = [
                    'etat'=>$value['etat'],
                    'motif'=>$value['motif'],
                    'nom_chauffeur'=>$value['nom_chauffeur'],
                    'matricule_camion'=>$value['matricule_camion'],
                    'matricule_remorque'=>$value['matricule_remorque'],
                    'site_de_chargement'=>$value['site_de_chargement'],
                    'date_reservation'=>$value['date_reservation'],
                    'num_reservation'=>$value['num_reservation'],
                    'code_reservation'=>$value['code_reservation'],
                    'etat_reservation'=>$value['etat_reservation'],
                    'type_emballage'=>$value['type_emballage'],
                    'code_produit'=>$value['code_produit'],
                    'code_slot'=>$value['code_slot'],
                    'date_permis'=>$value['date_permis'],
                    'transporteur'=>$value['transporteur'],
                    'num_mission'=>$value['num_mission'],
                    'dateheure_permis'=>$value['dateheure_permis'],
                    'dateheure_entree'=>$value['dateheure_entree'],
                    'dateheure_sortie'=>$value['dateheure_sortie'],
                    'dateheure_livraison'=>$value['dateheure_livraison'],
                    'dateheure_depart_site'=>$value['dateheure_depart_site'],
                    'code_client'=>$value['code_client'],
                    'raison_sociale'=>$value['raison_sociale'],
                    'num_facture'=>$value['num_facture'],
                    'ville'=>$value['ville'],
                    'adresse'=>$value['adresse'],
                    'date_livraison_prevue'=>$value['date_livraison_prevue'],
                    'slot_de_livraison'=>$value['slot_de_livraison'],
                    'date_chargement_prevue'=>$value['date_chargement_prevue'],
                    'quantite_reservee'=>$value['quantite_reservee'],
                    'qte_facturee'=>$value['qte_facturee'],
                    'propre'=>$value['propre'],
                    'date_effet'=>$value['date_effet'],
                    'date_declaration_capacite'=>$value['date_declaration_capacite'],
                    'nom_contacte'=>$value['nom_contacte'],
                    'tel_contacte'=>$value['tel_contacte'],
                    'date_creation_reservation'=>$value['date_creation_reservation'],
                    'date_validation'=>$value['date_validation']    
                ];
            }
            if(!empty($insert)){                    
                DB::table('clients')->insert($insert);
                $fichier = new Fichier();
                $fichier->path = $savePath;
                $fichier->type = 'client';
                $fichier->save();    
                return back()->with('success','Insert Record successfully.');
            }
        }
        return redirect()->route('client.index')->with('success', 'process terminé  !  ');




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
                'success' => 'camion ajouté avec succés  '
            ]);
    }
    public function filter(Request $request)
    {
        $wheres = "";
        $index = 0;
        $types = [];
        $debut_entre = "";
        $fin_entre ="";
        $matricules = [];
        $type_emballages = [];


        if($request['debut_entre']){
            $debut_entre = $request['debut_entre'];
            if($index==0){
                $wheres =$wheres." where date_reservation >= '$debut_entre' ";
                $index = 2;
            }else{
                $wheres =$wheres." and date_reservation >= '$debut_entre' ";
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
                    $wheres =$wheres."matricule_camion='$matricule' ".$operator;
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
                    $wheres =$wheres."matricule_camion='$matricule' ".$operator;
                }
                $wheres =$wheres." ) ";
            }
            $index=2;
        }
        if($request['fin_entre']){
            $fin_entre = $request['fin_entre'];
            if($index>0){
                $wheres =$wheres." and date_reservation <= '$fin_entre'";
            }else{
                $wheres =$wheres." where date_reservation <= '$fin_entre'";
                $index=2;
            }
        }

        $sql = "select * from clients as a ";
        $sql = $sql.$wheres;
        
        // $sql = $sql.' group by a.adresse,a.ville';
        
        $clients=DB::select(DB::raw($sql));
        

        // $clients = json_decode($clients,true);
        /** convert  */ 
        $filter = 1;
        $camions = DB::table('camions')
            ->select('matricule')
            ->distinct()
            ->get();

        return view('clients.index',compact('clients','filter','types','fin_entre','debut_entre','camions','matricules','type_emballages','sql'));        
    }

    public function generer(Request $request)
    {
        $wheres = "";
        $index = 0;
        $types = [];
        $debut_entre = "";
        $fin_entre ="";
        $matricules = [];
        $type_emballages = [];


        if($request['debut_entre']){
            $debut_entre = $request['debut_entre'];
            if($index==0){
                $wheres =$wheres." where date_reservation >= '$debut_entre' ";
                $index = 2;
            }else{
                $wheres =$wheres." and date_reservation >= '$debut_entre' ";
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
                    $wheres =$wheres."matricule_camion='$matricule' ".$operator;
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
                    $wheres =$wheres."matricule_camion='$matricule' ".$operator;
                }
                $wheres =$wheres." ) ";
            }
            $index=2;
        }

        if($request['fin_entre']){
            $fin_entre = $request['fin_entre'];
            if($index>0){
                $wheres =$wheres." and date_reservation <= '$fin_entre'";
            }else{
                $wheres =$wheres." where date_reservation <= '$fin_entre'";
                $index=2;
            }
        }

        $_sql = "select * from clients as a ";
        $_sql = $_sql.$wheres; 
        $ids = $_sql;

        $sql = "select a.site_de_chargement,a.type_emballage,a.adresse, a.ville,a.qte_facturee from clients as a ";
        $sql = $sql.$wheres; 
        // $sql = $sql.' group by a.adresse,a.ville';
        $clients=DB::select(DB::raw($sql));
        $filter = 1;
        $camion = Camion::where('matricule',$matricule)->first();
        $fournisseur = $camion->fournisseur;

        return view('clients.results',compact('clients','filter','type','matricule','fin_entre','debut_entre','type_emballage','ids','fournisseur'));        
    }

    public function vider()
    {   
        $sql = "delete from clients where 1=1";
        $attachements=DB::select(DB::raw($sql));
        $filter = 0;
        $type="";
        return redirect()->route('client.index')->with('success', 'process terminé  !  ');
    }

}
