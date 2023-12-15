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

const trie = document.querySelector('select[name="trie"]')
const etat1 = document.querySelector('div[name="etat1"]');
const etat2 = document.querySelector('div[name="etat2"]');
const etat3 = document.querySelector('div[name="etat3"]');
const etat4 = document.querySelector('div[name="etat4"]');
const etat5 = document.querySelector('div[name="etat5"]');
etat1.style.display = 'none';
etat2.style.display = 'none';
etat3.style.display = 'none';
etat4.style.display = 'none';
etat5.style.display = 'block';

trie.addEventListener('click', async()=>{
    switch(trie.value){
        case "1": 
        etat1.style.display = 'block';
        etat2.style.display = 'none';
        etat3.style.display = 'none';
        etat4.style.display = 'none';
        etat5.style.display = 'none';
        break;

        
        case "2" : 
        etat1.style.display = 'none';
        etat2.style.display = 'block';
        etat3.style.display = 'none';
        etat4.style.display = 'none';
        etat5.style.display = 'none';

        break;

        case "3" : 
        etat1.style.display = 'none';
        etat2.style.display = 'none';
        etat3.style.display = 'block';
        etat4.style.display = 'none';
        etat5.style.display = 'none';

        break;

        case "4" : 
        etat1.style.display = 'none';
        etat2.style.display = 'none';
        etat3.style.display = 'none';
        etat4.style.display = 'block';
        etat5.style.display = 'none';

        break;

        case "5" : 
        etat1.style.display = 'none';
        etat2.style.display = 'none';
        etat3.style.display = 'none';
        etat4.style.display = 'none';
        etat5.style.display = 'block';

        break;
    }

})