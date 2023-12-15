<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $table = "rapport";
    protected $primaryKey = "id_rapport";
    public $timestamps = false;


    protected $fillable =[
        "description_rapport"
    ];
}
