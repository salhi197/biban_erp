<?php

namespace App\Http\Controllers;

use App\Sms;
use App\Fournisseur;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smss = Sms::all();
        return view('sms.index',compact('smss'));
    }

    public function sendView()
    {
        $smss = Sms::all();
        $fournisseurs = Fournisseur::all();
        return view('sms.send',compact('fournisseurs'));
    }

    
    public function sendGroupeView()
    {
        $smss = Sms::all();
        $fournisseurs = Fournisseur::all();
        // dd($fournisseurs);
        return view('sms.groupe-send',compact('fournisseurs'));
    }



    public function send(Request $request)
    {
        $sms = new Sms();
        $sms->contenu = $request['text'];
        $sms->numero = $request['telephone'];
        $sms->save();
        $curl = curl_init();
        $data = array(
            'username'=>'BIBAN_FRET',
            'password'=>'SMS3265',
            'type'=>'0',
            'dlr'=>'1',
            'destination'=>'213'.$request['telephone'],
            'source'=>'BIBAN_FRET',
            'message'=>$request['text'],
            'ip'=>'141.94.30.33',
        );

        $url = 'http://sms.icosnet.com:8080/bulksms/bulksms' . "?" . http_build_query($data);
        // dd($url);
        // http://sms.icosnet.com:8080/bulksms/bulksms?username=BIBAN_FRET&password=SMS3265&type=0&dlr=1&destination=213783773657&source=BIBAN%20FRET&message=hani&ip=141.94.30.33
        // http://sms.icosnet.com:8080/bulksms/bulksms?username=BIBAN_FRET&password=SMS3265&type=0&dlr=1&destination=213783773657&source=BIBAN%2520FRET&message=test&ip=141.94.30.33                
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
//          'http://sms.icosnet.com:8080/bulksms/bulksmsusername=BIBAN_FRET&password=SMS3265&type=0&dlr=1&destination=213783773657&source=BIBAN%20FRET&message=hani&ip=141.94.30.33',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        return redirect()->route('sms.index')->with('success',' SMS a été bien envoyé ');
    }



    public function sendBulk(Request $request)
    {
        foreach ($request['dynamic_form']['dynamic_form'] as $array) {
            $curl = curl_init();
            $telephone = substr($array['telephone'], 1);
            $data = array(
                'username'=>'BIBAN_FRET',
                'password'=>'SMS3265',
                'type'=>'0',
                'dlr'=>'1',
                'destination'=>$telephone,
                'source'=>'BIBAN_FRET',
                'message'=>$request['text'],
                'ip'=>'141.94.30.33',
            );
    
            $url = 'http://sms.icosnet.com:8080/bulksms/bulksms' . "?" . http_build_query($data);
            dump($url);
            // http://sms.icosnet.com:8080/bulksms/bulksms?username=BIBAN_FRET&password=SMS3265&type=0&dlr=1&destination=213783773657&source=BIBAN%20FRET&message=hani&ip=141.94.30.33
            // http://sms.icosnet.com:8080/bulksms/bulksms?username=BIBAN_FRET&password=SMS3265&type=0&dlr=1&destination=213783773657&source=BIBAN%2520FRET&message=test&ip=141.94.30.33                
    //         curl_setopt_array($curl, array(
    //           CURLOPT_URL => $url,
    // //          'http://sms.icosnet.com:8080/bulksms/bulksmsusername=BIBAN_FRET&password=SMS3265&type=0&dlr=1&destination=213783773657&source=BIBAN%20FRET&message=hani&ip=141.94.30.33',
    //           CURLOPT_RETURNTRANSFER => true,
    //           CURLOPT_ENCODING => '',
    //           CURLOPT_MAXREDIRS => 10,
    //           CURLOPT_TIMEOUT => 0,
    //           CURLOPT_FOLLOWLOCATION => true,
    //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //           CURLOPT_CUSTOMREQUEST => 'GET',
    //         ));
        }
        dd('sa');

    }


}
