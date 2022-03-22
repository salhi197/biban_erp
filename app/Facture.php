<?php

namespace App;
use DB;
use App\Fournisseur;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'total',
        'tva',
        'type_emballage',
        'totalht',
        'type',
        'state',
        '_type',
        'raison',
        'camion',
        'attachments',
        'numero_facture',
        'registre',
        'i_f',
        'nis',
        'ai',        
        'assurance',
        'gaz',
        'fournisseur',
        'etat',
        'gps',        
        'reste',
        'adress'

    ];
    public function getFournisseur()
    {
        $fournisseur = Fournisseur::find($this->fournisseur);
        return $fournisseur;
    }

    public static function template($facture) {
        $items= Item::where('facture',$facture->id)->get();
        $sql = $facture->attachements;
        $current = date('Y-m-d');
        $attachements=DB::select(DB::raw($sql));

        $html = '<!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Facture </title>
        <style type="text/css">
            * {
                font-size:13px;
                font-family: Verdana, Arial, sans-serif;
            }

            div.page_break + div.page_break{
                page-break-before: always;
            }
            
            table{
            }
            tfoot tr td{
                font-weight: bold;
            }
            .attachments td{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
            .attachments th{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
        
            .gray {
                background-color: lightgray
            }
            .page-break {
                page-break-after: always;
           }               
        </style>
        
        </head>
        <body>
        
          <table width="100%">
            <tr>
                <td align="left" style="border:1px solid gray;padding:10px;">
                    <h3>Auxiliaire de Transport Routier de Marchandises .<br>Lotissement 324 N°1 Rue O B.B.Arreridj <br>Tél:0661944781-0561709265</h3>
                        Fax:035740082 <br>
                        bibanfretcompany@gmail.com<br>
                        Capital Social :2 000 000 DA<br>
                        Auxiliare de Transport Routier<br>
                        Agrément N°50/2017 du Ministre de transport 
                    <br>   
                </td>

                <td align="center"><img src="'.asset('img/logo-biban.png').'" width="250px"/></td>
    
            </tr>
        
          </table>
        
          <table width="100%">
            <tr>
            <td style="" ><strong style="border:1px solid gray;padding:30px;">Facture N°:'.$facture->numero_facture.'</strong> </td>
            <td><strong style="color:white;">Facture </strong></td>
            <td><strong style="color:white;">Facture </strong></td>
            <td><strong style="color:white;">Facture </strong></td>
            <td style="border:1px solid gray;padding:10px;" align="left">
                    B.B.A Le:   '.$current.'
                    <br>'.$facture->type_emballage.' <br>Raison Sociale : '.$facture->raison.'<br>Adress:'.$facture->adress.'
                    <br>
                    Registre de commerce :'.$facture->registre.'<br>
                    Identifiant Fiscale:'.$facture->i_f.'<br>
                    NIS:'.$facture->nis.'<br>
                    AI :'.$facture->ai.'
                </td>
            </tr>
        
          </table>
        
          <br/>
        
          <table width="100%" >
            <thead style="background-color: lightgray;">
              <tr>
                <th>N</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Rotations</th>
                <th>Prix HT</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>';

            $total = 0;
            foreach($items as $key=>$item){
                    $index = $key +1;
                    $html.='<tr class="item">
                    <th scope="row">
                        '.$index.'
                    </th>
                    
                    <td>
                        '.$item->designation.'
                    </td>
                    <td align="center">
                        '.$item->quantite.'
                    </td>
                    <td align="center">
                    '.$item->rotations.'
                    </td>
                    <td align="center">
                    '.$item->prix.'
                    </td>

                    <td align="center">
                    '.$item->prix*$item->quantite.'
                    </td>
                </tr>';
                $total +=$item->prix*$item->quantite;

            }

        $html.='
            </tbody>
            <tfoot>';
            if($facture->type == 'camion'){
                $total +=$facture->assurance + $facture->gaz + $facture->gps;

                $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Assurance </td>
                    <td align="center">'.$facture->assurance.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gaz </td>
                    <td align="center">'.$facture->gaz.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gps </td>
                    <td align="center">'.$facture->gps.'</td>
                </tr>
                ';
            }else{
            $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total HT </td>
                    <td align="center">'.$total.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">TVA 19% </td>
                    <td align="center">'.$facture->tva.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total </td>
                    <td align="center">'.((float)$total + (float)$facture->tva).'</td>
                </tr>';
            }
            $html.='</tfoot>
          </table>
        
          <div class="page-break"></div>
          <table class="attachments" width="100%">
            <tr>
                <td align="center">
                    <h3>Auxiliaire de transport routier de marchandises .<br>Lotissement 324 n* 1Rue O B.B.Arreridj <br>Tél:0661944781-0561709265</h3>
                        Attachement n 50/09 de la facture '.$facture->numero_facture.'<br>
                        '.$facture->type_emballage.'<br>
                </td>
            </tr>
        
          </table>


          <table width="100%" class="page-break">
            <thead style="background-color: lightgray;">
              <tr>
                <th>N°</th>
                <th>Date</th>
                <th>N° FDR</th>
                <th>Ville</th>
                <th>Wilaya</th>
                <th>Quantité</th>
              </tr>
            </thead>
            <tbody>';
            foreach($attachements as $key=>$attachement){
                    $index = $key +1;
                    $html.='<tr class="item">
                    <th scope="row">
                        '.$index.'
                    </th>
                    
                    <td align="center">
                        '.$attachement->date_facture.'
                    </td>
                    <td align="center">
                        '.$attachement->mission.'
                    </td>
                    <td align="center">
                    '.$attachement->ville.'
                    </td>
                    <td align="center">
                    '.$attachement->wilaya.'
                    </td>

                    <td align="center">
                    '.$attachement->somme_de_qte_facturee.'
                    </td>
                </tr>';

            }

        $html.='</tbody></table></body></html>';
          

        return $html;

    }

    public static function template2($facture) {
        $items= Item::where('facture',$facture->id)->get();
        $sql = $facture->attachements;
        $current = date('Y-m-d');
        $attachements=DB::select(DB::raw($sql));
        $fournisseur = Fournisseur::find($facture->fournisseur);
        $html = '<!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Facture </title>
        <style type="text/css">
            * {
                font-size:13px;
                font-family: Verdana, Arial, sans-serif;
            }

            div.page_break + div.page_break{
                page-break-before: always;
            }
            
            table{
            }
            tfoot tr td{
                font-weight: bold;
            }
            .attachments td{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
            .attachments th{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
        
            .gray {
                background-color: lightgray
            }
            .page-break {
                page-break-after: always;
           }               
        </style>
        
        </head>
        <body>
        
          <table width="100%">
            <tr>
                <td align="left" style="border:1px solid gray;padding:10px;">
                    <h3>Auxiliaire de Transport Routier de Marchandises .<br>Lotissement 324 N°1 Rue O B.B.Arreridj <br>Tél:0661944781-0561709265</h3>
                        Fax:035740082 <br>
                        bibanfretcompany@gmail.com<br>
                        Capital Social :2 000 000 DA<br>
                        Auxiliare de Transport Routier<br>
                        Agrément N°50/2017 du Ministre de transport 
                    <br>   
                </td>
                <td align="right"><img src="'.asset('img/logo-biban.png').'" width="250px"/></td>
    
            </tr>
        
          </table>
        
          <table width="100%">
            <tr>
            <td style="" ><strong style="border:1px solid gray;padding:30px;">Facture N°:'.$facture->numero_facture.'</strong> </td>
            <td><strong style="color:white;">Facture </strong></td>
            <td><strong style="color:white;">Facture </strong></td>
            <td><strong style="color:white;">Facture </strong></td>
            <td style="border:1px solid gray;padding:10px;" align="left">
                    B.B.A Le:   '.$current.'<br>Client : '.($fournisseur->nom ?? '').'<br>Adress:'.($fournisseur->prenom ?? '').'
                    <br>
                    Registre de commerce :'.($fournisseur->prenom ?? '').'<br>
                    Identifiant Fiscale:'.($fournisseur->i_f ?? '').'<br>
                    NIS:'.($fournisseur->nis ?? '').'<br>
                    AI :'.($fournisseur->ai ?? '').'
                </td>
            </tr>
    
          </table>
        
          <br/>
        
          <table width="100%" >
            <thead style="background-color: lightgray;">
              <tr>
                <th>N</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Rotations</th>
                <th>Prix HT</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>';

            $total = 0;
            foreach($items as $key=>$item){
                    $index = $key +1;
                    $html.='<tr class="item">
                    <th scope="row">
                        '.$index.'
                    </th>
                    
                    <td>
                        '.$item->designation.'
                    </td>
                    <td align="center">
                        '.$item->quantite.'
                    </td>
                    <td align="center">
                    '.$item->rotations.'
                    </td>
                    <td align="center">
                    '.$item->prix.'
                    </td>

                    <td align="center">
                    '.$item->prix*$item->quantite.'
                    </td>
                </tr>';
                $total +=$item->prix*$item->quantite;

            }

        $html.='
            </tbody>
            <tfoot>';
            if($facture->type == 'camion'){
                $sousTotal =$total;
                $total = $total-$facture->assurance - $facture->gaz - $facture->gps;

                $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Sous Total</td>
                    <td align="center">'.$sousTotal.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center"><hr style="color:#f5faf6;"></td>
                    <td align="center"><hr style="color:#f5faf6;"></td>
                </tr>
                
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Assurance </td>
                    <td align="center">'.$facture->assurance.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gaz </td>
                    <td align="center">'.$facture->gaz.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gps </td>
                    <td align="center">'.$facture->gps.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total</td>
                    <td align="center">'.$total.'</td>
                </tr>

                ';
            }else{
            $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total HT </td>
                    <td align="center">'.$total.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">TVA 19% </td>
                    <td align="center">'.$facture->tva.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total </td>
                    <td align="center">'.((float)$total + (float)$facture->tva).'</td>
                </tr>';
            }
            $html.='</tfoot>
          </table>
        
          <div class="page-break"></div>
          <table class="attachments" width="100%">
            <tr>
                <td align="center">
                    <h3>Auxiliaire de transport routier de marchandises .<br>Lotissement 324 n* 1Rue O B.B.Arreridj <br>Tél:0661944781-0561709265</h3>
                        Attachement n 50/09 de la facture '.$facture->numero_facture.'<br>
                        '.$facture->type_emballage.'<br>
                </td>
            </tr>
        
          </table>

          <table width="100%" class="page-break">
            <thead style="background-color: lightgray;">
              <tr>
                <th class="border-bottom-0">N FDR</th>
                <th class="border-bottom-0">N FDR</th>
                <th class="border-bottom-0">Matricule</th>
                <th class="border-bottom-0">Chauffeur</th>
                <th class="border-bottom-0">Date </th>
                <th class="border-bottom-0">Type </th>
                <th class="border-bottom-0">Site_charge</th>
                <th class="border-bottom-0">Site_charge</th>
                <th class="border-bottom-0">Quantité</th>
              </tr>
            </thead>
            <tbody>';
            foreach($attachements as $key=>$attachement){
                    $index = $key +1;
                    $html.='<tr class="item">
                    <th scope="row">
                        '.$index.'
                    </th>                    
                    <td>'.$attachement->num_mission.'</td>
                    <td>'.$attachement->matricule_camion.'</td>
                    <td>'.$attachement->nom_chauffeur.'</td>
                    <td>'.$attachement->date_reservation.'</td>
                    <td>'.$attachement->type_emballage.'</td>
                    <td>'.$attachement->site_de_chargement.'</td>
                    <td>'.$attachement->ville.' '.$attachement->adresse.'</td>
                    <td>'.$attachement->qte_facturee.'</td></tr>';

            }

        $html.='</tbody></table></body></html>';


          

        return $html;

    }


    public static function template3($facture) {
        $items= Item::where('facture',$facture->id)->get();
        $sql = $facture->attachements;
        $current = date('Y-m-d');
        $attachements=DB::select(DB::raw($sql));

        $html = '<!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Facture </title>
        <style type="text/css">
            * {
                font-size:13px;
                font-family: Verdana, Arial, sans-serif;
            }

            div.page_break + div.page_break{
                page-break-before: always;
            }
            
            table{
            }
            tfoot tr td{
                font-weight: bold;
            }
            .attachments td{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
            .attachments th{
                border:0.5px solid gray;
                box-sizing:border-box;
            }
        
            .gray {
                background-color: lightgray
            }
            .page-break {
                page-break-after: always;
           }               
        </style>
        
        </head>
        <body>
        
          <table width="100%">
            <tr>
                <td align="left" style="border:1px solid gray;padding:10px;">
                    <h3>Auxiliaire de Transport Routier de Marchandises .<br>Lotissement 324 N°1 Rue O B.B.Arreridj <br>Tél:0661944781-0561709265</h3>
                        Fax:035740082 <br>
                        bibanfretcompany@gmail.com<br>
                        Capital Social :2 000 000 DA<br>
                        Auxiliare de Transport Routier<br>
                        Agrément N°50/2017 du Ministre de transport 
                    <br>   
                </td>

                <td align="center"><img src="'.asset('img/logo-biban.png').'" width="250px"/></td>
    
            </tr>
        
          </table>
        
          <table width="100%">
            <tr>
            <td style="" ><strong style="border:1px solid gray;padding:30px;">Facture N°:'.$facture->numero_facture.'</strong> </td>
            <td><strong style="color:white;">Facture </strong></td>
            <td><strong style="color:white;">Facture </strong></td>
            <td><strong style="color:white;">Facture </strong></td>
            <td style="border:1px solid gray;padding:10px;" align="left">
                    B.B.A Le:   '.$current.'
                    <br>'.$facture->type_emballage.' <br>Raison Sociale : '.$facture->raison.'<br>Adress:'.$facture->adress.'
                    <br>
                    Registre de commerce :'.$facture->registre.'<br>
                    Identifiant Fiscale:'.$facture->i_f.'<br>
                    NIS:'.$facture->nis.'<br>
                    AI :'.$facture->ai.'
                </td>
            </tr>
        
          </table>
        
          <br/>
        
          <table width="100%" >
            <thead style="background-color: lightgray;">
              <tr>
                <th>N</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Rotations</th>
                <th>Prix HT</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>';

            $total = 0;
            foreach($items as $key=>$item){
                    $index = $key +1;
                    $html.='<tr class="item">
                    <th scope="row">
                        '.$index.'
                    </th>
                    
                    <td>
                        '.$item->designation.'
                    </td>
                    <td align="center">
                        '.$item->quantite.'
                    </td>
                    <td align="center">
                    '.$item->rotations.'
                    </td>
                    <td align="center">
                    '.$item->prix.'
                    </td>

                    <td align="center">
                    '.$item->prix*$item->quantite.'
                    </td>
                </tr>';
                $total +=$item->prix*$item->quantite;

            }

        $html.='
            </tbody>
            <tfoot>';
            if($facture->type == 'camion'){
                $sousTotal =$total;
                $total = $total-$facture->assurance - $facture->gaz - $facture->gps;

                $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Sous Total</td>
                    <td align="center">'.$sousTotal.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center"><hr style="color:#f5faf6;"></td>
                    <td align="center"><hr style="color:#f5faf6;"></td>
                </tr>
                
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Assurance </td>
                    <td align="center">'.$facture->assurance.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gaz </td>
                    <td align="center">'.$facture->gaz.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">gps </td>
                    <td align="center">'.$facture->gps.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total</td>
                    <td align="center">'.$total.'</td>
                </tr>


                ';
            }else{
            $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total HT </td>
                    <td align="center">'.$total.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">TVA 19% </td>
                    <td align="center">'.$facture->tva.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="center">Total </td>
                    <td align="center">'.((float)$total + (float)$facture->tva).'</td>
                </tr>';
            }
            $html.='</tfoot>
          </table>
        
          <div class="page-break"></div>
          <table class="attachments" width="100%">
            <tr>
                <td align="center">
                    <h3>Auxiliaire de transport routier de marchandises .<br>Lotissement 324 n* 1Rue O B.B.Arreridj <br>Tél:0661944781-0561709265</h3>
                        Attachement n 50/09 de la facture '.$facture->numero_facture.'<br>
                        '.$facture->type_emballage.'<br>
                </td>
            </tr>
        
          </table>


          <table width="100%" class="page-break">
            <thead style="background-color: lightgray;">
              <tr>
                <th>N°</th>
                <th>Date</th>
                <th>N° FDR</th>
                <th>Ville</th>
                <th>Wilaya</th>
                <th>Quantité</th>
              </tr>
            </thead>
            <tbody>';
            foreach($attachements as $key=>$attachement){
                    $index = $key +1;
                    $html.='<tr class="item">
                    <th scope="row">
                        '.$index.'
                    </th>
                    
                    <td align="center">
                        '.$attachement->date_facture.'
                    </td>
                    <td align="center">
                        '.$attachement->mission.'
                    </td>
                    <td align="center">
                    '.$attachement->ville.'
                    </td>
                    <td align="center">
                    '.$attachement->wilaya.'
                    </td>

                    <td align="center">
                    '.$attachement->somme_de_qte_facturee.'
                    </td>
                </tr>';

            }

        $html.='</tbody></table></body></html>';
          

        return $html;

    }


}
