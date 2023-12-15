<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationPaiement extends Model
{
    use HasFactory;
    protected $table = "information_paiement";
    protected $primaryKey = "id_paiement";
    public $timestamps = false;


    protected $fillable =[
        "id_utilisateur"
    ];

    public function carteBancaire(){
        return $this->hasMany(
            CarteBancaire::class,
            'id_paiement',
            'id_paiement'
         
        );
    }

    
}
