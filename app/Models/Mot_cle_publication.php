<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Mot_cle_publication extends Model
{
    use HasFactory;
    use HasCompositeKey;
    protected $table = "mot_cle_publication";
    protected $primaryKey =(["id_mot_clef","id_publication"]);
    public $timestamps = false;


    protected $fillable =[
        "id_publication",
        "id_mot_clef"
    ];
}
