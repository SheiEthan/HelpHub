<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication_information_don extends Model
{
    use HasFactory;
    protected $table = "publication_information_don";
    protected $primaryKey = "id_information_don";
    public $timestamps = false;


    protected $fillable =[
        "id_publication",
        "montant_minimum",
        "objectif" 
    ];

    protected $casts = [
        "totmontant"=>'integer',
        "objectif"=>'integer',

    ];

    public function publication(){
        return $this->hasOne(
            Publication::class,
            'id_publication'
        );
    }

    public function dons(){
        return $this->hasMany(
            Don::class,
            'id_information_don'
        );
    }
}
