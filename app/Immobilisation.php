<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Immobilisation extends Model
{
public $fillable = [
    'mois_de_la_prestation',
    'date_facture',
    'reservation',
    'mission',
    'produit',
    'camion',
    'chauffeur',
    'code_client',
    'raison_sociale',
    'ville',
    'wilaya',
    'categorie',
    'somme_de_qte_facturee',
    'somme_de_cout',
    'type'
    ];
}
 