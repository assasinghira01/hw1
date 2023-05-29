
fetch("ApiHome.php")
.then(onResponse).then(onJson);

function onResponse(response) { 
    console.log(response); 
    return response.json(); 
} 
 
function onJson (json) {
    console.log(json);
    const elenco_serie = document.querySelector('#mostra_serie');
    elenco_serie.innerHTML = "";
   
    const randomserie=getRandomserie(json,9);
        
        for (let result of randomserie) { 
            const container = document.createElement('div'); 
            const containerTesto = document.createElement('div'); 
            const img = document.createElement('img'); 
            const genere = document.createElement('p'); 
            const titolo = document.createElement('h3'); 
            const valutazione = document.createElement('h3');

            genere.textContent = result.genere; 
            img.src = result.image; 
            titolo.textContent=result.title;
            valutazione.textContent=result.valutazione;

            container.appendChild(img); 
            containerTesto.appendChild(titolo); 
            containerTesto.appendChild(genere); 
            container.appendChild(containerTesto); 
            containerTesto.appendChild(valutazione);

            const preferiti=document.createElement("button");
            preferiti.classList.add("preferiti");
    
            if(result.preferiti==true){
                preferiti.textContent="Rimuovi dai preferiti";
                preferiti .addEventListener('click',rimuoviPreferiti);
    
            }else{
                preferiti.textContent="Aggiungi ai preferiti";
                preferiti .addEventListener('click',aggiungiPreferiti);
            }
    
            container.appendChild(preferiti);
            
 
            elenco_serie.appendChild(container); 

        } 
        function getRandomserie(arr,count){
            const shuffled=arr.sort(() => 0.5 - Math.random());
            return shuffled.slice(0,count);
        }       
}
    
    