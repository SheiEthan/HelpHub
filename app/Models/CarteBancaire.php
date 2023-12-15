<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarteBancaire extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = "carte_bancaire";
    protected $primaryKey = "id_cartebancaire";
    public $timestamps = false;


    protected $fillable =[
        "id_paiement",
        "nom_du_detenteur",
        "numero_carte_bancaire",
        "date_expiration",
        'cvc'
    ];

    public function informationPaiement(){
        return $this->hasOne(
            InformationPaiement::class,
            'id_cartebancaire',
            'id_cartebancaire'
        );
    }
}
