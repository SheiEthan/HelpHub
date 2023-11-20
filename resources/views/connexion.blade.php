<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/connexion.css">
    <title>Connexion</title>

</head>



<body>
    
    
    <div class="login-container">
        <div class="login-header">
            <h2>Connexion</h2>
        </div>
        <div class="login-body">
            <form>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div id="mdpoublie">
                    <a href="/">Mot de passe oublié ?</a>
                </div>
                <div class="form-group">
                    <button type="submit">Se Connecter</button>
                </div>
                <div id="inscription"> 
                    <a href="/inscription"> Inscription </a>
                </div>
            </form>
        </div>
       
       
    </div>




</body>
</html>