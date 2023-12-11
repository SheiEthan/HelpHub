@extends('layouts.page')

@section('title', 'Publication - HelpHub')

@section('sidebar')
    @parent   


@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="/css/publication.css">
    <script defer type = "module" src="{{asset('js/publication.js')}}"> </script>
    <script defer src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <h2> Détails de la publication : </h2>
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
            <p id="{{$publication->id_publication}}" name="plike" class="emoji">🤍{{$publication->nblikes}}</p>



            <!-- button pour les candidature  -->
            @if(Auth::user())
                        @auth
                            @if(null!==$publication->recherche_benevole->first())
                                @if(!$candidat)
                                <form action="/publication/candidature/{{$publication->recherche_benevole->first()->id_publication}}" method="post">
                                @csrf
                                    <button class="btnC" type="submit"> Poser une candidature</button>
                                </form>
                                @else 
                                <p>Vous avez posé une candidature. <a id="candidature" href="/mycandidatures">En voir plus sur ma demande.</a></p>
                                @endif
                            @endif
                        @endauth
                    @else
                        <p> Vous devez être connecté pour pouvoir poser une candidature <a href={{ url("/dashboard") }}> Se connecter </a> </p>
            @endif

            <div id="map">
                <iframe src="https://maps.google.com/maps?&q= +{{$publication->localisation->ville}}&output=embed" width="100%" height="500"></iframe>
            </div>  

            <!-- les commentaire -->
            <div class="commentaires">
                <div id="formulairecommentaire">
                @if(Auth::user())
                        @auth
                        <!-- Formulaire de commentaire -->
                        <form class="form" method="post" action="/publication/commentaire/{{$publication->id_publication}}">
                            @csrf
                        <div class="group">
                                <label for="comment_text">Commentaire :</label>
                                <textarea name="comment_text" id="comment_text" class="form-control" required></textarea>
                         </div>
                             <button type="submit">Déposer</button>
                        </form>
                        @endauth
                    @else
                        <p> Vous devez être connecté pour déposer un commentaire, liker et signaler. <a href={{ url("/dashboard") }}> Se connecter </a> </p>
                       
                @endif
                </div>
                <div class="commentaire">

                    @if($publication->commentaires->first() !== null)
                        
                            @foreach($publication->commentaires as $commentaire)
                                <div class="divComm">
                                    <div class="comm">
                                        <p id="commEnGras">{{$commentaire->user->name}} a écrit : </p>
                                        <p>{{$commentaire->description_commentaire}}</p>
                                    </div> 
                                    <div>
                                        <p name="like" id="{{$commentaire->id_commentaire}}" class="emoji">🤍{{$commentaire->nblikes}}</p>
                                        <p class="noemoji">likes</p>
                                        <p name="signal" id="{{$commentaire->id_commentaire}}" class="emoji">🏳️</p>
                                        <p class="noemoji">Signaler</p>
                                    </div>                       
                                </div>                               
                            @endforeach
                    @else 
                        <p>Pas de commentaires</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="trucComm"></div>
   

@endsection

