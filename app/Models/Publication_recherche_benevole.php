<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication_recherche_benevole extends Model
{
    use HasFactory;

    protected $table = "publication_recherche_benevole";
    protected $primaryKey = "id_recherche_benevole";
    public $timestamps = false;


    protected $fillable =[
        "id_publication",
        "type_presence",
        "mission_distance",
        "mission_presentiel"
    ];

    public function publication(){
        return $this->hasOne(
            Publication::class,
            'id_publication',
            'id_publication'

        );
    }

    public function candidatures(){
        return $this->hasMany(
            Candidature::class,
            'id_recherche_benevole'
        );
    }

    public function frequence(){
        return $this->hasMany(
            Frequence::class,
            'id_recherche_benevole'
        );
    }

    public function planifier(){
        return $this->hasMany(
            Planifier::class,
            'id_recherche_benevole'
        );
    }
}
