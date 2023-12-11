<link rel="stylesheet" type="text/css" href="/css/mypublication.css">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Association') }}
    
            </h2>
        </x-slot>

        <div class="py-12">
        <script defer type = "module" src=" {{asset('js/associationpublications.js')}}"> </script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        {{ __("Votre association") }}
                    </div>
            </div>
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
                                <a class="voir" href="/gestionheures/{{ $publication->id_publication}}"> voir plus </a>
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
            @if($publications->count()==0)
                    <p>Nous avons trouvé aucunes publications correspondant à votre recherche.</p>
                    @endif 
        </div>

    </x-app-layout>
