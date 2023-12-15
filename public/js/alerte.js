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

async function getData(url)
{
    return await fetch(url)
    .then((resp)=>resp.json())
    .then((data)=>{return data});
}

let saved = await getData('/data/likespubli')
let likesList = saved.likes;
let nblikesList = saved.nblikes;
console.log(saved)
let stateMap = {};
let likes= document.querySelectorAll('p[name="like"]')
likes.forEach(async(like) => {
 let id = like.id

    like.addEventListener('click', async()=>{
        axios.post('/data/likerpubli/'+id, {"id": id}).then(Response=>{
            
            if(!stateMap[id])
        {
            like.innerHTML="❤️"+Response.data.likes
            stateMap[id] =true
        }
        else{
            like.innerHTML="🤍"+Response.data.likes
            stateMap[id]=false
        }
        })
        .catch(err=>{window.alert("Vous devez etre connecté pour pouvoir liker une publication")});
        });
        if(null!==saved)
          {if(likesList.filter((x) => x.id_publication == like.id).length > 0)
          {
              like.innerHTML="❤️"+nblikesList.filter((x) => x.id_publication == like.id)[0].nblikes
              stateMap[id] = true
          }
          else{
              like.innerHTML="🤍"+nblikesList.filter((x) => x.id_publication == like.id)[0].nblikes
              stateMap[id]=false
          }}
        
});
