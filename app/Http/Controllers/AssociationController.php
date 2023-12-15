<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Frequence;
use App\Models\Localisation;
use App\Models\Media;
use App\Models\Media_publication;
use App\Models\Mot_cle;
use App\Models\Mot_cle_publication;
use App\Models\Planifier;
use App\Models\Publication;
use App\Models\Publication_information_don;
use App\Models\Publication_recherche_benevole;
use App\Models\Thematique;
use App\Models\Thematique_publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssociationController extends Controller
{
    public function mypublications(){
        $publications= Auth::User()->association->publications;
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
        foreach($publications as $publication){
            $publication->nblikes=$publication->likes->count();
        }
        return view('myassociation', [
            "publications" => $publications
        ]);
    }

    public function mypublicationsbenevoles(){
        $publications= Auth::User()->association->publications;
        $publicationsbenevoles=collect();
        foreach($publications as $publication){
            if(null !== $publication->recherche_benevole->first()){
                foreach($publication->recherche_benevole as $benevole)
                {
                            $publication->benevoles=$benevole->candidatures->count();
                            $publicationsbenevoles->add($publication);
                }
            }


        }
        foreach($publicationsbenevoles as $publication){
            $publication->nblikes=$publication->likes->count();
        }
        return view('gestionheures', [
            "publications" => $publicationsbenevoles
        ]);
    }

    public function infopublication(){
        $motclefs = Mot_cle::all()->sortBy('mot_clef');
        $thematiques = Thematique::all()->sortBy('titre_thematique');
        $localisations = Localisation::all()->sortBy('code_postal');
        return view('createpublication', [
            "localisations" => $localisations,
            "thematiques" => $thematiques,
            "motclefs" => $motclefs
        ]);
    }

    public function createpublication(Request $request){
        $thematiques = $request -> get('id_thematique');
        $motclefs  = $request -> get('id_motclef');
        $validated=$request->validate([
            'titre_publication' => ['required', 'string', 'max:200'],
            'resume' => ['required', 'string', 'max:200'],
            'description_publication' => ['required', 'string', 'max:5000'],
            'date_debut' => ['required'],
            'date_fin' => ['required','after:date_debut'],
            'id_localisation' => ['required'],
        ]);
        $publication=Publication::create($validated+["id_association"=>Auth::User()->association->id_association, ""]);
        if(null!==$motclefs)
        {foreach($motclefs as $motclef){
            Mot_cle_publication::create(["id_publication"=> $publication->id_publication, "id_mot_clef"=>$motclef]);
        }
}

        if(null!==$thematiques)
        {foreach($thematiques as $thematique){
            Thematique_publication::create(["id_publication"=> $publication->id_publication, "id_thematique"=>$thematique]);
        }}

        $incr=1;

        if(null!==$request->medias)
        {foreach($request->medias as $media){
            $type=2;
            $incr++;

            if(in_array($media->extension(),["jpeg","jpg","png","gif","wep"])){
                $type=0;
             }
                else if(in_array($media->extension(),["mp4","wmv","avi"])){
                    $type=1;
                }
            $medianame=$publication->id_publication."-".$incr.".".$media->extension();

            $media->move(public_path("/img/"),$medianame);
            $file=Media::create([
                "titre_media"=>"unknown",
                "type_media"=>$type,
                "lien_media"=>$medianame
            ]);

            Media_publication::create([
                "id_media"=>$file->id_media,
                "id_publication"=>$publication->id_publication
            ]);

           
        }}

        if($request -> get('type')=="don")
        {
            $validateddon = $request->validate([
                "montant_minimum"=>['required', 'integer', 'min:0'],
                "objectif"=>['required', 'integer', 'min:1','gt:montant_minimum']
            ]);
            Publication_information_don::create($validateddon+["id_publication"=>$publication->id_publication]);
        }
        elseif($request -> get('type')=="benevole"){
            if($request -> get('typer')=="frequence"){
                $typer=0;
            }
            else{
                $typer=1;
            }

            $publicationbenevole=Publication_recherche_benevole::create([
                "id_publication"=>$publication->id_publication,
                "mission_distance"=>$request -> get('typem')=='mission_distance',
                "mission_presentiel"=>$request -> get('typem')=='mission_presentiel',
                "type_presence"=>$typer
            ]);
            if($request -> get('typer')=="frequence"){
                $validatedfrequence = $request->validate([
                    "jour"=>['required', 'integer'],
                    "heured"=>['required'],
                    "heuref"=>['required','after:heured'],
                ]);
                $plage= $validatedfrequence["heured"]." à ".$validatedfrequence["heuref"];
                Frequence::create([
                    "id_recherche_benevole"=> $publicationbenevole->id_recherche_benevole,
                    "jour"=>$validatedfrequence["jour"],
                    "plage_horraire"=>$plage
                ]);
            }
            else{
                $validatedplanifie= $request->validate([
                    "datepl"=>['required', 'date'],
                    "heure_debut"=>['required'],
                    "heure_fin"=>['required','after:heure_debut'],
                ]);

                Planifier::create($validatedplanifie+["id_recherche_benevole"=> $publicationbenevole->id_recherche_benevole]);

            }
        }


        return redirect('/myassociation');
    }



    public function createassociation(Request $request){

        $validated=$request->validate([
            'nom_association' => ['required', 'string', 'max:500', 'unique:'.Association::class],
            'siteweb_association' => [ 'max:500'],
            'description_association' => ['required', 'string', 'max:5000'],
            'numerotelephone_association'  => ['required','max:10', 'unique:'.Association::class],
        ]);
        Association::create($validated+['id_user'=>Auth::User()->id]);
        return redirect('/myassociation');
    }

    public function mypublicationbenevoles($id){
        $publication= Publication::findOrFail($id);


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
            }
        }


        return view('candidatsheures', [
            "publication" => $publication
        ]);
    }

    public function updateheures(Request $request,$id){
        $publication= Publication::findOrFail($id);


        foreach($publication->recherche_benevole->first()->candidatures as $candidature)
        {
            //$candidature->heures=
            $candidature->heures=$request->get(("heures".$candidature->id_utilisateur."-".$candidature->num_semaine));
            $candidature->save();


        }


        return redirect("/gestionheures/".$id);
    }

    public function infoupdatepublication($id){
        $publication= Publication::findOrFail($id);
        $motclefs = Mot_cle::all()->sortBy('mot_clef');
        $thematiques = Thematique::all()->sortBy('titre_thematique');
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
            }
        }
        return view('updatePublication', [
            "publication"=>$publication,
            "thematiques" => $thematiques,
            "motclefs" => $motclefs
        ]);
    }

    public function updatepublication(Request $request, $id){
        $publication= Publication::FindOrFail($id);
        $thematiques = $request -> get('id_thematique');
        $motclefs  = $request -> get('id_motclef');

        if(null!==$motclefs)
        {
            foreach($publication->mot_clefs as $pmotclef){
                $test = Mot_cle_publication::find([$pmotclef->id_mot_clef,$id]);
                if(!in_array($pmotclef->id_mot_clef,$motclefs)&&$test )
                {
                    $test->delete();
                }
            }
            foreach($motclefs as $motclef){
            $test = Mot_cle_publication::find([$motclef, $id]);
            if(!$test){
                Mot_cle_publication::create(["id_publication"=> $publication->id_publication, "id_mot_clef"=>$motclef]);
            }

        }

        
        }

        if(null!==$thematiques)
        {
            foreach($publication->thematiques as $pthematique){
                $test = Thematique_publication::find([$pthematique->id_thematique, $id]);
                if(!in_array($pthematique->id_thematique,$thematiques )&&$test )
                {
                    $test->delete();
                }
            }
            foreach($thematiques as $thematique){
                $test = Thematique_publication::find([ $thematique,$id]);
                if(!$test){
                    Thematique_publication::create(["id_publication"=> $publication->id_publication, "id_thematique"=>$thematique]);
                }
            }
        }
        $incr=1;

        if(null!==$request->medias)
        {foreach($request->medias as $media){
            $type=2;
            $incr++;

            if(in_array($media->extension(),["jpeg","jpg","png","gif","wep"])){
                $type=0;
             }
                else if(in_array($media->extension(),["mp4","wmv","avi"])){
                    $type=1;
                }
            $medianame=$publication->id_publication."-".time().rand(0,100000).".".$media->extension();

            $media->move(public_path("/img/"),$medianame);
            $file=Media::create([
                "titre_media"=>"unknown",
                "type_media"=>$type,
                "lien_media"=>$medianame
            ]);

            Media_publication::create([
                "id_media"=>$file->id_media,
                "id_publication"=>$publication->id_publication
            ]);


        }

    }

    if(null !== $publication->information_don->first()){
        $validateddon = $request->validate([
            "montant_minimum"=>['required', 'integer', 'min:0'],
            "objectif"=>['required', 'integer', 'min:1','gt:montant_minimum']
        ]);
        $publication->information_don->first()->montant_minimum=$validateddon['montant_minimum'];
        $publication->information_don->first()->objectif=$validateddon['objectif'];
        $publication->information_don->first()->save();
    }

        return redirect('/myassociation')->with('status', 'publication-updated');
    }

}
