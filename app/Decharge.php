<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decharge extends Model
{
    protected $fillable = [
        'montant',
        'designation',
        'remarque',
        'date_decharge'
    ];
}
