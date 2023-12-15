<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Twilio\Rest\Client;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function storesms(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        if(isset( Auth::User()->utilisateur->numero_telephone_utilisateur)){
            return redirect('loginsms');
        }
        else{

            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    public function dauth(){
        $receiverNumber = "0768320312";
        $receiverNumber = substr_replace($receiverNumber, "+33", 0, 1);
  
        try {
  
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
            Auth::User()->utilisateur->tel_code=rand(1,100000);
            Auth::User()->utilisateur->save();
            $message = "Votre code de connection: ".Auth::User()->utilisateur->tel_code;
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message
            ]);
            return view('telephonelogin');
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

    public function checkcode(Request $request){
        if($request->get('sms')==Auth::User()->utilisateur->tel_code)
        {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        else{
            return view('telephonelogin')->withErrors(['sms'=>'Le code saisi ne correspond pas au code envoyé']);
        }

    }

    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        $user=Socialite::driver('google')->stateless()->user();

        $current_user=User::Where('email','=',$user->getEmail())->first();
        
        if($current_user){
            Auth::login($current_user);
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        else{
            return view('auth.register')->withErrors(['google'=>"Google authentification requiert un compte créé avec la même adress mail" ]);
        }
    }


}


