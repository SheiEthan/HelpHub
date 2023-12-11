<x-guest-layout>

<link rel="stylesheet" href="css/inscription.css">

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="register-header">
            <h2>Inscription</h2>
        </div>
        <!-- Name -->
        <div class="mt-3">
            <x-input-label for="name" :value="__('Pseudo*')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-3">
            <x-input-label for="prenom_utilisateur" :value="__('Prénom*')" />
            <x-text-input id="prenom_utilisateur" class="block mt-1 w-full" pattern="[A-Za-z]{3,255}" type="text" name="prenom_utilisateur" :value="old('prenom_utilisateur')" required autofocus autocomplete="pseudo_utilisateur" />
            <x-input-error :messages="$errors->get('prenom_utilisateur')" class="mt-2" />
        </div>

        <div class="mt-3">
            <x-input-label for="nom_utilisateur" :value="__('Nom*')" />
            <x-text-input id="nom_utilisateur" class="block mt-1 w-full" type="text" pattern="[A-Za-z]{3,255}" name="nom_utilisateur" :value="old('nom_utilisateur')" required autofocus autocomplete="nom_utilisateur" />
            <x-input-error :messages="$errors->get('nom_utilisateur')" class="mt-2" />
        </div>



        <!-- Email Address -->
        <div class="mt-3">
            <x-input-label for="email" :value="__('Email*')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-3">
            <x-input-label for="password" :value="__('Mot de passe*')" />

            

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            minLength=12
                            pattern="(?=.*[0-9])(?=.*[#?!@$%^&*-_\/])(?=.*[a-z])(?=.*[A-Z]).{12,}"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p class="mdp" >Votre mot de passe doit contenir au moins 12 caractères avec <br>des majuscules, minuscules, chiffres et caractères spéciaux<br> tels que : #?!@$%^&*-_\/.</p>
        </div>

        <!-- Confirm Password -->
        <div class="mt-3">
            <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe*')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
            minLength=12
            pattern="(?=.*[0-9])(?=.*[#?!@$%^&*-_\/])(?=.*[a-z])(?=.*[A-Z]).{12,}"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm mr-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Déjà un compte ?') }}
            </a>

            <x-primary-button class="bouton">
                {{ __("S'enregistrer") }}
            </x-primary-button>
        </div>
        <div>
            <p class="champs" >* Champs obligatoires</p>
        </div>
    </form>
</x-guest-layout>
