<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $table = "commentaire";
    protected $primaryKey = "id_commentaire";
    public $timestamps = false;


    protected $fillable =[
        "id_user",
        "id_publication",
        "description_commentaire",
        "nblikes",
        "nbsignals"
    ];

    public function publication(){
        return $this->hasOne(
            Publication::class,
            'id_publication'

        );
    }

    public function user(){
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'

        );
    }

    public function likes(){
        return $this->hasMany(
            Liker::class,
            'id_commentaire'
        );
    }

    public function signals(){
        return $this->hasMany(
            Signaler::class,
            'id_commentaire'
        );
    }
}
