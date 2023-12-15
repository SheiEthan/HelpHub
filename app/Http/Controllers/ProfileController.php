<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Localisation;
use App\Models\Utilisateur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $localisations = Localisation::all();
        $utilisateur = Utilisateur::where('id_user',$request->user()->id)->get();
       $return=[
        'user' => $request->user(),
        'utilisateur' => $utilisateur[0],
        'localisations' =>  $localisations
       ];
       if($utilisateur[0]->id_localisation != "")
       {
            $la_loc=Localisation::where('id_localisation',$utilisateur[0]->id_localisation)->get();
            $return += ['la_localisation' => $la_loc ];
       }
        return view('profile.edit',$return );
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $utilisateur=Utilisateur::where('id_user',$request->user()->id)->get();
        $validate =[
            "id_localisation" => $request -> get('id_localisation'),
            "nom_utilisateur" => $request -> get('nom_utilisateur'),
            "prenom_utilisateur" => $request -> get('prenom_utilisateur'),
            

        ];
        $request->user()->save();
            if($request -> get('numero_telephone_utilisateur') !=""
            &&$request -> get('numero_telephone_utilisateur') !=$utilisateur[0]->numero_telephone_utilisateur){
                $validate+=$request->validate(["numero_telephone_utilisateur" => ['max:10', 'unique:'.Utilisateur::class]]);
            }
            else
            {
                $validate+=["numero_telephone_utilisateur" =>$request->get('numero_telephone_utilisateur')];
            }
        DB::table('utilisateur')
              ->where('id_utilisateur', $utilisateur[0]->id_utilisateur)
              ->update($validate);


        

        return Redirect::route('dashboard')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
