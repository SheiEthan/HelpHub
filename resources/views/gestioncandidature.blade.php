<link rel="stylesheet" type="text/css" href="/css/gestioncandidature.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des candidatures') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __(' Candidature') }}  
                </div>
        </div>
    </div>

    <div id="candidature">
        @foreach($candidatures as $candidature)
        <div class="res_candidature">
            <p id="user"> {{$candidature->utilisateur->user->name}} </p>
            <p id="desc"> {{$candidature->recherche_benevole->publication->titre_publication}} </p>
            <form action="/gestioncandidature/valider/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
                @csrf
                    <button id="butt" class="buttonv" name="buttonv" type="submit" > Valider Candidature </button>  
                </form>
            <form action="/gestioncandidature/refuser/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
                @csrf
                    <button id="butt" class="buttonr" name="buttonr" type="submit">  Refuser Candidature </button>    
            </form>
        </div>   
        @endforeach
    </div>





</x-app-layout>