@extends('layouts.page')

@section('title', 'Recherche - HelpHub')

@section('sidebar')
    @parent   


@endsection


@csrf
@section('content')
    <link rel="stylesheet" type="text/css" href="/css/recherche.css">
    <script defer type = "module" src=" {{asset('js/rechercher.js')}}"> </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!--  barre de recherche , filtre par localisation , filtre par date de debut -->
    <!-- <div id="filtre">
             <div id="filtreloc">
                <select name="id_localisation" id="id_localisation">
                    <option value="">--Choisi un localisation--</option>
                    
                </select>
             </div>
    </div> -->
    <div class="maDiv">
        <form action="/rechercher" class="filtre" id="filtres">
            @csrf
            <h2>Filtres : </h2>
            <div class="recherche">
                <label for="id_action"> Recherche : </label>
                <input list="title_list" id="searchbar" name="searchbar"  type="text"
                @if( isset($checked["search"]) )) 
                                value="{{$checked["search"]}}"
                            @endif 
                            />
                    <datalist id="title_list">
                        @foreach( $spublications as $publication )
                        <option value="{{$publication->titre_publication}}"></option>
                        @endforeach
                    </datalist>
            </div>

            <div class="recherche">
                <label for="motclef"> Mot clef : </label>
                <input list="motclef_list" id="id_motclef" name="id_motclef"  type="text"
                @if( isset($checked["motclef"]) )) 
                                value="{{$checked["motclef"]}}"
                            @endif 
                            />
                    <datalist id="motclef_list">
                        @foreach( $motclefs as $motclef )
                        <option value="{{$motclef->mot_clef}}"></option>
                        @endforeach
                    </datalist>
            </div>


            <ul class="collapsible">
                <li>
                    <span class="toggle noselect">▼ Thématiques :</span> <!-- icône de bascule, peut être personnalisée -->
                    <ul class="content">
                        @foreach($thematiques as $thematique)
                        <li >
                            <input name="id_thematique[]" type="checkbox" value="{{$thematique->id_thematique}}" 
                            
                            @if( isset($checked["thematiques"]) && in_array( $thematique->id_thematique,$checked["thematiques"])) 
                                checked
                            @endif 
                            />
                            <label for="scales">{{$thematique->titre_thematique}}</label>
                        </li>
                        @endforeach
                    </ul>
                </li>                
            </ul>

            <fieldset >
                <legend>Date:</legend>
                <div >
                    <label for="scales">Date debut : </label>
                    <input name="dateDebut" type="date" 
                    @if( isset($checked["datedeb"]) ) 
                        value="{{$checked["datedeb"]}}"
                    @endif 
                    />

                </div>

                <div >
                    <label for="scales">Date fin : </label>
                    <input name="dateFin" type="date"
                    @if( isset($checked["datefin"]) ) 
                        value="{{$checked["datefin"]}}"
                    @endif 
                     />

                </div>
            </fieldset>

            <ul class="collapsible">
                <li>
                    <span class="toggle noselect">▼ Associations :</span> <!-- icône de bascule, peut être personnalisée -->
                    <ul class="content">
                    @foreach($associations as $association)
                        <li>
                            <input name="id_association[]" type="checkbox" value="{{$association->id_association}}"
                            @if( isset($checked["associations"]) && in_array( $association->id_association,$checked["associations"])) 
                                checked
                            @endif 
                            />
                            <label for="scales">{{$association->nom_association}}</label>
                        </li>
                    @endforeach
                    </ul>
                </li>                
            </ul>

            <ul class="collapsible">
                <li>
                    <span class="toggle noselect">▼ Localisation :</span> <!-- icône de bascule, peut être personnalisée -->
                    <ul class="content">
                    @foreach($localisations as $localisation)
                        <li>
                            <input name="id_localisation[]" type="checkbox" value="{{$localisation->id_localisation}}"
                            @if( isset($checked["localisations"]) && in_array( $localisation->id_localisation,$checked["localisations"])) 
                                checked
                            @endif 
                            />
                            <label for="scales">{{$localisation->code_postal}}-{{$localisation->ville}}</label>
                        </li>
                    @endforeach
                    </ul>
                </li>                
            </ul>            

            <button  type="submit">  Rechercher  </button>  
            <button id="resetButton" type="button" onclick="resetCheckboxes()">Réinitialiser</button>
        </form>
        <div class="bene">
            <div class="titre">
                <h1 id="titrerech">Recherche</h1>
                <hr>
            </div>            
            <div id="res_recherche" >

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
                            <a  href="/publication/{{ $publication->id_publication}}"> voir plus </a>
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
                @if($publications->count()==0)
                <p>Nous avons trouvé aucunes publications correspondant à votre recherche.</p>
                @endif
            </div>
        </div>
    </div>
    
   

@endsection