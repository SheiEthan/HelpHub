<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localisation extends Model
{
    use HasFactory;

    protected $table = "localisation";
    protected $primaryKey = "id_localisation";
    public $timestamps = false;
    

    protected $fillable =[
        "pays",
        "ville",
        "code_postal"
    ];
}
