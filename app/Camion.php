<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    protected $fillable = [
        'matricule',
        'nom_contacte',
        'telephone',
        'adress',
        'ville',
        'debut',
        'fournisseur',
        'numero',
        'carte_grise',
        'permis'
    
    ];
    public function fournisseur()
    {
        return Fournisseur::find($this->fournisseur);
    }
}
