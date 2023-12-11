<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informations du compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mettez à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>





    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Pseudo :')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="nom_utilisateur" :value="__('Nom :')" />
            <x-text-input id="nom_utilisateur" name="nom_utilisateur" type="text" class="mt-1 block w-full" pattern="[A-Za-z]{3,255}" :value="old('nom_utilisateur', $utilisateur->nom_utilisateur)" required autofocus autocomplete="nom_utilisateur" />
            <x-input-error class="mt-2" :messages="$errors->get('nom_utilisateur')" />
        </div>

        <div>
            <x-input-label for="prenom_utilisateur" :value="__('Prénom :')" />
            <x-text-input id="prenom_utilisateur" name="prenom_utilisateur" type="text" class="mt-1 block w-full" pattern="[A-Za-z]{3,255}" :value="old('prenom_utilisateur', $utilisateur->prenom_utilisateur)" required autofocus autocomplete="pseudo_utilisateur" />
            <x-input-error class="mt-2" :messages="$errors->get('prenom_utilisateur')" />
        </div>

        <div>
            <x-input-label for="numero_telephone_utilisateur" :value="__('Téléphone :')" />
            <x-text-input id="numero_telephone_utilisateur" name="numero_telephone_utilisateur" type="tel" pattern="0[0-9]{9}" placeholder="01 23 45 67 89"  class="mt-1 block w-full" :value="old('numero_telephone_utilisateur', $utilisateur->numero_telephone_utilisateur)"  autofocus autocomplete="numero_telephone_utilisateur" />
            <x-input-error class="mt-2" :messages="$errors->get('numero_telephone_utilisateur')" />
        </div>

        <div>
            <x-input-label for="id_localisation" :value="__('Localisation :')" />

                <select name="id_localisation" id="id_localisation">
                    @if (isset($la_localisation)):
                        <option value=""></option>
                        <option value="{{$la_localisation[0]->id_localisation}}" selected >{{$la_localisation[0]->pays}} / {{$la_localisation[0]->ville}} / {{$la_localisation[0]->code_postal}}</option>
                    @else
                    <option value="">--Choisir une localisation--</option>
                    @endif
                @foreach ($localisations as $localisation)
                <option value="{{$localisation->id_localisation}}">{{$localisation->pays}} / {{$localisation->ville}} / {{$localisation->code_postal}}</option>
                @endforeach 
                </select>
            <x-input-error class="mt-2" :messages="$errors->get('id_localisation')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email :')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __("Votre adresse e-mail n'est pas vérifiée.") }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __("Cliquez ici pour renvoyer l'e-mail de vérification.") }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>


        </div>
    </form>
</section>
