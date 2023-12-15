<link rel="stylesheet" type="text/css" href="/css/servicebenevolat.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Votre Compte') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __(" Les Informartions juridique ") }}
                </div>
        </div>
    </div>


    <div id="info">
    @foreach($candidatures as $candidature)
        <div class="res_candidature">

            <p id="user"> Nom : {{$candidature->utilisateur->nom_utilisateur}} </p>
            <p id="user"> Prenom : {{$candidature->utilisateur->prenom_utilisateur}} </p>
            <p id="user"> id utilidateur  : {{$candidature->utilisateur->id_utilisateur}} </p>
            <p id="user"> id pub : {{$candidature->recherche_benevole->publication->id_publication}} </p>
            <p id="desc"> Titre de la publication : {{$candidature->recherche_benevole->publication->titre_publication}} </p>
            <form action="/servicejuridique/valider/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
                @csrf
                    <button id="butt" class="buttonv" name="buttonv" type="submit" > Valider Candidature </button>  
                </form>
            <form action="/servicejuridique/refuser/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
                @csrf
                    <button id="butt" class="buttonr" name="buttonr" type="submit">  Refuser Candidature </button>    
            </form>
        
        
        
        </div>
    @endforeach
    
    </div>

</x-app-layout>
