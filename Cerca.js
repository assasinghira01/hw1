const btnRicerca = document.getElementById("bottone-ricerca");
const barraRicerca = document.getElementById("barra-ricerca");
const risultatiDiv = document.getElementById("risultati");

btnRicerca.addEventListener("click", function() {
  const searchTerm = barraRicerca.value;
  searchItem(searchTerm);
});

function onResponse(response) {
  console.log(response);
  return response.json();
}

function searchItem(searchTerm) {
  risultatiDiv.innerHTML = "";

  if (searchTerm.trim() === "") {
    const noCerca = document.createElement("p2");
    noCerca.setAttribute("id", "nessun_risultato");
    noCerca.textContent = "Cerca una serie";
    risultatiDiv.appendChild(noCerca);
    return;
  }

  fetch("./ApiHome.php")
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      const result = data.filter(function(item) {
        return (
          item.title.toLowerCase().includes(searchTerm.toLowerCase())
        );
      });

      if (result.length > 0) {
        for (let i = 0; i < result.length; i++) {
          const serie = result[i];

          const itemDiv = document.createElement("div");
          itemDiv.classList.add("risultati");

          const container = document.createElement('div');
          const containerTesto = document.createElement('div');

          const image = document.createElement('img');
          const title = document.createElement('h3');
          const genere = document.createElement('p');
          const valutazione = document.createElement('h3');
        
      
          title.textContent = serie.title;
          image.src = serie.image;
          genere.textContent = serie.genere;
          valutazione.textContent = serie.valutazione;
        
      
       
          container.appendChild(image);
          containerTesto.appendChild(title);
          containerTesto.appendChild(genere);
          containerTesto.appendChild(valutazione);
        

          
          container.appendChild(containerTesto);

          
          const preferiti=document.createElement("button");
          preferiti.classList.add("preferiti");
  
          if(serie.preferiti===true){
              preferiti.textContent="Rimuovi dai preferiti";
              preferiti.addEventListener('click',rimuoviPreferiti);
  
          }else{
              preferiti.textContent="Aggiungi ai preferiti";
              preferiti.addEventListener('click',aggiungiPreferiti);
          }
  
          container.appendChild(preferiti);
    risultatiDiv.appendChild(container);
        }
      } else {
        const noResultsElement = document.createElement("p2");
        noResultsElement.setAttribute("id", "nessun_risultato");
        noResultsElement.textContent = "Nessun risultato trovato.";
        risultatiDiv.appendChild(noResultsElement);
      }
    })
    
}


