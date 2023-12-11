<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Publication;
use App\Models\Publication_recherche_benevole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CandidatureController extends Controller
{
    public function demandeCandidature($id)
    {
   
       $publication = Publication::findOrFail($id);

       $benevole = $publication->recherche_benevole->first();
       
        Candidature::create([
            'id_utilisateur' =>Auth::User()->utilisateur->id_utilisateur,
            'id_recherche_benevole' =>$benevole->id_recherche_benevole
        ]);
        
        return redirect("/publication/".$id);
    }


    public function getMyCandidature() 
    {
        
        $candidatures = Auth::User()->utilisateur->candidatures;
        return view('mycandidatures', ['candidatures' => $candidatures] );
    }


    public function updateCandidature($id,$id2,Request $request)
    {
        $demandeInfo =  $request->get('information_suplementaire_user');

        $candidature= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)
        ->first();

        $candidature->information_suplementaire .= " : ".$demandeInfo;
        $candidature->statut_candidature = 0 ;
        $candidature->save();

        return redirect("/mycandidatures");

    }
}
