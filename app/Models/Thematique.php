<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thematique extends Model
{
    use HasFactory;

    protected $table = "thematique";
    protected $primaryKey = "id_thematique";
    public $timestamps = false;
    

    protected $fillable =[
        "titre_thematique"
    ];

    public function publications(){
        return $this->belongsToMany(
            Publication::class,
            'thematique_publication',
            'id_thematique',
            'id_publication');
    }
}
