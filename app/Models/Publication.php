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
        "etat_publication",
        "nblikes",
        "totmontant",
        "benevoles"
    ];

    protected $casts = [
        "date_debut"=>'date',
        "date_fin"=>'date',
        "date_saisi"=>'date'
    ];

    public function thematiques(){
        return $this->belongsToMany(
            Thematique::class,
            'thematique_publication',
            'id_publication',
            'id_thematique'
        );
    }

    public function association(){
        return $this->hasOne(
            Association::class,
            'id_association'
        );
    }

    public function localisation(){
        return $this->belongsTo(
            Localisation::class,
            'id_localisation'
        );
    }

    public function medias(){
        return $this->belongsToMany(
            Media::class,
            'media_publication',
            'id_publication',
            'id_media'
        );
    }

    public function rapports(){
        return $this->belongsToMany(
            Rapport::class,
            'publication_rapport',
            'id_publication',
            'id_rapport'
        );
    }

    public function mot_clefs(){
        return $this->belongsToMany(
            Mot_cle::class,
            'mot_cle_publication',
            'id_publication',
            'id_mot_clef'
        );
    }

    public function commentaires(){
        return $this->hasMany(
            Commentaire::class,
            'id_publication'
        );
    }

    public function information_don(){
        return $this->hasMany(
            Publication_information_don::class,
            'id_publication'
        );
    }

    public function recherche_benevole(){
        return $this->hasMany(
            Publication_recherche_benevole::class,
            'id_publication'
        );
    }

    public function likes(){
        return $this->hasMany(
            Liker_publi::class,
            'id_publication'
        );
    }

}
