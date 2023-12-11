<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Thematique_publication extends Model
{
    use HasFactory;
    use HasCompositeKey;
    protected $table = "thematique_publication";
    protected $primaryKey = (["id_thematique" , "id_publication"]);
    public $timestamps = false;

    protected $fillable =[
        "id_publication",
        "id_thematique"
    ];
}
