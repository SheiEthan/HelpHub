<?php

namespace App\Http\Controllers;

use App\Models\CarteBancaire;
use App\Models\InformationPaiement;
use App\Models\Localisation;
use Illuminate\Http\Request;

class InfoBancaireController extends Controller
{
    

    public function getinfo()
    {
        $informations = InformationPaiement::all();
        return view('MesinfoBancaire', ['informations' => $informations]);
    }


}
