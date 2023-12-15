<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\PrelevementBancaire;
use App\Models\Don;
use App\Models\Publication;
use App\Models\Transaction;
use App\Models\Contrat;
use Illuminate\Http\Request;


class ServiceComptableController extends Controller
{

    public function MontantDon()
    {
        $associations = Association::all();
        foreach($associations as $association)
        {
            foreach($association->publications as $publication)
            {
                if(isset($publication->information_don ))
                {
                    foreach($publication->information_don as $publication_don)
                    {
                        foreach($publication_don->dons as $don)
                        {
                            if($don->transaction->date_transaction->month == now()->month)
                            {
                                $association->tot_mois += $don->montant;
                            }
                          
                        }
                    }
                }
            }
        }

        return view('comptabledon', ['associations' => $associations->sortByDesc('nom_association')]);
    }

    // virement bancaire 
    public function Virement(Request $request)
    {
        $nomAsso = $request -> get('nom_text');
        $ibanAsso = $request -> get('iban_text');
        $montant = $request -> get('montant_text');

        
    }


    public function Contrat(Request $request)
    {
        $ibanAsso = $request -> get('iban_text');
        $idAsso = $request -> get("asso_list");

        $existingContrat = Contrat::where('id_association', $request->get('asso_list'))->first();


        if ($existingContrat) {
            // L'association a déjà un contrat
            return redirect("/comptablecontrat")->with('error', 'Cette association a déjà un contrat.');
        }else {
            Contrat::create([
                'id_association' => $idAsso,
                'etat_signe' => true,
                'date_contrat' => now(),
                'iban' => $ibanAsso,
            ]);
        }

        return redirect("/comptabledon");

    }


    public function getAsso()
    {
        $associations = Association::all()->sortBy('nom_association');
        return view('comptablecontrat', ['associations' => $associations]);
    }



}
