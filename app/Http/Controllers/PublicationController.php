<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Alerte;
use App\Models\Association;
use App\Models\Historique;
use App\Models\Liker_publi;
use App\Models\Localisation;
use App\Models\Mot_cle;
use App\Models\Publication;
use App\Models\Thematique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PublicationController extends Controller
{
    
    // afficher les actions pa rapport au thematique  
    public function afficherResultats(Request $request)
    {
        // Récupérez les données du formulaire
        $thematiqueId = $request -> get('id_thematique');
        $localisationId  = $request -> get('id_localisation');
        $associationId  = $request -> get('id_association');
        $dateDeb  = $request -> get('dateDebut');
        $dateFin  = $request -> get('dateFin');
        $search = $request -> get('searchbar');
        $motclefs  = $request -> get('id_motclef');
        $publications = Publication::all()->where('etat_publication',2);
        $filtredthem=collect();
        $filtredloc =collect();
        $filtredassoc =collect();
        $filtredate =collect();
        $filtredsearch=collect();
        $filtredmotclef=collect();

        if($search!="")
        {
            foreach($publications as $publication){
                        if($publication->titre_publication == $search)
                        {
                            $filtredsearch->add($publication);
                        }
            };
            $filtredsearch= $filtredsearch->unique();
        }
        else{
            $filtredsearch=$publications;
        }

        if($motclefs!="")
        {
            foreach($filtredsearch as $publication){
                /*foreach($motclefs as $motclef)
                    {*/
                        if($publication->mot_clefs->contains('mot_clef',$motclefs))
                        {
                            $filtredmotclef->add($publication);
                        }
                    //}
            };
            $filtredmotclef= $filtredmotclef->unique();
        }
        else{
            $filtredmotclef=$filtredsearch;
        }


        if($thematiqueId!=""){
            foreach($filtredmotclef as $publication){
                foreach($thematiqueId as $thematique)
                    {
                        if($publication->thematiques->contains('id_thematique',$thematique))
                        {
                            $filtredthem->add($publication);
                        }
                    }
            };
            $filtredthem= $filtredthem->unique();
        }
        else{
            $filtredthem=$filtredmotclef;
        }
        
        if($localisationId!=""){
            foreach($filtredthem as $publication){
                foreach($localisationId as $localisation)
                    {
                        if($publication->localisation->id_localisation == $localisation)
                        {
                            $filtredloc->add($publication);
                        }
                    }
                }
            $filtredloc= $filtredloc->unique();
        }
        else{
            $filtredloc=$filtredthem;
        }

        if($associationId!=""){
            foreach($filtredloc as $publication){
                foreach($associationId as $association)
                    {
                        if($publication->id_association == $association)
                        {
                            $filtredassoc->add($publication);
                        }
                    }
            };
            $filtredassoc= $filtredassoc->unique();
        }

        else{
            $filtredassoc=$filtredloc;
        }        
        
        
        if($dateDeb!=""&&$dateFin!="")
        {
            foreach($filtredassoc as $publication)
            {
                if($publication->date_saisi >= $dateDeb&&$publication->date_saisi <=$dateFin)
                {
                    $filtredate->add($publication);
                }
            };
        }  
        else
        {
            $filtredate=$filtredassoc;
        }

        /*if($dateDeb!="")
        {
            foreach($filtredassoc as $publication)
            {
                if($publication->date_saisi >= $dateDeb)
                {
                    $filtredatedeb->add($publication);
                }
            };
            $filtredatedeb= $filtredatedeb->unique();
        }  
        else
        {
            $filtredatedeb=$filtredassoc;
        }

        if($dateFin!="")
        {
            foreach($filtredatefin as $publication)
            {
                if($publication->date_saisi <= $dateFin)
                {
                    $filtredatefin->add($publication);
                }
            };
            $filtredatefin=$filtredatefin->unique();
        }  
        else
        {
            $filtredatefin=$filtredatedeb;
        }*/

        foreach($filtredate as $publication){
            
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

        foreach($filtredate as $publication){
            $publication->nblikes=$publication->likes->count();
        }

        

        // Récupérez les actions associées à la thématique sélectionnée
        /*if($thematiqueId==""){
            $publications = DB::table('publication')->get();
        }
        else{
            $publications = DB::table('publication')
            ->join('thematique_publication', 'publication.id_publication' , '=','thematique_publication.id_publication'  )
            ->join('thematique', 'thematique_publication.id_thematique' , '=','thematique.id_thematique'  )
            ->where('thematique.id_thematique' ,'=', $thematiqueId)
            ->get();


        }*/
        
        return view('rechercher', ['publications' => $filtredate->sortByDesc('date_saisi')] 
                    +$this->getFiltres($request)
    );
    }


    public function afficherPublication(Request $request,$id)
    {
            $publication= Publication::findOrFail($id);
            $candidat=false;
            if(Auth::User())
            {
                DB::table('historique')->insertOrIgnore
                ([
                    "id_user"=>Auth::User()->id,
                    "id_publication"=>$id
                ]);
            }
            if(null !==$publication->information_don->first()){
                $publication->totmontant =0;
                    foreach($publication->information_don->first()->dons as $don)
                    {
                        $publication->totmontant += $don->montant;
                    }
                
            }

            $joursSemaine = [
                1 => 'lundi',
                2 => 'mardi',
                3 => 'mercredi',
                4 => 'jeudi',
                5 => 'vendredi',
                6 => 'samedi',
                7 => 'dimanche'
            ];

            if(null !== $publication->recherche_benevole->first()){
                foreach($publication->recherche_benevole as $benevole)
                {
                    $publication->benevoles=$benevole->candidatures->count();
                    if(null !== $benevole->frequence->first())
                    {
                        if (array_key_exists($benevole->frequence->first()->jour, $joursSemaine))
                        {
                            $benevole->frequence->first()->jour=$joursSemaine[$benevole->frequence->first()->jour];
                        }
                    }
                    foreach($benevole->candidatures as $candidature)
                    {
                        if(null!==Auth::User()){
                            if($candidature->id_utilisateur==Auth::User()->utilisateur->id_utilisateur)
                            {$candidat=true;}
                        }
                        
                    }

                }
            }
            $publication->nblikes=$publication->likes->count();
            foreach($publication->commentaires as $commentaire)
            {
                $commentaire->nblikes=$commentaire->likes->count();
            }
            
            return view('publication', [
                "publication" => $publication,
                "candidat" => $candidat
            ]);

                

    }

    public function getLikes()
    {
        if(null==Auth::User())
        {
            return response()->json(null);
        }
        $publications= Publication::all();
        foreach($publications as $publication)
        {
            $publication->nblikes=$publication->likes->count();
        }
        return response()->json([
            "likes"=>Auth::User()->publi_likes,
            "nblikes"=>$publications

    ]);
    }

    public function liker($request){
        $post=json_decode(file_get_contents("php://input"));
        $id=$post->id;
        
            $like = liker_publi::find([Auth::User()->id, $id]);
        
              if(!$like){
                liker_publi::create([
                        'id_user'=>Auth::User()->id,
                        'id_publication'=>$id
                    ]);
              }
              else{
                DB::table('liker_publi')->where('id_user',Auth::User()->id)->where('id_publication',$id)->delete();
              }
              $publication= Publication::findOrFail($id);
              $publication->nblikes=$publication->likes->count();
        
        return response()->json(["likes"=>$publication->nblikes]);
    }


    public function GetPub3()
    {
        $publications3 = Publication::orderByDesc('date_saisi')->take(3)->get();
        $publications = Publication::distinct()->get(['titre_publication']);

        foreach($publications3 as $publication){
            
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

        foreach($publications3 as $publication){
            $publication->nblikes=$publication->likes->count();
        }


        return view('welcome', ['publications3' => $publications3, 'spublications'=>$publications] );
    }

    public function mypublications(){
        $publications=collect();
        $publicationsdon=collect();
        $publicationsbenevole=collect();
        $publicationslike=collect();
        $publicationshistorique=collect();

        foreach(Auth::User()->utilisateur->candidatures as $publication){
            $publications->add($publication->recherche_benevole->publication);
            $publicationsbenevole->add($publication->recherche_benevole->publication);
        }

        foreach(Auth::User()->utilisateur->dons as $publication){
            $publications->add($publication->publication_information_don->publication);
            $publicationsdon->add($publication->publication_information_don->publication);

        }

        foreach(Auth::User()->publi_likes as $publication){
            $publications->add($publication->publication);
            $publicationslike->add($publication->publication);

        }

        foreach(Auth::User()->historiques as $publication){
            $publications->add($publication->publication);
            $publicationshistorique->add($publication->publication);

        }

        $publications= $publications->unique();


        foreach($publicationsbenevole as $publication){
            foreach($publication->recherche_benevole as $benevole)
            {
                $publication->benevoles=$benevole->candidatures->count();
                $publication->nblikes=$publication->likes->count();
            }
        }

        foreach($publicationsdon as $publication){
            $publication->totmontant =0;
                    foreach($publication->information_don->first()->dons as $don)
                    {
                        $publication->totmontant += $don->montant;
                        $publication->nblikes=$publication->likes->count();
                    }
        }


        foreach($publicationslike as $publication){
            
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
            $publication->nblikes=$publication->likes->count();

        }        
        
        foreach($publicationshistorique as $publication){
            
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
            $publication->nblikes=$publication->likes->count();

        }
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
            $publication->nblikes=$publication->likes->count();

        }

        return view('mypublications', [
            "publications" => $publications,
            "publicationslike" => $publicationslike,
            "publicationsdon" => $publicationsdon,
            "publicationsbenevole" => $publicationsbenevole,
            "publicationshistorique" => $publicationshistorique
        ]);
    }

    public function getFiltres($request)
    {
        $thematiques = Thematique::all()->sortBy('titre_thematique');
        $localisations = Localisation::all()->sortBy('code_postal');
        $associations = Association::all()->sortBy('nom_association');
        $mot_clefs = Mot_cle::all()->sortBy('mot_clef');
        $publications = Publication::distinct()->get(['titre_publication']);


        $thematiqueId = $request -> get('id_thematique');
        $localisationId  = $request -> get('id_localisation');
        $associationId  = $request -> get('id_association');
        $dateDeb  = $request -> get('dateDebut');
        $dateFin  = $request -> get('dateFin');
        $motclef = $request -> get('id_motclef');
        $search = $request -> get('searchbar');



        $checked=[
            'thematiques'=> $thematiqueId,
            'localisations'=> $localisationId,
            'associations'=>$associationId,
            'datedeb'=>$dateDeb,
            'datefin'=>$dateFin,
            'motclef'=>$motclef,
            'search' =>$search
        ];
        $checked = collect($checked);

        return  [
            'thematiques' => $thematiques,
            'localisations' => $localisations,
            'associations' => $associations,
            'motclefs' => $mot_clefs,
            'spublications'=>$publications,
            'checked'=>$checked
    ];
    }

    public function myalertes(Request $request){
        $thematiqueId="";
        $localisationId="";
        $associationId="";
        $motclefs="";
        if(isset(Auth::User()->alerte))
        {
            $alerte=Auth::User()->alerte;
            $thematiqueId = $alerte->id_thematique;
            $localisationId  = $alerte->id_localisation;
            $associationId  = $alerte->id_association;
            $motclefs  = $alerte->id_motclef;
        };
        $publications = Publication::all()->where('etat_publication',2);
        $filtredthem=collect();
        $filtredloc =collect();
        $filtredassoc =collect();
        $filtredmotclef=collect();

        if($motclefs!="")
        {
            foreach($publications as $publication){
                /*foreach($motclefs as $motclef)
                    {*/
                        if($publication->mot_clefs->contains('mot_clef',$motclefs))
                        {
                            $filtredmotclef->add($publication);
                        }
                    //}
            };
            $filtredmotclef= $filtredmotclef->unique();
        }
        else{
            $filtredmotclef=$publications;
        }


        if($thematiqueId!=""){
            foreach($filtredmotclef as $publication){

                        if($publication->thematiques->contains('id_thematique',$thematiqueId))
                        {
                            $filtredthem->add($publication);
                        }
                    
            };
            $filtredthem= $filtredthem->unique();
        }
        else{
            $filtredthem=$filtredmotclef;
        }
        
        if($localisationId!=""){
            foreach($filtredthem as $publication){

                        if($publication->localisation->id_localisation == $localisationId)
                        {
                            $filtredloc->add($publication);
                        }
                    
                }
            $filtredloc= $filtredloc->unique();
        }
        else{
            $filtredloc=$filtredthem;
        }

        if($associationId!=""){
            foreach($filtredloc as $publication){

                        if($publication->id_association == $associationId)
                        {
                            $filtredassoc->add($publication);
                        }
                    
            };
            $filtredassoc= $filtredassoc->unique();
        }

        else{
            $filtredassoc=$filtredloc;
        }        

        foreach($filtredassoc as $publication){
            
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

        foreach($filtredassoc as $publication){
            $publication->nblikes=$publication->likes->count();
        }

        return view('alerte', ['publications' => $filtredassoc->sortByDesc('date_saisi')] 
        +$this->getFiltres($request)
    );
    }

    public function updateAlertes(Request $request){
        $thematiqueId = $request -> get('id_thematique');
        $localisationId  = $request -> get('id_localisation');
        $associationId  = $request -> get('id_association');
        $motclef  = $request -> get('id_motclef');
        if(isset(Auth::User()->alerte))
        {
            $alerte=Auth::User()->alerte;
            $alerte->id_thematique=$thematiqueId;
            $alerte->id_localisation=$localisationId;
            $alerte->id_association=$associationId;
            $alerte->id_mot_clef=$motclef;
            $alerte->save();
        }
        else{
            Alerte::create([
                "id_user"=>Auth::User()->id,
                "id_thematique"=>$thematiqueId,
                "id_localisation"=>$localisationId,
                "id_association"=>$associationId,
                "id_mot_clef"=>$motclef
            ]);
        }
        return redirect("/myalertes");
    }


}
