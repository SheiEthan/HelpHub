<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>HelpHub</title>
</head>
<body>
    <header>
    	<h1>HelpHub</h1>
        <h2>Bénévolat</h2>
        <img id="fleche" src="/img/fleche.png">
    </header>
    
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



    <article  id="recherche_action">
    
    <label for="thematque"> Indiquer la date </label>
    <input type="search" id="action-search" name="recherchea" />
    
     <label for="thematque">Choisissez une thématique :</label>
        @csrf
        <select name="thematique" id="thematique">
           <option>Thématiques</option>
            @foreach ($thematiques as $thematique)               
            <option value="{{ $thematique->id_thematique }}">{{ $thematique->titre_thematique }} </option>
            @endforeach
        </select>   

    <button> <a href={{ url("/rechercher") }}> Rechercher </a> </button> 
    
    </article>
</body>
</html>