<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $table = "compte";
    protected $primaryKey = "id_compte";
    public $timestamps = false;


    protected $fillable =[
        "mail_compte",
        "motdepasse_compte"
    ];
}
