const images = document.querySelectorAll('img.imgmedia');

images.forEach(function(image) {
    image.addEventListener('click', () => lightbox(image));
})

document.addEventListener("keyup", function(event) {
    if(event.key === "Escape") {
        const bg = document.querySelector('#bg');

        if(bg) {
            bg.remove();
            document.body.style.overflow = "";
        }
    }
})

window.addEventListener('resize', function() {
    const lightbox = document.querySelector('#lightbox');

    if(lightbox) {  
        lightboxResize(lightbox)
    }
})

async function getData(url)
{
    return await fetch(url)
    .then((resp)=>resp.json())
    .then((data)=>{return data});
}

let saved = await getData('/data/likes')

let signalsList = saved.signals;
let signals= document.querySelectorAll('p[name="signal"]')
signals.forEach(async(signal) => 
{
    let id = signal.id
    signal.addEventListener('click', async()=>
    {
        
        if(signal.innerHTML!=="🏴")
        {
            if(window.confirm("Votre signalement sera pris en compte et évalué par les administrateurs \nEtes vous sur de vouloir signaler, une fois que vous aurez signalé vous ne pourrez plus l'annuler"))
            {
                axios.post('/data/commentaire/signaler/'+id, {"id": id}).then(Response=>
                {
                    signal.innerHTML="🏴"
                })
                .catch(err=>{window.alert("Vous devez etre connecté pour pouvoir signaler un commentaire")});
            }
        }

    })
    if(null!==saved)
        {
            if(signalsList.filter((x) => x.id_commentaire == signal.id).length > 0)
            {
                signal.innerHTML="🏴"
            }
            else
            {
                signal.innerHTML="🏳️"
            }
        }
});

let likesList = saved.likes;
let nblikesList = saved.nblikes;
console.log(saved)
let stateMap = {};
let likes= document.querySelectorAll('p[name="like"]')
likes.forEach(async(like) => {
 let id = like.id
    like.addEventListener('click', async()=>{
        axios.post('/data/commentaire/liker/'+id, {"id": id}).then(Response=>{
            
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
        .catch(err=>{window.alert("Vous devez etre connecté pour pouvoir liker un commentaire.")});
        })
        if(null!==saved)
        {
           if(likesList.filter((x) => x.id_commentaire == like.id).length > 0)
           {
               like.innerHTML="❤️"+nblikesList.filter((x) => x.id_commentaire == like.id)[0].nblikes
               stateMap[id] = true
           }
           else{
               like.innerHTML="🤍"+nblikesList.filter((x) => x.id_commentaire == like.id)[0].nblikes
               stateMap[id]=false
           }
        }
        
});


let psaved = await getData('/data/likespubli')
let plikesList = psaved.likes;
let pnblikesList = psaved.nblikes;
console.log(psaved)
let pstateMap = {};
let plike= document.querySelector('p[name="plike"]')

    let pid = plike.id

    plike.addEventListener('click', async()=>{
        axios.post('/data/likerpubli/'+pid, {"id": pid}).then(Response=>{
            
            if(!pstateMap[pid])
        {
            plike.innerHTML="❤️"+Response.data.likes
            pstateMap[pid] =true
        }
        else{
            plike.innerHTML="🤍"+Response.data.likes
            pstateMap[pid]=false
        }
        })
        .catch(err=>{window.alert("Vous devez etre connecté pour pouvoir liker une publication")});
        });
        if(null!==psaved)
          {if(plikesList.filter((x) => x.id_publication == pid).length > 0)
          {
              plike.innerHTML="❤️"+pnblikesList.filter((x) => x.id_publication == pid)[0].nblikes
              pstateMap[pid] = true
          }
          else{
              plike.innerHTML="🤍"+pnblikesList.filter((x) => x.id_publication == pid)[0].nblikes
              pstateMap[pid]=false
          }}
        

function lightbox(image) {
    const bg = h('div', document.body, "bg");
    const lightbox = h('div', bg, "lightbox");

    const img = h('img', lightbox);
    img.src = image.src;

    const close = h('div', lightbox, "close", "X");

    document.body.style.overflow = "hidden";

    close.addEventListener('click', function() {
        bg.remove();
        document.body.style.overflow = "";
    })

    img.onload = function() {
        lightboxResize(lightbox);
    }
}

function lightboxResize(lightbox) {
    lightbox.style.width = "";
    lightbox.style.height = "";

    const windowWidth = window.innerWidth;
    const windowHeight = window.innerHeight;

    const lightboxWidth = lightbox.offsetWidth;
    const lightboxHeight = lightbox.offsetHeight;

    if(windowWidth < lightboxWidth) {
        lightbox.style.width = `${windowWidth}px`;
    } else {
        const left = Math.floor((windowWidth - lightboxWidth) / 2);
        lightbox.style.left = `${left}px`;
    }

    if(windowHeight < lightboxHeight) {
        lightbox.style.height = `${windowHeight}px`;
    } else {
        const top = Math.floor((windowHeight - lightboxHeight) / 2);
        lightbox.style.top = `${top}px`;
    }
}

function h(tagName, parent, id = null, text = null, className = null) {
    const tag = document.createElement(tagName);
    parent.appendChild(tag);

    if(id) tag.id = id;
    if(text) tag.innerText = text;
    if(className) tag.classList.add(className);

    return tag;
} 


