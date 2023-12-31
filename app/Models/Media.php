<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = "media";
    protected $primaryKey = "id_media";
    public $timestamps = false;


    protected $fillable =[
        "titre_media",
        "lien_media",
        "type_media"
    ];
}
