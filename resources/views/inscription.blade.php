

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/inscription.css">
    <title>Inscription</title>
</head>




<body>
    <script src="/js/inscription.js" defer ></script>
<header id="header">  

       <h1 id="titre-connexion"> HelpHub </h1>
       <a href="/">🏠</a>  

</header>

<div class="register-container">
        <div class="register-header">
            <h2>Inscription</h2>
        </div>
        <div class="register-body">
            <form id="formulaire_inscription" method="post"  action='/inscription' >
                @csrf
                <div class="form-group">
                    <label for="prenom_utilisateur">Prénom:</label>
                    <input type="text" id="prenom_utilisateur" name="prenom_utilisateur" required>
                    @error('prenom_utilisateur')
                    {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nom_utilisateur">Nom de famille:</label>
                    <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
                    @error('nom_utilisateur')
                    {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Pseudo:</label>
                    <input type="pseudo" id="name" name="name" required>
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mail_compte">E-mail:</label>
                    <input type="email" id="mail_compte" name="mail_compte" required>
                    @error('mail_compte')
                    {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="motdepasse_compte">Mot de passe:</label>
                    <input type="password" id="motdepasse_compte" name="motdepasse_compte" minlength=16 required>
                    @error('motdepasse_compte')
                     {{$message}}
                    @enderror
                </div>                
                <div class="form-group">
                    <label for="motdepasse_compteverif">Confirmer mot de passe:</label>
                    <input type="password" id="motdepasse_compteverif" name="motdepasse_compteverif" minlength=16 required>
                    <p id="passwordMatchError" style="display: none; color: red;">Les mots de passe ne correspondent pas.</p>
                    @error('motdepasse_compteverif')
                     {{$message}}
                    @enderror
                </div>
                <div class="form-group checkbox">
                <p>Je souhaite recevoir des mises à jour sur les campagnes.</p>
                    <div class="checkbox-group">
                        <label for="yes">Oui</label>
                        <input type="radio" id="yes" name="updates" value="yes" checked>
                        <label for="no">Non</label>
                        <input type="radio" id="no" name="updates" value="no">
                    </div>
                   
                </div>
                <div class="form-group">
                    <button type="submit">S'Inscrire</button>
                </div>
            </form>

            <div class="or-divider">
                <hr>
                <span>OU</span>
                <hr>
            </div>

            <button class="google-button">S'Inscrire avec Google</button>
        </div>
    </div>


</body>
</html>