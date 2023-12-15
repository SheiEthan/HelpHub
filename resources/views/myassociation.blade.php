    <link rel="stylesheet" type="text/css" href="/css/myassociation.css">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Association') }}
                <div id="filtre">
                    <x-input-label for="trie" :value="__('Trier :')" />
                    <select  id="trie" name="trie"  value="{{ old('trie') }}"   autofocus autocomplete="trie" >
                    <option value="5">Tout</option>
                        <option value="1">En cours de vérification</option>
                        <option value="2">Active</option>
                        <option value="3">Invisible</option>
                        <option value="4">Refusé</option>
                            </select>
                    <x-input-error class="mt-2" :messages="$errors->get('trie')" />
                    </div>
            </h2>
        </x-slot>

        <div class="py-12">
        <script defer type = "module" src=" {{asset('js/associationpublications.js')}}"> </script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">


                        @if (session('status') === 'publication-updated')

                                    {{ __('Détails de la publication mise à jour !') }}
                    @else
                    {{ __("Votre association") }}
                     @endif
                    </div>
            </div>
            <div class="bouton">
                <x-nav-link :href="route('infopublication')" class="bout" >Faire une publication</x-nav-link>
            </div>
            <div name="etat1">
            @foreach ($publications as $publication )
            @if($publication->etat_publication==1)

                <div id="res_pub" >
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
                                <a  href="/publication/editer/{{ $publication->id_publication}}"> editer </a>
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
                                    <p></p>
                                </div>                            
                            </div>            
                    </div> 

                @endif
                @endforeach
                </div>
                <div name="etat2">
                @foreach ($publications as $publication )
            @if($publication->etat_publication==2)

                <div id="res_pub" >
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
                                <a  href="/publication/editer/{{ $publication->id_publication}}" class="voir"> editer </a>
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
                                    <p></p>
                                </div>                            
                            </div>            
                    </div> 

                @endif
                @endforeach
                </div>
            <div name="etat3">
            @foreach ($publications as $publication )
            @if($publication->etat_publication==3)

                <div id="res_pub" >
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
                                <a class="voir" href="/publication/{{ $publication->id_publication}}" class="voir"> voir plus </a>
                                <a  href="/publication/editer/{{ $publication->id_publication}}" class="voir"> editer </a>
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
                                    <p></p>
                                </div>                            
                            </div>            
                    </div> 
                
                @endif
                @endforeach
                </div>
                <div name="etat4">
                @foreach ($publications as $publication )
            @if($publication->etat_publication==4)

                <div id="res_pub" >
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
                                <a  href="/publication/editer/{{ $publication->id_publication}}" class="voir"> editer </a>
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
                                    <p></p>
                                </div>                            
                            </div>            
                    </div> 

                @endif
                @endforeach
                </div>
                <div name="etat5">
                @foreach ($publications as $publication )

                <div id="res_pub" >
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
                                <a  href="/publication/editer/{{ $publication->id_publication}}" class="voir"> editer </a>
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
                                    <p></p>
                                </div>                            
                            </div>            
                    </div> 


                @endforeach
                </div>

            @if($publications->count()==0)
                    <p>Vous n'avez pas encore publié d'actions.</p>
                    @endif 
        </div>

    </x-app-layout>
