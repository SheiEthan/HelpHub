<link rel="stylesheet" type="text/css" href="/css/mycandidature.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Candidatures') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __("Vos candidatures") }}
                </div>
        </div>
    </div>



    <div id="candidatures">
    @foreach($candidatures as $candidature)
    <div id="rescandidatures">
    <div name="{{$candidature->publication_recherche_benevole->publication->id_publication}}" id="res_pub" >
            <div class="infotitre">
                <h2 id="titrepubli" value="{{ $candidature->publication_recherche_benevole->publication->id_publication }}"> {{ $candidature->publication_recherche_benevole->publication->titre_publication}} </h2>
                <a id="voir" href="/publication/{{ $candidature->publication_recherche_benevole->publication->id_publication}}"> voir plus </a>
            </div>
            <div class="infos"> 
                <p> Date de debut: {{$candidature->publication_recherche_benevole->publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$candidature->publication_recherche_benevole->publication->date_fin->format('d-m-Y')}} </p> 
                <p> ({{$candidature->publication_recherche_benevole->publication->localisation->code_postal}}) {{$candidature->publication_recherche_benevole->publication->localisation->ville}}, {{$candidature->publication_recherche_benevole->publication->localisation->pays}}</p>                                                   
            </div>            
        </div> 
        @if($candidature->statut_candidature == 0)
        <p class="demande"> Votre demande de candidature est en cours de traitement  </p>
        @endif
        @if($candidature->statut_candidature == 1)
        <p class="demande"> Votre demande de candidature a été validée  </p>
        @endif
        @if($candidature->statut_candidature == 2)
        <p class="demande"> Votre demande de candidature n'a pas été validée </p>
        @endif
        @if($candidature->statut_candidature == 3)
        <p class="demande"> Nous vous demandons des informations supplémentaires </p>
        <p> Message  :  {{$candidature->information_suplementaire}} </p>
        <form action="/mycandidatures/information/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
             @csrf
                <x-input-label for="information_suplementaire_user" :value="__('Rentrer les informations supplémentaires :')" />
                <x-text-input id="information_suplementaire_user" name="information_suplementaire_user" type="text" class="mt-1 block w-full"  value="{{ old('information_suplementaire_user') }}" required autofocus autocomplete="information_suplementaire_user" />
                <x-input-error class="mt-2" :messages="$errors->get('information_suplementaire_user')" />
                 <button id="" class="buttonr" name="buttonr" type="submit">  Envoyer les d'informations suplémentaires</button>    
          </form>
        @endif
        @if($candidature->statut_candidature == 4)
        <p class="demande"> Votre demande de candidature est en cours de traitement par notre service juridique</p>
        @endif
    </div>
    @endforeach
    </div>

</x-app-layout>
