<?php

namespace App\Http\Controllers;


use App\Models\Thematique;
use App\Models\Publication;
use Illuminate\Http\Request;

class ThematiqueController extends Controller
{
    // pour recuperer les thematiques
    public function getThematique()
    {
        $thematiques = Thematique::all();

        return ['thematiques' => $thematiques];
    }

    // pour recuperer les 3 dernier action poste  


    /*
    public function showThematique(Request $request)
    {
        $selectedThematiqueId = $request->input('thematique');
        $selectedThematique = Thematique::find($selectedThematiqueId);

        // Vous pouvez maintenant utiliser $selectedThematique pour afficher les détails ou effectuer d'autres actions

        return view('showThematique', ['thematique' => $selectedThematique]);
    }
    */

}
