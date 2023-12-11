<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $table = "association";
    protected $primaryKey = "id_association";
    public $timestamps = false;


    protected $fillable =[
        "id_user",
        "nom_association",
        "siteweb_association",
        "description_association",
        "numerotelephone_association"

    ];

    public function publications(){
        return $this->hasMany(Publication::class, "id_association");
    }
}
