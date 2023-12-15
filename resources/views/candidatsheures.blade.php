<link rel="stylesheet" type="text/css" href="/css/gestionHeure.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Votre Compte') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900 dark:text-gray-100">

                </div>

                <h2 id="title"> Détails de la publication : </h2>
    <div id="detailpub">
        <h2 class="titreannonce"> {{ $publication->titre_publication}} </h2>
        <div class="caroussel">
            <div class="medias">
            @if(null !== $publication->medias->first())
                @foreach($publication->medias as $media)
                    <img class="imgmedia" src="/img/{{$media->lien_media}}" >
                @endforeach
            @else
                <img class="imgmedia" src="/img/image0.jpg" >
            @endif
            
            </div>
        </div>
        <div class="info">
            <p> Date de début : {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p> 
            <p> Lieu : ({{$publication->localisation->code_postal}}) {{$publication->localisation->ville}}, {{$publication->localisation->pays}}</p>
            <p id="description"> {{$publication->description_publication}} </p> 
            @if(null !== $publication->information_don->first())    
                <p>Montant collecté: {{$publication->totmontant }} / {{$publication->information_don->first()->objectif}} €</p>
                <progress value="{{$publication->totmontant }}" max="{{$publication->information_don->first()->objectif}}"></progress>
            @elseif(isset($publication->benevoles))
                <p>
                    Bénévoles: {{$publication->benevoles}}
                </p>
                @if(null !== $publication->recherche_benevole->first()->frequence->first())
                <p>
                    Du {{$publication->date_debut->format('d-m-Y')}} 
                    au {{$publication->date_fin->format('d-m-Y')}},
                    nous recherchons des bénévoles tous les {{$publication->recherche_benevole->first()->frequence->first()->jour}}s 
                    de : {{$publication->recherche_benevole->first()->frequence->first()->plage_horraire}}.
                </p>
                @elseif(null !== $publication->recherche_benevole->first()->planifier->first())
                <p>
                    Le {{$publication->recherche_benevole->first()->planifier->first()->datepl->format('d-m-Y')}}, 
                    nous recherchons des bénévoles de {{$publication->recherche_benevole->first()->planifier->first()->heure_debut->format('H')}}h
                    à {{$publication->recherche_benevole->first()->planifier->first()->heure_fin->format('H')}}h.
                </p>
                @endif
            @endif
            <p id="datepubli" > Date de publication : {{$publication->date_saisi->format('d-m-Y')}} </p>  

            <div class="commentaire">

            @if($publication->recherche_benevole->first()->candidatures->first() !== null)
                <form action="/gestionheures/{{ $publication->id_publication}}" method="post">
                    @csrf
                    @foreach($publication->recherche_benevole->first()->candidatures as $candidature)
                        <div class="divComm">
                            <div class="comm">
                                <p id="commEnGras">{{$candidature->utilisateur->nom_utilisateur}} {{$candidature->utilisateur->prenom_utilisateur}} </p>
                                <x-input-label for="{{'heures'.$candidature->id_utilisateur.'-'.$candidature->num_semaine}}" :value="__('Heures :')" />
                                <x-text-input id="{{'heures'.$candidature->id_utilisateur.'-'.$candidature->num_semaine}}" name="{{'heures'.$candidature->id_utilisateur.'-'.$candidature->num_semaine}}" type="number"   value="{{$candidature->heures}}"   autocomplete="{{'heures'.$candidature->id_utilisateur.'-'.$candidature->num_semaine}}" />
                                <x-input-error class="mt-2" :messages="$errors->get('{{heures.$candidature->id_utilisateur.-.$candidature->num_semaine}}')" />
                            </div> 
                        </div>                               
                    @endforeach
                    <div class="flex items-center gap-4 mt-4">
                        <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>
                    </div>
                </form>
            @else 
                <p>Pas de candidatures</p>
            @endif
        </div>
        </div>
    </div>

</x-app-layout>
