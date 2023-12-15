<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = "utilisateur";
    protected $primaryKey = "id_utilisateur";
    public $timestamps = false;


    protected $fillable =[
        "id_localisation",
        "id_user",
        "nom_utilisateur",
        "prenom_utilisateur",
        "pseudo_utilisateur",
        "numero_telephone_utilisateur"
    ];

    protected $casts=[ 
        "id_user" => "integer",
        "id_localisation" => "integer"
    ];

    
    public function dons(){
        return $this->hasMany(
            Don::class,
            'id_utilisateur'
        );
    }

    public function candidatures(){
        return $this->hasMany(
            Candidature::class,
            'id_utilisateur'
        );
    }

    public function user(){
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }
}
