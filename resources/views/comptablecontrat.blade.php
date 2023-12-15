<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des contrat') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
        </div>
    </div>


    <form class="form" method="post" action="/comptablecontrat/contrat">
            @csrf
            <div class="group">
            <select id="asso_list" name="asso_list">
                        @foreach( $associations as $association )
                        <option value="{{$association->id_association}}"> {{$association->nom_association}} </option>
                        @endforeach
            </select>

            <label for="iban_text">Iban de l'association :</label>
            <input name="iban_text" id="iban_text" class="form-control" required></input>
            </div>
                <button type="submit">Faire le virement </button>
        </form>

</x-app-layout>
