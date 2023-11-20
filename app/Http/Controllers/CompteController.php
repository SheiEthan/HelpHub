<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function getComptes()
    {
        $comptes=Compte::all();

        /*return view('comptes', [
            "comptes" => $comptes
        ]);*/
    }

    public function createCompte(Request $request)
    {
        $validated = $request->validate([
            "mail_compte" =>   ["required", "string", "min:1"],
            "motdepasse_compte" =>   ["required", "string", "min:16"]
             ]);
             
        Compte::create($validated);

      return redirect("/welcome");
    }

    public function deleteCompte(Request $request,$id)
    {
        $comptes=Compte::findOrFail($id);
        $comptes->delete();
        return redirect("/");
    }

    public function updateCompte(Request $request,$id)
    {
        $comptes=Compte::findOrFail($id);
        $comptes->update([
            "mail_compte" => $request -> get('mail_compte'),
            "motdepasse_compte" => $request -> get('motdepasse_compte')
        ]);
    return redirect("/");
    }

    public function showUpdateCompte(Request $request,$id)
    {
        $compte= Compte::findOrFail($id);

        return view('create_compte', [
            "compte" => $compte
        ]);
    }

}