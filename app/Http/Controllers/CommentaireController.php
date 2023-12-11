<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Liker;
use App\Models\Signaler;
use App\Models\User;
use Illuminate\Console\Signals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CommentaireController extends Controller
{
    
    // public function createCommentaire(Request $request)
    // {
    //     Commentaire::create([
    //         "commentaire" => $request->get('description_commentaire'),
    //     ]);
    //     return redirect("/");
    // }

    public function storeComment(Request $request,$id)
    {
        $contenu = $request -> get('comment_text');


        Commentaire::create([
            'id_user'=>Auth::user()->id,
            'id_publication'=> $id,
            'description_commentaire'=>$contenu
        ]);

        
        return redirect("/publication/".$id);
    }


    public function getLikes()
    {
        if(null==Auth::User())
        {
            return response()->json(null);
        }
        $commentaires= Commentaire::all();
        foreach($commentaires as $commentaire)
        {
            $commentaire->nblikes=$commentaire->likes->count();
        }
        
        return response()->json([
            "likes"=>Auth::User()->likes,
            "signals"=>Auth::User()->signals,
            "nblikes"=>$commentaires,


    ]);
    }

    public function liker($request){
        $post=json_decode(file_get_contents("php://input"));
        $id=$post->id;
        
            $like = liker::find([Auth::User()->id, $id]);
        
              if(!$like){
                    Liker::create([
                        'id_user'=>Auth::User()->id,
                        'id_commentaire'=>$id
                    ]);
              }
              else{
                DB::table('liker')->where('id_user',Auth::User()->id)->where('id_commentaire',$id)->delete();
              }
              $commentaire= Commentaire::findOrFail($id);
              $commentaire->nblikes=$commentaire->likes->count();
        
        return response()->json(["likes"=>$commentaire->nblikes]);
    }

    public function signaler($request){
        $post=json_decode(file_get_contents("php://input"));
        $id=$post->id;
        $signal=Signaler::find([Auth::User()->id, $id]);
              if(!$signal){
                    Signaler::create([
                        'id_user'=>Auth::User()->id,
                        'id_commentaire'=>$id
                    ]);
              }   
    }

    
}
