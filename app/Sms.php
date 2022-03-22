<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = [
        'contenu',
        'numero',
        'fournisseur'
    ];
    protected $table="smss";
    public static function send($matricule_camion)
    {
        $camion = Camion::where('matricule',$matricule_camion)->first();
        if (!$camion) {
            $c = new Camion();
            $c->matricule = $matricule_camion;
            $c->save();
            return 0;             
        }
        $f = $camion->fournisseur;
        if($f){
            $fournisseur = Fournisseur::where('fournisseur',$camion->fournisseur)->first();
            $telephone = $fournisseur->telephone;
            $telephone = substr($telephone, 1);

            $data1 = [            
                'action'=>'send-sms',
                'api_key'=>'TyJdYcN1rIyLhYJDOYMq4HkvMQuvy43ID4QqLKvhuZM6KYog5ZGycNreAOIwpiMJ',
                'to'=>'+213'.$telephone,
                'sms'=>'le camion avec le matricule : '.$matricule_camion.' est on service '            
            ];
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://sms-01.oksweb.com/api/v1/sms",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data1),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
                return -1;//redirect()->route('sms.index')->with('error', 'error  !  ');
            } else {
                return 1;//redirect()->route('sms.index')->with('success', 'message envoyé  !  ');
            }
        }else{
            return 0;                         
        }

    }
}
