<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Création de publication') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informations de la publication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Saisir les informations de votre publication.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" >
        @csrf
    </form>



    <link rel="stylesheet" type="text/css" href="/css/createpublication.css">
    <script defer type = "module" src=" {{asset('js/association.js')}}"> </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <form method="post" action="{{ route('createpublication') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf


        <div>
            <x-input-label for="titre_publication" :value="__('Titre :*')" />
            <x-text-input id="titre_publication" name="titre_publication" type="text" class="mt-1 block w-full"  value="{{ old('titre_publication') }}" required autofocus autocomplete="titre_publication" />
            <x-input-error class="mt-2" :messages="$errors->get('titre_publication')" />
        </div>

        <div>
            <x-input-label for="resume" :value="__('Résumé :*')" />
            <x-text-input id="resume" name="resume" type="text" class="mt-1 block w-full" value="{{ old('resume') }}" required autofocus autocomplete="resume" />
            <x-input-error class="mt-2" :messages="$errors->get('resume')" />
            <div class="desc">
                <p>Vous pouvez inscrire un résumé de 200 caractères maximum.</p>
            </div>
        </div>
        

        <div>
            <x-input-label for="description_publication" :value="__('Description :*')" />
            <x-text-input id="description_publication" name="description_publication" type="text" class="mt-1 block w-full" value="{{ old('description_publication') }}"  required autofocus autocomplete="description_publication" />
            <x-input-error class="mt-2" :messages="$errors->get('description_publication')" />
            <div class="desc">
                <p>Vous pouvez inscrire une description de 5000 caractères maximum.</p>
            </div>
        </div>
        

        <div>
            <x-input-label for="date_debut" :value="__('Date début :*')" />
            <x-text-input id="date_debut" name="date_debut" type="date" class="mt-1 block w-full" value="{{ old('date_debut') }}"  required  autocomplete="date_debut" />
            <x-input-error class="mt-2" :messages="$errors->get('date_debut')" />
        </div>

        <div>
            <x-input-label for="date_fin" :value="__('Date fin :*')" />
            <x-text-input id="date_fin" name="date_fin" type="date" class="mt-1 block w-full" value="{{ old('date_fin') }}"  required  autocomplete="date_fin" />
            <x-input-error class="mt-2" :messages="$errors->get('date_fin')" />
        </div>

        <div>
            <x-input-label for="id_localisation" :value="__('Localisation :*')" />

                <select name="id_localisation" id="id_localisation" required>
                    <option value="{{ old('id_localisation') }}">--Choisir une localisation--</option>
                @foreach ($localisations as $localisation)
                <option value="{{$localisation->id_localisation}}">{{$localisation->pays}} / {{$localisation->ville}} / {{$localisation->code_postal}}</option>
                @endforeach 
                </select>
            <x-input-error class="mt-2" :messages="$errors->get('id_localisation')" />
        </div>
        <div>
            <ul class="collapsible">
                        <li>
                            <span class="toggle noselect">▼ Thématiques :</span> <!-- icône de bascule, peut être personnalisée -->
                            <ul  class="content">
                                @foreach($thematiques as $thematique)
                                <li >
                                    <input name="id_thematique[]" type="checkbox" value="{{$thematique->id_thematique}}" 
                                    />
                                    <label for="scales">{{$thematique->titre_thematique}}</label>
                                </li>
                                @endforeach
                            </ul>
                        </li>                
                    </ul>
        </div>
            
        <div>
            <ul class="collapsible">
                <li>
                    <span class="toggle noselect">▼ Mots clefs :</span> <!-- icône de bascule, peut être personnalisée -->
                    <ul  class="content">
                        @foreach($motclefs as $motclef)
                            <li >
                                <input name="id_motclef[]" type="checkbox" value="{{$motclef->id_mot_clef}}" 
                                />
                                <label for="scales">{{$motclef->mot_clef}}</label>
                            </li>
                        @endforeach
                        </ul>
                </li>                
            </ul>
        </div>
            
        <div class="container">
            <!-- Input element to choose images -->
            <input name="medias[]" type="file" id="select-image" accept="image/*,video/*"  multiple>
            <label id="labimage" for="select-image">
                <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1344 1472q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28h-1472q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h427q21 56 70.5 92t110.5 36h256q61 0 110.5-36t70.5-92h427q40 0 68 28t28 68zm-325-648q-17 40-59 40h-256v448q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-448h-256q-42 0-59-40-17-39 14-69l448-448q18-19 45-19t45 19l448 448q31 30 14 69z" />
                </svg>
                Choisir Images
            </label>

            <div class="preview_image">
                <!-- It will show the total number of files selected -->
                <p><span id="total-images">0</span> fichier(s) selectionné(s)</p>
                <!-- All images will display inside this div -->
                <div id="images"></div>
            </div>
        </div>
        <div>
            <label>Type de publication :*</label>
            <x-input-label for="info" :value="__('Information :')" />
            <x-text-input id="info" name="type" type="radio" checked   autocomplete="info" />
            <x-input-label for="don" :value="__('Recherche de don :')" />
            <x-text-input value="don" id="don" name="type" type="radio"  autocomplete="don" />
            <x-input-label  for="benevole" :value="__('Recherche bénévoles :')" />
            <x-text-input value="benevole" id="benevole" name="type" type="radio"   autocomplete="benevole" />

            <x-input-error class="mt-2" :messages="$errors->get('type')" />
        </div>

        <div id="don">
            <x-input-label for="montant_minimum" :value="__('Montant minimum par don ( en €) :*')" />
            <x-text-input id="montant_minimum" name="montant_minimum" type="text" value="{{ old('montant_minimum') }}"  autofocus autocomplete="montant_minimum" />€
            <x-input-error class="mt-2" :messages="$errors->get('montant_minimum')" />

            <x-input-label for="objectif" :value="__('Objectif de don (en €) :*')" />
            <x-text-input id="objectif" name="objectif" type="text" value="{{ old('objectif') }}"  autofocus autocomplete="objectif" />€
            <x-input-error class="mt-2" :messages="$errors->get('objectif')" />
        </div>

        <div id="benevole">
            <div>
                <label>Type de Mission :*</label>
                <x-input-label for="mission_presentiel" :value="__('Présentiel :')" />
                <x-text-input  value="mission_presentiel" id="mission_presentiel" name="typem" type="radio" checked  autocomplete="mission_presentiel" />
                <x-input-error class="mt-2" :messages="$errors->get('mission_presentiel')" />
                <x-input-label for="mission_distance" :value="__('Distanciel :')" />
                <x-text-input value="mission_distance" id="mission_distance" name="typem" type="radio"   autocomplete="mission_distance" />
                <x-input-error class="mt-2" :messages="$errors->get('mission_distance')" />
            </div>
            
        

            <div id="recherche" >
                <label>Type de recherche de bénévoles :*</label>
                <x-input-label for="frequence" :value="__('Fréquent :')" />
                <x-text-input value="frequence" id="frequence" name="typer" type="radio"  checked    autocomplete="frequence" />
                <x-input-label for="planifier" :value="__('Planifié :')" />
                <x-text-input value="planifier" id="planifier" name="typer" type="radio"     autocomplete="planifier" />
                <x-input-error class="mt-2" :messages="$errors->get('typer')" />
            </div>

            <div id="frequence">
                <x-input-label for="jour" :value="__('Choisir un jour :*')" />
                <select  id="jour" name="jour"  value="{{ old('jour') }}"   autofocus autocomplete="jour" >
                    <option value="1">Lundi</option>
                    <option value="2">Mardi</option>
                    <option value="3">Mercredi</option>
                    <option value="4">Jeudi</option>
                    <option value="5">Vendredi</option>
                    <option value="6">Samedi</option>
                    <option value="7">Dimanche</option>
                        </select>
                <x-input-error class="mt-2" :messages="$errors->get('jour')" />

                <x-input-label for="heured" :value="__('Heure de début :*')" />
                <x-text-input id="heured" name="heured" type="time"   value="{{ old('heured') }}"   autocomplete="heured" />
                <x-input-error class="mt-2" :messages="$errors->get('heured')" />

                <x-input-label for="heuref" :value="__('Heure de fin :*')" />
                <x-text-input id="heuref" name="heuref" type="time"   value="{{ old('heuref') }}"   autocomplete="heuref" />
                <x-input-error class="mt-2" :messages="$errors->get('heuref')" />
            </div>

            <div id="planifier">
                <x-input-label for="datepl" :value="__('Date de l`action :*')" />
                <x-text-input id="datepl" name="datepl" type="date" value="{{ old('datepl') }}"    autocomplete="datepl" />
                <x-input-error class="mt-2" :messages="$errors->get('datepl')" />

                <x-input-label for="heure_debut" :value="__('Heure de début :*')" />
                <x-text-input id="heure_debut" name="heure_debut" type="time"   value="{{ old('heure_debut') }}"   autocomplete="heure_debut" />
                <x-input-error class="mt-2" :messages="$errors->get('heure_debut')" />

                <x-input-label for="heure_fin" :value="__('Heure de fin :*')" />
                <x-text-input id="heure_fin" name="heure_fin" type="time"   value="{{ old('heure_fin') }}"   autocomplete="heure_fin" />
                <x-input-error class="mt-2" :messages="$errors->get('heure_fin')" />
            </div>
        </div>
        <div class="desc">
            <p>* Champs obligatoires</p>
        </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>


            </div>
    </form>
</section>
<script defer type = "module" src=" {{asset('js/createpublication.js')}}"> </script>
</x-app-layout>



