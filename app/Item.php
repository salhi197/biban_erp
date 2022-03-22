<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'designation',
        'quantite',
        'rotations',
        'prix',
        'total',
        'facture'
    ];
}
