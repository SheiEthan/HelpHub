<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $table = "contrat";
    protected $primaryKey = "id_contrat";
    public $timestamps = false;


    protected $fillable =[
        "id_association",
        "etat_signe",
        "date_signe",
        "iban"
        
    ];
}
