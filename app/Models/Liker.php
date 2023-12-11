<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;
use Thiagoprz\EloquentCompositeKey\HasCompositePrimaryKey;

class Liker extends Model
{
    use HasFactory;
    use HasCompositeKey;
    protected $table = "liker";
    protected $primaryKey =(["id_user","id_commentaire"]);
    public $timestamps = false;


    protected $fillable =[
        "id_user",
        "id_commentaire"
    ];
}
