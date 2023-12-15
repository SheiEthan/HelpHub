<link rel="stylesheet" type="text/css" href="/css/comptabledon.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion don') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
        </div>
    </div>


    <div id="montant">
    @foreach($associations as $association)
        <div>
        <p>{{$association->nom_association}}</p>    
        <p for="">Montant Don du dernier mois  : {{$association->tot_mois }} </p>
        </div>
     @endforeach
    </div>

    <div id="virement">
        <h2> Virement vers une association : </h2>
                            <!-- Formulaire de commentaire -->
        <form class="form" method="post" action="">
            @csrf
            <div class="group">
            <label for="nom_text">nom de l'association :</label>
            <input name="nom_text" id="nom_text" class="form-control" required></input>
            <label for="iban_text">Iban de l'association :</label>
            <input name="iban_text" id="iban_text" class="form-control" required></input>
            <label for="montant_text">Montant :</label>
            <input name="montant_text" id="montant_text" class="form-control" required></input>
            </div>
                <button type="submit">Faire le virement </button>
        </form>

    </div>


</x-app-layout>
