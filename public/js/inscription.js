document.getElementById("formulaire_inscription").addEventListener("submit", function(event) {
    var password = document.getElementById("motdepasse_compte").value;
    var confirmPassword = document.getElementById("motdepasse_compteverif").value;
    var errorElement = document.getElementById("passwordMatchError");

    if (password !== confirmPassword) {
        errorElement.style.display = "block";
        event.preventDefault(); // Empêche l'envoi du formulaire si les mots de passe ne correspondent pas
    } else {
        errorElement.style.display = "none";
        // Si les mots de passe correspondent, le formulaire est envoyé normalement
    }
});
