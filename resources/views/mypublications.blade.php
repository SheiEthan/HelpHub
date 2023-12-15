
<link rel="stylesheet" type="text/css" href="/css/mypublication.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Actions') }}
            <div id="filtre">
                <x-input-label for="trie" :value="__('Trier :')" />
                <select  id="trie" name="trie"  value="{{ old('trie') }}"   autofocus autocomplete="trie" >
                    <option value="1">Tout</option>
                    <option value="2">Historique</option>
                    <option value="3">Don</option>
                    <option value="4">Benevolat</option>
                    <option value="5">Sauvegardé</option>

                        </select>
                <x-input-error class="mt-2" :messages="$errors->get('trie')" />
                </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __("Vos dernières actions") }}
                    </div>
                    </div>
                    <div id="res_recherche" >

    <script defer type = "module" src=" {{asset('js/mypublications.js')}}"> </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
        <p>Nous n'avez participé à aucune action.</p>
        @endif
    </div>

    <div name="like">
        @foreach ($publicationslike as $publication )
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
        <p>Nous n'avez participé à aucune action.</p>
        @endif
    </div>

    <div name="historique">
        @foreach ($publicationshistorique as $publication )
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
        <p>Nous n'avez participé à aucune action.</p>
        @endif
    </div>

    <div name="don">
        @foreach ($publicationsdon as $publication )
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
                    <p>Montant collecté: {{$publication->totmontant}} €</p>
                <div class="soutiens">
                    <p name="like" id="{{$publication->id_publication}}" class="like">🤍{{$publication->nblikes}}</p>
                </div>                            
            </div>            
        </div> 
        @endforeach
        @if($publications->count()==0)
        <p>Nous n'avez participé à aucune action.</p>
        @endif
    </div>

    <div name="benevole">
        @foreach ($publicationsbenevole as $publication )
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
                    <p>Bénévoles: {{$publication->benevoles}}</p>
                <div class="soutiens">
                    <p name="like" id="{{$publication->id_publication}}" class="like">🤍{{$publication->nblikes}}</p>
                </div>                            
            </div>            
        </div> 
        @endforeach
        @if($publications->count()==0)
        <p>Nous n'avez participé à aucune action.</p>
        @endif
    </div>

    




</x-app-layout>
