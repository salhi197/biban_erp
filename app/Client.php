<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   public $fillable = [
    'etat',
    'motif',
    'nom_chauffeur',
    'matricule_camion',
    'matricule_remorque',
    'site_de_chargement',
    'date_reservation',
    'num_reservation',
    'code_reservation',
    'etat_reservation',
    'type_emballage',
    'code_produit',
    'code_slot',
    'date_permis',
    'transporteur',
    'num_mission',
    'dateheure_permis',
    'dateheure_entree',
    'dateheure_sortie',
    'dateheure_livraison',
    'dateheure_depart_site',
    'code_client',
    'raison_sociale',
    'num_facture',
    'ville',
    'adresse',
    'date_livraison_prevue',
    'slot_de_livraison',
    'date_chargement_prevue',
    'quantite_reservee',
    'qte_facturee',
    'propre',
    'date_effet',
    'date_declaration_capacite',
    'nom_contacte',
    'tel_contacte',
    'date_creation_reservation',
    'date_validation',   
    'fichier'

   ];
}
 