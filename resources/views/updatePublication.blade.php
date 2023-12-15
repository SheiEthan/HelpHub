<x-app-layout>

<link rel="stylesheet" type="text/css" href="/css/updatepublication.css">
    <script defer type = "module" src=" {{asset('js/updatepublication.js')}}"> </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2> Détails de la publication : </h2>
                <form method="post" action="{{$publication->id_publication}}" class="mt-6 space-y-6" enctype="multipart/form-data">    
            @csrf
    <div id="detailpub">
        <h1 class="titreannonce"> {{ $publication->titre_publication}} </h1>
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
                <div id="don">
                    <x-input-label for="montant_minimum" :value="__('Montant minimum par don ( en €) :*')" />
                    <x-text-input id="montant_minimum" name="montant_minimum" type="text" value="{{ $publication->information_don->first()->montant_minimum }}"  autofocus autocomplete="montant_minimum" />€
                    <x-input-error class="mt-2" :messages="$errors->get('montant_minimum')" />

                    <x-input-label for="objectif" :value="__('Objectif de don (en €) :*')" />
                    <x-text-input id="objectif" name="objectif" type="text" value="{{$publication->information_don->first()->objectif }}"  autofocus autocomplete="objectif" />€
                    <x-input-error class="mt-2" :messages="$errors->get('objectif')" />
                </div>
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
        </div>

        <div>
            <ul class="collapsible">
                        <li>
                            <span class="toggle noselect">▼ Thématiques :</span> <!-- icône de bascule, peut être personnalisée -->
                            <ul  class="content">
                                @foreach($thematiques as $thematique)
                                <li >
                                    <input name="id_thematique[]" type="checkbox" value="{{$thematique->id_thematique}}"
                                    @foreach($publication->thematiques as $thematiquep)
                                    @if($thematiquep->id_thematique==$thematique->id_thematique)
                                        checked
                                    @endif
                                    @endforeach 
                                    />
                                    <label for="scales">{{$thematique->titre_thematique}}</label>
                                </li>
                                @endforeach
                            </ul>
                        </li>                
                    </ul>
        </div>
            
        <div>
            <ul class="collapsible">
                <li>
                    <span class="toggle noselect">▼ Mots clefs :</span> <!-- icône de bascule, peut être personnalisée -->
                    <ul  class="content">
                        @foreach($motclefs as $motclef)
                            <li >
                                <input name="id_motclef[]" type="checkbox" value="{{$motclef->id_mot_clef}}" 
                                @foreach($publication->mot_clefs as $mot_clef)
                                    @if($mot_clef->id_mot_clef==$motclef->id_mot_clef)
                                        checked
                                    @endif
                                @endforeach
                                />
                                <label for="scales">{{$motclef->mot_clef}}</label>
                            </li>
                        @endforeach
                        </ul>
                </li>                
            </ul>
        </div>
            
        <div class="container">
            <!-- Input element to choose images -->
            <input name="medias[]" type="file" id="select-image" accept="image/*,video/*"  multiple>
            <label id="labimage" for="select-image">
                <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1344 1472q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28h-1472q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h427q21 56 70.5 92t110.5 36h256q61 0 110.5-36t70.5-92h427q40 0 68 28t28 68zm-325-648q-17 40-59 40h-256v448q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-448h-256q-42 0-59-40-17-39 14-69l448-448q18-19 45-19t45 19l448 448q31 30 14 69z" />
                </svg>
                Choisir Images
            </label>

            <div class="preview_image">
                <!-- It will show the total number of files selected -->
                <p><span id="total-images">0</span> fichier(s) selectionné(s)</p>
                <!-- All images will display inside this div -->
                <div id="images"></div>
            </div>
        </div>
        </div>

        <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Mettre a jour') }}</x-primary-button>
            </div>
        </form>
    </div>


</x-app-layout>
