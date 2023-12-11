const boutons = document.querySelectorAll('button[name="buttonc"]')




boutons.forEach(async(signal) => 
{
    let id = signal.id
    signal.addEventListener('click', async()=>
    {
        if(window.confirm("Cette commentaire sera définitivement suprimé"))
        {
            axios.post('/servicediffusion/'+id).then(response=>
            {
                //document.querySelector('div[id="'+id+'"]').remove()
                console.log(response.data)
                document.querySelector('div#d'+id).remove()

            })
            .catch(err=>{window.alert("")});
            
        }
    })
  

}) 






