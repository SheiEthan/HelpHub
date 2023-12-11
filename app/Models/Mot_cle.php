<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mot_cle extends Model
{
    use HasFactory;
    protected $table = "mot_cle";
    protected $primaryKey = "id_mot_clef";
    public $timestamps = false;


    protected $fillable =[
        "mot_clef"
    ];
}
