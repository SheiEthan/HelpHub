<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequence extends Model
{
    use HasFactory;

    protected $table = "frequence";
    protected $primaryKey = "id_frequence";
    public $timestamps = false;


    protected $fillable =[
        "id_recherche_benevole",
        "duree",
        "jour",
        "plage_horraire"
    ];
}
