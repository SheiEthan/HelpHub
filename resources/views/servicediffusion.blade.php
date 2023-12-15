 <link rel="stylesheet" type="text/css" href="/css/servicediffusion.css"> 
 <script defer type = "module" src="{{asset('js/servicediffusion.js')}}"> </script>  
 <script defer src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des Commentaires') }}

        </h2>
    </x-slot>





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __(" Les commentaires signalés") }}

                </div>
        </div>
    </div>

      
    <!-- les commentaire signaler -->

    <div id="voircommentaire">

        @foreach($commentaires as $commentaire)
        <div id = "d{{$commentaire->id_commentaire}}"class="commentaire">
        <p id="commEnGras">{{$commentaire->user->name}} a écrit : </p>
        
            @csrf
            <label name="com" value="{{$commentaire->id_commentaire}}"> {{$commentaire->description_commentaire}} </label>
            <p for="">Nombre de signals : {{$commentaire->nbsignals}}</p>
            <button id="{{$commentaire->id_commentaire}}" class="buttonc" name="buttonc"  > Supprimer Commentaire </button>        
        </div>
        @endforeach
    </div>
   


</x-app-layout>