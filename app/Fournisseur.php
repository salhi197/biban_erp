<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
   public $fillable = [
    'nom',
    'prenom',
    'telephone',
    'rib',
    'adress',
    ];
    public function matricules()
    {
        return Camion::where('fournisseur',$this->id)->get();
    }

    public function papiers()
    {
        return Camion::where('fournisseur',$this->id)->get();
    }


}
 