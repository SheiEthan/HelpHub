<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrelevementBancaire extends Model
{
    use HasFactory;
    protected $table = "prelevement_banquaire";
    protected $primaryKey = "id_banque";
    public $timestamps = false;


    protected $fillable =[
        "id_paiement",
        "titulaire_compte_bancaire",
        "iban",
        
    ];



}
