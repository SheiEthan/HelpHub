<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vos informations Bancaire') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
        </div>
    </div>

    <div id="information">
    @foreach ($informations as $information )
    <div id="mesinfo">
        @if(null!== $information->carteBancaire->first() )
            <p>{{$information->carteBancaire->first()->nom_du_detenteur}} </p>
            <p>{{$information->carteBancaire->first()->numero_carte_bancaire}} </p>
            <p>{{$information->carteBancaire->first()->date_expiration}} </p>
            <p>{{$information->carteBancaire->first()->cvc}} </p>
        @endif
    </div>
    @endforeach

    </div>




</x-app-layout>
