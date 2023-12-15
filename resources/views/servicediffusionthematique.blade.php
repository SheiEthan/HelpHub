<link rel="stylesheet" type="text/css" href="/css/servicediffusionthematique.css"> 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter des thematique ') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __('Ajouter Thématiques') }}
                </div>
                <div>
                    <form class="form" method="post" action="/servicediffusionthematique/thematique">
                            @csrf
                        <div class="group">
                                <label id="label1" for="thematique_text"> Ajouter une thématique :</label>
                                <textarea name="thematique_text" id="thematique_text" class="form-control" required></textarea>
                         </div>
                             <button id="button" type="submit">Ajouter la Thématique </button>
                    </form>

            </div>
                
                
            <div id="affichethematique">
            <h2> Les thématiques présentes : </h2>
                @foreach($thematiques as $thematique)
                            
                            <p for="scales">{{$thematique->titre_thematique}}</p>
                     
                @endforeach


            </div>     
        </div>

        
    </div>                                  <!-- Formulaire de commentaire -->
                  
                       

</x-app-layout>
