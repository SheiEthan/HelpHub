<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>


        <link rel="stylesheet" type="text/css" href="{{asset('css/layouts.css')}}"/>   

    </head>


    <body>

    	<header>
    		<h1 class="title1">HelpHub</h1>            
    	</header>

        <a href="/" class="logo">
            <x-application-logo class="imag"/>
        </a>

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

        <div class="container">
            @yield('content')
        </div>

        <footer>
            <nav>
                <ul class="ulfooter" style="margin-bottom: 10px;">
                    <li class="lifooter">
                        <a href="/" title="Devenir Bénévole">Devenir Bénévole</a>
                    </li>
                    <li classe="lifooter">
                        <a href="/" title="Devenir Bénévole">Chercher Bénévoles</a>
                    </li>
                </ul>
                <small class="droit">Copyright © 2023 HelpHub.fr. Tous droits réservés.</small>
            </nav>  
        </footer>

    </body>
</html>