<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;
    protected $table = "don";
    protected $primaryKey = "id_don";
    public $timestamps = false;


    protected $fillable =[
        "id_information_don",
        "id_utilisateur",
        "montant"
    ];

    protected $casts = [
        "montant"=>'integer',
    ];

    public function publication_information_don(){
        return $this->hasOne(
            Publication_information_don::class,
            'id_information_don'
        );
    }

    public function utilisateur(){
        return $this->hasOne(
            Utilisateur::class,
            'id_utilisateur'
        );
    }

    public function transaction(){
        return $this->belongsTo(
            Transaction::class,
            'id_don',
            'id_don'
        );
    }
}
