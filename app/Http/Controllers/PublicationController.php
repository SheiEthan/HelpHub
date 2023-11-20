<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    
    // afficher les actions pa rapport au thematique  
    public function afficherResultats(Request $request)
    {
        // Récupérez les données du formulaire
        $thematiqueId = $request->input('thematique');
        // Récupérez les actions associées à la thématique sélectionnée
        $publications = Publication::where('id_thematique', $thematiqueId)->get();

        return view('rechercher', ['publications' => $publications]);
    }

}
