<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey ;


class Signaler extends Model
{
    use HasFactory;
    use HasCompositeKey;
    protected $table = "signaler";
    protected $primaryKey =(["id_user","id_commentaire"]);
    public $timestamps = false;


    protected $fillable =[
        "id_user",
        "id_commentaire"
    ];

    public function commentaire(){
        return $this->hasOne(
            Commentaire::class,
            'id_commentaire',
            'id_commentaire'
        );
    }
}
