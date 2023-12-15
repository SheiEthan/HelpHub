<link rel="stylesheet" type="text/css" href="/css/createassociation.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Creation de association') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informations de votre association') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Saisir les informations de votre association.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" >
        @csrf
    </form>





    <form method="post" action="{{ route('createassociation') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf


        <div>
            <x-input-label for="nom_association" :value="__('Nom de votre association :*')" />
            <x-text-input id="nom_association" name="nom_association" type="text" class="mt-1 block w-full"  value="{{ old('nom_association') }}" required autofocus autocomplete="nom_association" />
            <x-input-error class="mt-2" :messages="$errors->get('nom_association')" />
        </div>

        <div>
            <x-input-label for="siteweb_association" :value="__('Siteweb :')" />
            <x-text-input id="siteweb_association" name="siteweb_association" type="text" class="mt-1 block w-full" value="{{ old('siteweb_association') }}"  autofocus autocomplete="siteweb_association" />
            <x-input-error class="mt-2" :messages="$errors->get('siteweb_association')" />
        </div>

        <div>
            <x-input-label for="description_association" :value="__('Description :*')" />
            <x-text-input id="description_association" name="description_association" type="text" class="mt-1 block w-full" value="{{ old('description_association') }}"  required autofocus autocomplete="description_association" />
            <x-input-error class="mt-2" :messages="$errors->get('description_association')" />
        </div>

        <div>
            <x-input-label for="numerotelephone_association" :value="__('Téléphone :*')" />
            <x-text-input id="numerotelephone_association" name="numerotelephone_association" type="tel" pattern="0[4-7]{1}[0-9]{8}" placeholder="0123456789"  class="mt-1 block w-full" :value="old('numerotelephone_association')"  autofocus autocomplete="numerotelephone_association" />
            <x-input-error class="mt-2" :messages="$errors->get('numerotelephone_association')" />
        </div>
        <div>
            <p class="champs" >* Champs obligatoires</p>
        </div>




            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Créer') }}</x-primary-button>
            </div>
    </form>
</section>
<script defer type = "module" src=" {{asset('js/createpublication.js')}}"> </script>
</x-app-layout>



