<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <script defer type = "module" src=" {{asset('js/welcome.js')}}"> </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>HelpHub</title>
    @cookieconsentscripts
</head>
<body>
    <header>
      
   

    	<h1>HelpHub</h1>
        <h2>Bénévolat</h2> 
        <img id="fleche" src="/img/fleche.png">
    </header>
    @cookieconsentview
    
    <input type="checkbox" id="burger-checkbox" class="burger-checkbox">
    <label for="burger-checkbox" class="burger">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </label>
    <div class="character"></div>
    <nav class="menu">
        <ul>
            <li><a href={{ url("/") }}>Accueil</a></li>
            <li><a href={{ url("/dashboard") }}>Mon Compte</a></li>

            <li><a href="#">Contact</a></li>
        </ul>
    </nav>


    <div id="barre">
        <form  id="recherche_action" method='post' action =/rechercher>
        
        <h2 id="titrerecherche" >Recherche</h2>
        <br>
        <div id="barre2">
        <label for="id_action"> Recherche : </label>
                <input list="title_list" id="searchbar" name="searchbar"  type="text"/>
                    <datalist id="title_list">
                        @foreach( $spublications as $publication )
                        <option value="{{$publication->titre_publication}}"></option>
                        @endforeach
                    </datalist>

                @csrf
            
        
            <button id="btrechercher" type="submit"> Rechercher  </button>
        </div>     
        </form>
    </div>

    <h2 id="dernierepub"> LES DERNIERES PUBLICATIONS : </h2>
    <div id="lespub">
        @foreach ($publications3 as $publication )
            <div id="res_pub" >
                <div class="divphoto">
                    @if(null !== $publication->medias->first())
                        <img class="imgphoto" src="/img/{{$publication->medias->first()->lien_media}}" >
                    @else
                        <img class="imgphoto" src="/img/image0.jpg" >
                    @endif
                </div>
                <h2 value="{{ $publication->id_publication }}"> {{ $publication->titre_publication}} </h2>
                <p> Date de debut: {{$publication->date_debut->format('d-m-Y')}} / Date de fin :  {{$publication->date_fin->format('d-m-Y')}} </p>  
                <a href="/publication/{{ $publication->id_publication}}"> voir plus </a>        
                <div class="infos"> 
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
    </div>


    <footer>
        <nav>
            <ul class="ulfooter" style="margin-bottom: 10px;">
                <li class="lifooter">
                    <a href="/dashboard" title="Devenir Bénévole">Devenir Bénévole</a>
                </li>
                <li classe="lifooter">
                    <a href="/" title="Devenir Bénévole">Chercher Bénévoles</a>
                </li>
                <li><a href="/cookies">Page cookies</a></li>
                <li><a href="/politiquesprotec">Politiques de confidentialité</a></li>
            </ul>
            <small class="droit">Copyright © 2023 HelpHub.fr. Tous droits réservés.</small>
        </nav>        
    </footer>
</body>
</html>