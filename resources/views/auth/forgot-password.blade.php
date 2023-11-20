<x-guest-layout>

<link rel="stylesheet" href="css/connexion.css">

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __("Mot de passe oublié? Aucun problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.") }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <style type="text/css">
            .bouton { 
 	            color: #ffffff;
  	            background-color: rgb(128, 186, 140);
            }

            .bouton:hover {
                background-color: rgb(108, 157, 118);
            }
        </style>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bouton">
                {{ __('Envoyer email pour réinitialiser le mot de passe') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
