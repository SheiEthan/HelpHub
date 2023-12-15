<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    use HasFactory;
    protected $table = "alerte";
    protected $primaryKey = "id_alerte";
    public $timestamps = false;


    protected $fillable =[
        "id_localisation",
        "id_association",
        'id_user',
        "id_mot_clef",
        "id_thematique"
    ];

    public function mot_clef(){
        return $this->hasOne(
            Mot_cle::class,
            'id_mot_clef',
            'id_mot_clef'
        );
    }

    public function association(){
        return $this->hasOne(
            Association::class,
            'id_association',
            'id_association'
        );
    }

    public function localisation(){
        return $this->hasOne(
            Localisation::class,
            'id_localisation',
            'id_localisation'
        );
    }

    public function thematique(){
        return $this->hasOne(
            Thematique::class,
            'id_thematique',
            'id_thematique'
        );
    }
}
