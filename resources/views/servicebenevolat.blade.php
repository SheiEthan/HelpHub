
<link rel="stylesheet" type="text/css" href="/css/servicebenevolat.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Validation Candidatures') }}

        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __(" Les candidatures à valider :") }}

                </div>
        </div>
    </div>




        <div id="candidature">
        @foreach($candidatures as $candidature)
        <div class="res_candidature">
            <p id="user"> {{$candidature->utilisateur->user->name}} </p>
            <p id="desc"> {{$candidature->publication_recherche_benevole->publication->titre_publication}} </p>
            <form action="/servicebenevolat/valider/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
                @csrf
                    <button id="butt" class="buttonv" name="buttonv" type="submit" > Valider Candidature </button>  
                </form>
            <form action="/servicebenevolat/refuser/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
                @csrf
                    <button id="butt" class="buttonr" name="buttonr" type="submit">  Refuser Candidature </button>    
            </form>
            <form action="/servicebenevolat/information/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
                @csrf
                    <x-input-label for="information_suplementaire" :value="__('Informations suplémentaires :')" />
                    <x-text-input id="information_suplementaire" name="information_suplementaire" type="text" class="mt-1 block w-full"  value="{{ old('information_suplementaire') }}" required autofocus autocomplete="information_suplementaire" />
                    <x-input-error class="mt-2" :messages="$errors->get('information_suplementaire')" />
                    <button id="" class="buttonr" name="buttonr" type="submit">  Envoyer demande d'information suplémentaire</button>    
            </form>
            <form action="/servicebenevolat/juridique/{{$candidature->id_utilisateur}}/{{$candidature->id_recherche_benevole}}" method="post">
                @csrf
                    <button id="" class="buttonr" name="buttonr" type="submit">  Demande d'information juridique </button>    
            </form>
          
        </div>
        @endforeach

        </div>





</x-app-layout>