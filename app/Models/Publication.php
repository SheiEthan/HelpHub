<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = "publication";
    protected $primaryKey = "id_publication";
    public $timestamps = false;


    protected $fillable =[
        "id_localisation",
        "date_debut",
        "date_fin",
        "id_association",
        "titre_publication",
        "resume",
        "description_publication",
        "date_saisi",
        "etat_publication"
    ];


}
