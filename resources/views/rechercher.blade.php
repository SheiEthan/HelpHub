<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <article>
    @foreach ($publications as $publication )
    <p value="{{ $action->id_publication }}"> {{ $publication->titre_publication}} </p>
    @endforeach
    </article>

</body>
</html>