<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Publication;
use App\Models\Publication_recherche_benevole;
use Illuminate\Http\Request;


class ServicebenevoleController extends Controller
{
    
    public function getCandidature() 
    {
      $candidatures = Candidature::where('statut_candidature' , '0')->get();

      return view('servicebenevolat', ['candidatures' => $candidatures]);

    }


    public function validerCandidature($id,$id2) 
    {
        $candidature= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)
        ->first();
        $candidature->statut_candidature=1;
        $candidature->save();

        return redirect("/servicebenevolat");
    }

    public function refuserCandidature($id,$id2) 
    {
        $candidature= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)
        ->first();
        $candidature->statut_candidature=2;
        $candidature->save();

        return redirect("/servicebenevolat");
        
    }

    public function informationCandidature($id,$id2,Request $request) 
    {
        $demandeInfo =  $request->get('information_suplementaire');
 
        $candidature= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)
        ->first();
        
        $candidature->information_suplementaire = $demandeInfo;
        $candidature->statut_candidature=3;
        $candidature->save();

        return redirect("/servicebenevolat");
        
    }

    public function JuridiqueCandidature($id,$id2) 
    {
        $candidature= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)
        ->first();
        $candidature->statut_candidature=4;
        $candidature->save();

        return redirect("/servicebenevolat");
        
    }

}
