<link rel="stylesheet" type="text/css" href="/css/servicediffusionpublication.css"> 
<script defer type = "module" src=" {{asset('js/diffusionpublication.js')}}"> </script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Validation Publication') }}

        </h2>
    </x-slot>





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __(" Les publication à valider ") }}
                    <div id="filtre">
                    <x-input-label for="trie" :value="__('Trier :')" />
                    <select  id="trie" name="trie"  value="{{ old('trie') }}"   autofocus autocomplete="trie" >
                        <option value="5">Tout</option>
                        <option value="0">A valider</option>
                        <option value="1">Active</option>
                        <option value="2">Expiré</option>
                        <option value="3">Invisible</option>
                        <option value="4">Refusé</option>
                            </select>
                    <x-input-error class="mt-2" :messages="$errors->get('trie')" />
                    </div>

                </div>
        </div>
    </div>



    <!-- les publication a valider -->

    <div name="tout" id="res_recherche">
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
            <a id="voir" href="/publication/{{ $publication->id_publication}}"> voir plus </a>
        </div>
        <div class="infos"> 
            <p> Date de debut: {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p> 
            <p> ({{$publication->localisation->code_postal}}) {{$publication->localisation->ville}}, {{$publication->localisation->pays}}</p>                         
            @if(isset($publication->totmontant))    
                <p>Montant collecté: {{$publication->totmontant}} €</p>
            @elseif(isset($publication->benevoles))
                <p>Bénévoles: {{$publication->benevoles}}</p>
            @endif   

            @if($publication->etat_publication == 1)
            <form action="/servicediffusionpublication/valider/{{$publication->id_publication}}" method="post">
            @csrf
                 <button id="{{$publication->id_publication}}" class="buttonv" name="buttonv" type="submit" > Valider Publication </button>  
            </form>
          <form action="/servicediffusionpublication/refuser/{{$publication->id_publication}}" method="post">
             @csrf
                 <button id="{{$publication->id_publication}}" class="buttonr" name="buttonr" type="submit">  Refuser Publication </button>    
          </form>
          @elseif($publication->etat_publication !== 3 && $publication->etat_publication !== 4)
          <form action="/servicediffusionpublication/invisible/{{$publication->id_publication}}" method="post">
             @csrf
                 <button id="{{$publication->id_publication}}" class="buttonr" name="buttonr" type="submit">  rendre invisble </button>    
          </form>
          @endif
                                 
        </div>            
    </div> 
    @endforeach
   
    </div>


    <div name="etat0" id="res_recherche">
    @foreach ($publicationsv as $publication )
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
            <a id="voir" href="/publication/{{ $publication->id_publication}}"> voir plus </a>
        </div>
        <div class="infos"> 
            <p> Date de debut: {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p> 
            <p> ({{$publication->localisation->code_postal}}) {{$publication->localisation->ville}}, {{$publication->localisation->pays}}</p>                         
            @if(isset($publication->totmontant))    
                <p>Montant collecté: {{$publication->totmontant}} €</p>
            @elseif(isset($publication->benevoles))
                <p>Bénévoles: {{$publication->benevoles}}</p>
            @endif   

            <form action="/servicediffusionpublication/valider/{{$publication->id_publication}}" method="post">
            @csrf
                 <button id="{{$publication->id_publication}}" class="buttonv" name="buttonv" type="submit" > Valider Publication </button>  
            </form>
          <form action="/servicediffusionpublication/refuser/{{$publication->id_publication}}" method="post">
             @csrf
                 <button id="{{$publication->id_publication}}" class="buttonr" name="buttonr" type="submit">  Refuser Publication </button>    
          </form>
          <form action="/servicediffusionpublication/invisible/{{$publication->id_publication}}" method="post">
             @csrf
                 <button id="{{$publication->id_publication}}" class="buttonr" name="buttonr" type="submit">  rendre invisble </button>    
          </form>                  
        </div>            
    </div> 
    @endforeach
    </div>

    <div name="etat1" id="res_recherche">
    @foreach ($publicationsa as $publication )
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
            <a id="voir" href="/publication/{{ $publication->id_publication}}"> voir plus </a>
        </div>
        <div class="infos"> 
            <p> Date de debut: {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p> 
            <p> ({{$publication->localisation->code_postal}}) {{$publication->localisation->ville}}, {{$publication->localisation->pays}}</p>                         
            @if(isset($publication->totmontant))    
                <p>Montant collecté: {{$publication->totmontant}} €</p>
            @elseif(isset($publication->benevoles))
                <p>Bénévoles: {{$publication->benevoles}}</p>
            @endif   

          <form action="/servicediffusionpublication/invisible/{{$publication->id_publication}}" method="post">
             @csrf
                 <button id="{{$publication->id_publication}}" class="buttonr" name="buttonr" type="submit">  rendre invisble </button>    
          </form>                
        </div>            
    </div> 
    @endforeach
    </div>


    <div name="etat2" id="res_recherche">
    <div name="etat0" id="res_recherche">
    @foreach ($publicationse as $publication )
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
            <a id="voir" href="/publication/{{ $publication->id_publication}}"> voir plus </a>
        </div>
        <div class="infos"> 
            <p> Date de debut: {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p> 
            <p> ({{$publication->localisation->code_postal}}) {{$publication->localisation->ville}}, {{$publication->localisation->pays}}</p>                         
            @if(isset($publication->totmontant))    
                <p>Montant collecté: {{$publication->totmontant}} €</p>
            @elseif(isset($publication->benevoles))
                <p>Bénévoles: {{$publication->benevoles}}</p>
            @endif   
          <form action="/servicediffusionpublication/invisible/{{$publication->id_publication}}" method="post">
             @csrf
                 <button id="{{$publication->id_publication}}" class="buttonr" name="buttonr" type="submit">  rendre invisble </button>    
          </form>                  
        </div>            
    </div> 
    @endforeach
    </div>
    </div>


    <div name="etat3" id="res_recherche">
    @foreach ($publicationsi as $publication )
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
            <a id="voir" href="/publication/{{ $publication->id_publication}}"> voir plus </a>
        </div>
        <div class="infos"> 
            <p> Date de debut: {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p> 
            <p> ({{$publication->localisation->code_postal}}) {{$publication->localisation->ville}}, {{$publication->localisation->pays}}</p>                         
            @if(isset($publication->totmontant))    
                <p>Montant collecté: {{$publication->totmontant}} €</p>
            @elseif(isset($publication->benevoles))
                <p>Bénévoles: {{$publication->benevoles}}</p>
            @endif                                 
        </div>            
    </div> 
    @endforeach
    </div>


    <div name="etat4" id="res_recherche">
    @foreach ($publicationsr as $publication )
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
            <a id="voir" href="/publication/{{ $publication->id_publication}}"> voir plus </a>
        </div>
        <div class="infos"> 
            <p> Date de debut: {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p> 
            <p> ({{$publication->localisation->code_postal}}) {{$publication->localisation->ville}}, {{$publication->localisation->pays}}</p>                         
            @if(isset($publication->totmontant))    
                <p>Montant collecté: {{$publication->totmontant}} €</p>
            @elseif(isset($publication->benevoles))
                <p>Bénévoles: {{$publication->benevoles}}</p>
            @endif                                 
        </div>            
    </div> 
    @endforeach
    </div>




</x-app-layout>