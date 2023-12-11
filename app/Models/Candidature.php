<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Candidature extends Model
{
    use HasFactory;
    use HasCompositeKey;
    protected $table = "candidature";
    protected $primaryKey =(["id_utilisateur","id_recherche_benevole"]);
    public $timestamps = false;


    protected $fillable =[
        "id_utilisateur",
        "id_recherche_benevole",
        "statut_candidature",
        "retour_utilisateur",
        "heures",
        "information_suplementaire"
    ];




    public function publication(){
        return $this->hasOne(
            Publication::class,
            'id_publication',
            'id_publication'
        );
    }

    public function publication_recherche_benevole(){
        return $this->hasOne(
            Publication_recherche_benevole::class,
            'id_recherche_benevole',
            'id_recherche_benevole'

        );
    }

    public function utilisateur(){
        return $this->belongsTo(
            Utilisateur::class,
            'id_utilisateur',
            'id_utilisateur'
        );
    }

   
}
