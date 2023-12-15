

document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner tous les éléments avec la classe "collapsible"
    var collapsibles = document.querySelectorAll('.collapsible > li');

    // Parcourir tous les éléments et ajouter un gestionnaire d'événements
    collapsibles.forEach(function (collapsible) {
        // Sélectionner l'icône de bascule dans chaque élément
        var toggleIcon = collapsible.querySelector('.toggle');

        // Ajouter un écouteur de clic à l'icône de bascule
        toggleIcon.addEventListener('click', function (event) {
            // Empêcher la propagation de l'événement au parent (le texte de l'élément)
            event.stopPropagation();

            // Sélectionner le contenu de l'élément
            var content = collapsible.querySelector('.content');

            // Utiliser classList.toggle pour basculer la classe "active" du contenu
            content.classList.toggle('active');
        });
    });

});


document.addEventListener('DOMContentLoaded', function () {
    // Sélectionner tous les éléments avec la classe "collapsible"
    var collapsibles = document.querySelectorAll('.collapsible > li');

    // Parcourir tous les éléments et ajouter un gestionnaire d'événements
    collapsibles.forEach(function (collapsible) {
        // Sélectionner l'icône de bascule dans chaque élément
        var toggleIcon = collapsible.querySelector('.toggle');

        // Ajouter un écouteur de clic à l'icône de bascule
        toggleIcon.addEventListener('click', function (event) {
            // Empêcher la propagation de l'événement au parent (le texte de l'élément)
            event.stopPropagation();

            // Sélectionner le contenu de l'élément
            var content = collapsible.querySelector('.content');

            // Utiliser classList.toggle pour basculer la classe "active" du contenu
            content.classList.toggle('active');
        });
    });
});

const fileInput = document.getElementById('select-image');
const images = document.getElementById('images');
const totalImages = document.getElementById('total-images');

// Listen to the change event on the <input> element
fileInput.addEventListener('change', (event) => {
    // Get the selected image file
    const imageFiles = event.target.files;

    if (imageFiles.length > 0) {
        // Loop through all the selected images
        for (const imageFile of imageFiles) {
            const reader = new FileReader();

            // Convert each image file to a string
            reader.readAsDataURL(imageFile);

            // FileReader will emit the load event when the data URL is ready
            // Access the string using reader.result inside the callback function
            reader.addEventListener('load', () => {
                // Create new <img> element and add it to the DOM
            });
        }
    } else {
        // Empty the images div
    }
});



// Listen to the change event on the <input> element
fileInput.addEventListener('change', (event) => {
    // Get the selected image file
    const imageFiles = event.target.files;

    // Show the number of images selected
    totalImages.innerText = imageFiles.length;

    // Empty the images div
    images.innerHTML = '';

    if (imageFiles.length > 0) {
        // Loop through all the selected images
        for (const imageFile of imageFiles) {
            const reader = new FileReader();

            // Convert each image file to a string
            reader.readAsDataURL(imageFile);

            // FileReader will emit the load event when the data URL is ready
            // Access the string using reader.result inside the callback function
            reader.addEventListener('load', () => {
                // Create new <img> element and add it to the DOM
                images.innerHTML += `
                <div class="image_box">
                    <img src='${reader.result}'>
                    <span class='image_name'>${imageFile.name}</span>
                </div>
            `;
            });
        }
    } else {
        // Empty the images div
        images.innerHTML = '';
    }
});


