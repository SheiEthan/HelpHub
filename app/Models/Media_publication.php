<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Media_publication extends Model
{
    use HasFactory;
    use HasCompositeKey;
    protected $table = "media_publication";
    protected $primaryKey =(["id_publication","id_media"]);
    public $timestamps = false;


    protected $fillable =[
        "id_publication",
        "id_media"
    ];
}
