<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Utilisateur;
use Dflydev\DotAccessData\Util;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function getUtilisateurs()
    {
        $utilisateurs=Utilisateur::all();

        return view('utilisateurs', [
            "utilisateurs" => $utilisateurs
        ]);
    }

    public function createUtilisateur(Request $request)
    {
        
        $validatedCompte = $request->validate([
            "mail_compte" =>   ["required", "string", "min:1"],
            "motdepasse_compte" =>   ["required", "string", "min:16"]
             ]);
             
        $idcompte= ["id_compte"=>Compte::create($validatedCompte) ->id_compte];

        $validated = $request->validate([
            
            "nom_utilisateur" =>   ["required", "string", "min:1"],
            "prenom_utilisateur" =>   ["required", "string", "min:1"],
            "pseudo_utilisateur" =>   ["required", "string", "min:1"]

             ]);
             
        Utilisateur::create($validated+$idcompte);

      return redirect("/welcome");
    }
}
