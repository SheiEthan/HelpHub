const don = document.querySelector('div[id="don"]');
const benevole = document.querySelector('div[id="benevole"]');
const recherche = document.querySelector('div[id="recherche"]');
const planifier = document.querySelector('div[id="planifier"]');
const frequence = document.querySelector('div[id="frequence"]');

const inputs= document.querySelectorAll('input')
benevole.style.display = 'none';
don.style.display = 'none';

frequence.style.display = 'none';
planifier.style.display = 'none';

const publiButtons = document.querySelectorAll('input[name="type"]');
publiButtons.forEach(radio => {
  radio.addEventListener('click', typeClick);
});

const benevoleButtons = document.querySelectorAll('input[name="typer"]');
benevoleButtons.forEach(radio => {
  radio.addEventListener('click', rechercheClick);
});

function rechercheClick() {
    if (document.getElementById('frequence').checked) {
      frequence.style.display = 'block';
      planifier.style.display = 'none';
    } else  {
      planifier.style.display = 'block';
      frequence.style.display = 'none';
    }
  }
function typeClick() {
inputs.forEach(input=>{


  if (document.getElementById('don').checked) {
    don.style.display = 'block';
    benevole.style.display = 'none';
    frequence.style.display = 'none';
    planifier.style.display = 'none';
  } else if(document.getElementById('benevole').checked) {
    benevole.style.display = 'block';
    don.style.display = 'none';
    if (document.getElementById('frequence').checked) {
      frequence.style.display = 'block';
      planifier.style.display = 'none';
    } else  {
      planifier.style.display = 'block';
      frequence.style.display = 'none';
    }
  }
  else{
    benevole.style.display = 'none';
    don.style.display = 'none';
    frequence.style.display = 'none';
    planifier.style.display = 'none';
  }})
}

