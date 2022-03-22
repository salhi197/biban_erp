<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'montant',
        'facture',
        'type',
        'remarque',
        'date_payment'
    ];
}
