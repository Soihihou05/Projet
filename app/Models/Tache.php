<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'statut',
        'date_echeance',
    ];
}
