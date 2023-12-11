<link rel="stylesheet" type="text/css" href="/css/servicediffusionpublication.css"> 

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

                </div>
        </div>
    </div>



    <!-- les publication a valider -->

    <div id="res_recherche">
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
            <form action="/servicediffusionpublication/valider/{{$publication->id_publication}}" method="post">
            @csrf
                 <button id="{{$publication->id_publication}}" class="buttonv" name="buttonv" type="submit" > Valider Publication </button>  
            </form>
          <form action="/servicediffusionpublication/refuser/{{$publication->id_publication}}" method="post">
             @csrf
                 <button id="{{$publication->id_publication}}" class="buttonr" name="buttonr" type="submit">  Refuser Publication </button>    
          </form>
                                 
        </div>            
    </div> 
    @endforeach
   
    </div>




</x-app-layout>