<link rel="stylesheet" type="text/css" href="/css/myassociation.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vos alertes') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/myalertes" method="post">
                        @csrf
                    <div class="recherche">
                        <x-input-label for="id_motclef" :value="__( 'Mot clef : ')" />
                        <select name="id_motclef" id="id_motclef">
                            @if(isset(Auth::User()->alerte->id_mot_clef)) 
                               <option value="{{ Auth::User()->alerte->id_mot_clef }}">{{Auth::User()->alerte->mot_clef->mot_clef}}</option>
                            <option value=""></option>
                            @else
                            <option value="">--Choisir un mot clef--</option>
                            @endif
                                @foreach( $motclefs as $motclef )
                                <option value="{{$motclef->id_mot_clef}}" >{{$motclef->mot_clef}}</option>
                                @endforeach
                            </select>

                        <x-input-error class="mt-2" :messages="$errors->get('id_motclef')" />


                            <x-input-label for="id_association" :value="__( 'Association : ')" />
                            <select id="id_association" name="id_association">
                                @if(isset(Auth::User()->alerte->id_association)) 
                                <option value="{{ Auth::User()->alerte->id_association}}">{{Auth::User()->alerte->association->nom_association}}</option>
                                <option value=""></option>
                                @else
                                <option value="">--Choisir une association--</option>
                                @endif
                                @foreach( $associations as $association )
                                <option value="{{$association->id_association}}">{{$association->nom_association}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('id_association')" />


                            <x-input-label for="id_localisation" :value="__( 'Localisation : ')" />
                            <select id="id_localisation" name="id_localisation">
                            @if(isset(Auth::User()->alerte->id_localisation)) 
                                <option value="{{ Auth::User()->alerte->id_localisation}}">{{Auth::User()->alerte->localisation->code_postal}} - {{Auth::User()->alerte->localisation->ville}} - {{Auth::User()->alerte->localisation->pays}}</option>
                                <option value=""></option>
                                @else
                                <option value="">--Choisir une localisation--</option>
                                @endif
                                @foreach( $localisations as $localisation )
                                <option value="{{$localisation->id_localisation}}">{{$localisation->code_postal}} - {{$localisation->ville}} - {{$localisation->pays}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('id_localisation')" />


                            <x-input-label for="id_thematique" :value="__( 'Thematique : ')" />
                            <select id="id_thematique" name="id_thematique">
                            @if(isset(Auth::User()->alerte->id_thematique)) 
                                <option value="{{ Auth::User()->alerte->id_thematique}}">{{Auth::User()->alerte->thematique->titre_thematique}}</option>
                                <option value=""></option>
                                @else
                                <option value="">--Choisir un  thématique--</option>
                                @endif
                                @foreach( $thematiques as $thematique )
                                <option value="{{$thematique->id_thematique}}">{{$thematique->titre_thematique}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('id_localisation')" />


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>
                            </div>
                    </div>
                    </form>
                </div>
        </div>
        <div name="tout">
        @foreach ($publications as $publication )
        <div name="{{$publication->id_publication}}" id="res_pub" >
            <div class="divphoto">
                @if(null !== $publication->medias->first())
                    <img class="imgphoto" src="/img/{{$publication->medias->first()->lien_media}}" >
                @else
                    <img class="imgphoto" src="/img/image0.jpg" >
                @endif
            </div>
            <div class="infotitre">
                <h2 id="titrepubli" value="{{ $publication->id_publication }}"> {{ $publication->titre_publication}} </h2>
                <p> {{$publication->resume}}</p>
                <a class="voir" href="/publication/{{ $publication->id_publication}}"> voir plus </a>
            </div>
            <div class="infos"> 
                <p> Date de debut: {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p> 
                <p> ({{$publication->localisation->code_postal}}) {{$publication->localisation->ville}}, {{$publication->localisation->pays}}</p>                         
                @if(isset($publication->totmontant))    
                    <p>Montant collecté: {{$publication->totmontant}} €</p>
                @elseif(isset($publication->benevoles))
                    <p>Bénévoles: {{$publication->benevoles}}</p>
                @endif
                <div class="soutiens">
                    <p name="like" id="{{$publication->id_publication}}" class="like">🤍{{$publication->nblikes}}</p>
                </div>                            
            </div>            
        </div> 
        @endforeach
        @if($publications->count()==0)
        <p>Aucune action correspond a votre recherche.</p>
        @endif
    </div>
    </div>

</x-app-layout>
