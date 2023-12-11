<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;

use App\Models\Liker;
use Illuminate\Support\Facades\DB;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use App\Models\Signaler;

use Illuminate\Http\Request;

class DiffusionController extends Controller
{
    
    public function getSignaler()
    {
        $signaler = Signaler::all();
        $commentaires=collect();
        foreach($signaler as $signal){

            if(!$commentaires->contains($signal->commentaire))
            {
                $commentaires->add($signal->commentaire);
            }
        }
        foreach($commentaires as $commentaire){
            $commentaire->nbsignals=$commentaire->signals->count();
        }
        return view('servicediffusion', ['commentaires' => $commentaires->sortByDesc('nbsignals')]);
    }


    public function deletecom($id) 
    {
        DB::table('commentaire')->where('id_commentaire',$id)->delete();
        //$signaler = Signaler::all();
        //return view('servicediffusion', ['signaler' => $signaler]);
        echo json_encode(["del"=>true]);

    }


    public function getPubValider() 
    {
       $publications =  Publication::all()->where('etat_publication', 1);

       foreach($publications as $publication){
            
        if(null !==$publication->information_don->first()){
            $publication->totmontant =0;
                foreach($publication->information_don->first()->dons as $don)
                {
                    $publication->totmontant += $don->montant;
                }
            
        }
        if(null !== $publication->recherche_benevole->first()){
            foreach($publication->recherche_benevole as $benevole)
            {
                $publication->benevoles=$benevole->candidatures->count();
            }
        }


    }
       return view('servicediffusionpublication', ['publications' => $publications]);
    }

    public function validerpub($id) 
    {
        $publication= Publication::findOrFail($id);
        $publication->etat_publication=2;
        $publication->save();

        return redirect("/servicediffusionpublication");
    }

    public function refuserpub($id) 
    {
        $publication= Publication::findOrFail($id);
        $publication->etat_publication=4;
        $publication->save();

        return redirect("/servicediffusionpublication");
        
    }


}
