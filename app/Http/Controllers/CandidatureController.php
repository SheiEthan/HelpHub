<?php

namespace App\Http\Controllers;

use App\Mail\Mailnotify;
use Illuminate\Support\Facades\Mail;
use App\Models\Candidature;
use App\Models\Publication;
use App\Models\recherche_benevole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CandidatureController extends Controller
{
    public function demandeCandidature($id)
    {
   
       $publication = Publication::findOrFail($id);

       $benevole = $publication->recherche_benevole->first();
       $incr=0;
       while($benevole->publication->date_debut->week()+$incr<=$benevole->publication->date_fin->week()){
        Candidature::create([
            'id_utilisateur' =>Auth::User()->utilisateur->id_utilisateur,
            'id_recherche_benevole' =>$benevole->id_recherche_benevole,
            "num_semaine"=>$benevole->publication->date_debut->week()+$incr
        ]);
        $incr++;
       }

        
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

        $candidatures= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)->get();
        foreach($candidatures as $candidature){
            $candidature->information_suplementaire .= " : ".$demandeInfo;
            $candidature->statut_candidature = 0 ;
            $candidature->save();
        }
        

        return redirect("/mycandidatures");

    }


    // get candidature asso 
    public function getCandidature() 
    {
      $candidatures = Candidature::where('statut_candidature' , '1')->get();

      return view('gestioncandidature', ['candidatures' => $candidatures]);

    }


     // validation d'une candidature de la part d'une association 
    public function validerCandidature($id,$id2) 
    {
        $utilisateur = Auth::user()->utilisateur;
        
        
        $candidatures= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)->get();
        // valider par l'asso 
        foreach($candidatures as $candidature){
            $candidature->statut_candidature=5;
            $candidature->save();

        }
      
        Mail::to('purdyj@iut-acy.univ-smb.fr')->send(new Mailnotify($candidatures->first()));
         
        return redirect("/gestioncandidature");
    }

    // refus de la part d'un asso 
    public function refuserCandidature($id,$id2) 
    {
        $candidatures= Candidature::where('id_utilisateur' , $id)
        ->where('id_recherche_benevole' , $id2)->get();
        foreach($candidatures as $candidature){
        $candidature->statut_candidature=2;
        $candidature->save();
        }
        return redirect("/gestioncandidature");
        
    }

}
