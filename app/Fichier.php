<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    protected $fillable = [
        'path',
        'type',
    ];
}
