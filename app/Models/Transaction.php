<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transaction";
    protected $primaryKey = "id_transaction";
    public $timestamps = false;


    protected $fillable =[
        "id_don",
        "conserver_informations",
        "date_transaction",
        "type_transaction"
    ];

    protected $casts = [
        "date_transaction"=>'date'
    ];

    public function don(){
        return $this->hasOne(
            Don::class,
            'id_don'
        );
    }

}
