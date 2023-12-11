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