<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Liker_publi extends Model
{
    use HasFactory;
    use HasCompositeKey;
    protected $table = "liker_publi";
    protected $primaryKey =(["id_user","id_publication"]);
    public $timestamps = false;


    protected $fillable =[
        "id_user",
        "id_publication"
    ];

    public function publication(){
        return $this->hasOne(
            Publication::class,
            'id_publication',
            'id_publication'
        );
    }
}
