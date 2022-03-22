<?php

namespace App;
use DB;
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
        'etat',
        'gps',        
        'reste',
        'adress'

    ];

    public static function template($facture) {
        $items= Item::where('facture',$facture->id)->get();
        $sql = $facture->attachements;
        $attachements=DB::select(DB::raw($sql));

        $html = '<!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Facture </title>
        <style type="text/css">
        @page { margin: 100px 25px; }
        header { position: fixed; top: -50px; left: 0px; right: 0px; height: 70px; }
        footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    
            * {
                font-family: Verdana, Arial, sans-serif;
            }

            div.page_break + div.page_break{
                page-break-before: always;
            }
            
            table,tbody{
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
        <header>
            <table width="100%" >
                <tr>
                    <td valign="top"></td>
                    <td align="center">
                        <h3>Auxiliaire de transport routier de marchandises .<br>Lotissement 324 n* 1Rue O B.B.Arreridj <br>Tél:0661944781-0561709265</h3>
                            Fax:035740082 <br>
                            bibanfretcompany@gmail.com<br>
                            Capital Social :2 000 000 DA<br>
                            Auxiliare de transport Routier<br>
                            Agrément n* 50/2017 du Ministre de transport <br>   
                    </td>
                    <td align="right">
                    </td>
                </tr>
                </table>

        </header>
        <main>              
        
          <table width="100%" style="margin-top:140px";>
            <tr>
                <td >
                    B.B.A Le:   
                    <br>'.$facture->type_emballage.' <br>Raison Sociale : '.$facture->raison.'<br>Adress:'.$facture->adress.'
                    <br>
                    Registre de commerce :'.$facture->registre.'<br>
                    Identifiant Fiscale:'.$facture->i_f.'<br>
                    NIS:'.$facture->nis.'<br>
                    AI :'.$facture->ai.'
                </td>
                <td><strong>Numero:</strong> '.$facture->numero_facture.'</td>

            </tr>
        
          </table>
        
          <br/>
        
          <table width="100%" style="margin-top:100px;">
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
                    <td align="right">
                        '.$item->quantite.'
                    </td>
                    <td align="right">
                    '.$item->rotations.'
                    </td>
                    <td align="right">
                    '.$item->prix.'
                    </td>

                    <td align="right">
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
                    <td align="right">Assurance </td>
                    <td align="right">'.$facture->assurance.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">gaz </td>
                    <td align="right">'.$facture->gaz.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">gps </td>
                    <td align="right">'.$facture->gps.'</td>
                </tr>
                ';
            }else{
            $html.='                 
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Total HT </td>
                    <td align="right">'.$total.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">TVA 19% </td>
                    <td align="right">'.$facture->tva.'</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Total </td>
                    <td align="right">'.((float)$total + (float)$facture->tva).'</td>
                </tr>';
            }
            $html.='</tfoot>
          </table>
        
          <div class="page-break"></div>


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
                    
                    <td>
                        '.$attachement->date_facture.'
                    </td>
                    <td align="right">
                        '.$attachement->mission.'
                    </td>
                    <td align="right">
                    '.$attachement->ville.'
                    </td>
                    <td align="right">
                    '.$attachement->wilaya.'
                    </td>

                    <td align="right">
                    '.$attachement->somme_de_qte_facturee.'
                    </td>
                </tr>';

            }

        $html.='</tbody></table></main></body></html>';
          

        return $html;

    }


}
