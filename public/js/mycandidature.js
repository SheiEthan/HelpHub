const trie = document.querySelector('select[name="trie"]')
const tout = document.querySelector('div[name="tout"]');
const etat0 = document.querySelector('div[name="etat0"]');
const etat1 = document.querySelector('div[name="etat1"]');
const etat2 = document.querySelector('div[name="etat2"]');
const etat3 = document.querySelector('div[name="etat3"]');
const etat4 = document.querySelector('div[name="etat4"]');
const etat5 = document.querySelector('div[name="etat5"]');
tout.style.display = 'block';
etat0.style.display = 'none';
etat1.style.display = 'none';
etat2.style.display = 'none';
etat3.style.display = 'none';
etat4.style.display = 'none';
etat5.style.display = 'none';

trie.addEventListener('click', async()=>{
    switch(trie.value){
        case "0": 
        etat0.style.display = 'block';
        etat1.style.display = 'none';
        etat2.style.display = 'none';
        etat3.style.display = 'none';
        etat4.style.display = 'none';
        etat5.style.display = 'none';
        tout.style.display = 'none';

        break;


        case "1": 
        etat0.style.display = 'none';
        etat1.style.display = 'block';
        etat2.style.display = 'none';
        etat3.style.display = 'none';
        etat4.style.display = 'none';
        etat5.style.display = 'none';
        tout.style.display = 'none';

        break;

        
        case "2" : 
        etat0.style.display = 'none';
        etat1.style.display = 'none';
        etat2.style.display = 'block';
        etat3.style.display = 'none';
        etat4.style.display = 'none';
        etat5.style.display = 'none';
        tout.style.display = 'none';

        break;

        case "3" : 
        etat0.style.display = 'none';
        etat1.style.display = 'none';
        etat2.style.display = 'none';
        etat3.style.display = 'block';
        etat4.style.display = 'none';
        etat5.style.display = 'none';
        tout.style.display = 'none';

        break;

        case "4" : 
        etat0.style.display = 'none';
        etat1.style.display = 'none';
        etat2.style.display = 'none';
        etat3.style.display = 'none';
        etat4.style.display = 'block';
        etat5.style.display = 'none';
        tout.style.display = 'none';

        break;

        case "5" : 
        etat0.style.display = 'none';
        etat1.style.display = 'none';
        etat2.style.display = 'none';
        etat3.style.display = 'none';
        etat4.style.display = 'none';
        etat5.style.display = 'block';
        tout.style.display = 'none';

        break;

        case "6" : 
        etat0.style.display = 'none';
        etat1.style.display = 'none';
        etat2.style.display = 'none';
        etat3.style.display = 'none';
        etat4.style.display = 'none';
        etat5.style.display = 'none';
        tout.style.display = 'block';


    }

})