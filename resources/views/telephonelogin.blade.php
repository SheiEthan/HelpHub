<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <link rel="stylesheet" href="css/connexion.css">

    <form method="POST" action="{{ route('loginsms') }}">
        @csrf

        <div class="login-header">
            <h2>Double authentification</h2>
        </div>
        <!-- Email Address -->
        <div>
            <x-input-label for="sms" :value="__('Code recu par sms')" />
            <x-text-input id="sms" class="block mt-1 w-full" type="text" name="sms" :value="old('sms')" required />
            <x-input-error :messages="$errors->get('sms')" class="mt-2" />
        </div>

            <x-primary-button class="bouton">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
    </form>
    <form action="{{ route('loginsms') }}" method="get">
             @csrf
                 <button  class="buttonr" name="buttonr" type="submit">  Renvoyer code </button>    
          </form>
</x-guest-layout>
