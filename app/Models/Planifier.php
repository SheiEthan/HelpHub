<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planifier extends Model
{
    use HasFactory;

    protected $table = "planifier";
    protected $primaryKey = "id_planifie";
    public $timestamps = false;


    protected $fillable =[
        "id_recherche_benevole",
        "datepl",
        "heure_debut",
        "heure_fin"
    ];

    protected $casts = [
        "datepl"=>'date',
        "heure_debut"=>'date:H',
        "heure_fin"=>'date:H',

    ];
}
