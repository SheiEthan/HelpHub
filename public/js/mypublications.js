
const trie = document.querySelector('select[name="trie"]')
const tout = document.querySelector('div[name="tout"]');
const benevole = document.querySelector('div[name="benevole"]');
const like = document.querySelector('div[name="like"]');
const historique = document.querySelector('div[name="historique"]');
const don = document.querySelector('div[name="don"]');

benevole.style.display = 'none';
don.style.display = 'none';
tout.style.display = 'block';
historique.style.display = 'none';
like.style.display = 'none';


    trie.addEventListener('click', async()=>{
        switch(trie.value){
            case "1": 
            benevole.style.display = 'none';
            don.style.display = 'none';
            tout.style.display = 'block';
            historique.style.display = 'none';
            like.style.display = 'none';
            break;

            
            case "2" : 
            benevole.style.display = 'none';
            don.style.display = 'none';
            tout.style.display = 'none';
            historique.style.display = 'block';
            like.style.display = 'none';
            break;

            case "3" : 
            benevole.style.display = 'none';
            don.style.display = 'block';
            tout.style.display = 'none';
            historique.style.display = 'none';
            like.style.display = 'none';
            break;

            case "4" : 
            benevole.style.display = 'block';
            don.style.display = 'none';
            tout.style.display = 'none';
            historique.style.display = 'none';
            like.style.display = 'none';
            break;

            case "5" : 
            benevole.style.display = 'none';
            don.style.display = 'none';
            tout.style.display = 'none';
            historique.style.display = 'none';
            like.style.display = 'block';
            break;
        }

    })


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
