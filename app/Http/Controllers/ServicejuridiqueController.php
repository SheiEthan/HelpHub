<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;

class ServicejuridiqueController extends Controller
{
    

    public function GetCandidatureJuridique() 
    {
        $candidatures = Candidature::where('statut_candidature' , '4')->get();

        return view('servicejuridique', ['candidatures' => $candidatures]);
    }

    public function refuserCandidatureJuridique($id,$id2) 
    {
        $candidatures= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)->get();
        foreach($candidatures as $candidature){
        $candidature->statut_candidature=2;
        $candidature->save();
        }
        return redirect("/servicejuridique");
        
    }

    public function validerCandidatureJuridique($id,$id2) 
    {
        $candidatures= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)->get();
        foreach($candidatures as $candidature){
        $candidature->statut_candidature=1;
        $candidature->save();
        }
        return redirect("/servicejuridique");
    }
}
