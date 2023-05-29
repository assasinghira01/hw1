

fetch("RitornaPreferiti.php").then(onResponse).then(onJson);

function onResponse(response){
    return response.json();
}

function onJson(json){
    console.log(json);
    const serie_preferiti=document.querySelector('#serie_preferiti');
    serie_preferiti.innerHTML="";
    

    for(let result of json){
        const Container=document.createElement('div');
        const titolo=document.createElement('h3');
        const img=document.createElement('img');
        const genere = document.createElement('p'); 
        const bottone=document.createElement("button");
        
        bottone.textContent="Rimuovi dai preferiti";
        bottone.classList.add("preferiti");
        bottone.addEventListener("click",rimuoviPreferiti);

        img.src=result.copertina;
        titolo.textContent=result.titolo;
        genere.textContent = result.genere;
        Container.appendChild(img);
        Container.appendChild(titolo);
        Container.appendChild(bottone);
        Container.appendChild(genere); 
        serie_preferiti.appendChild(Container);
    }
    
}

function rimuoviPreferiti(event){

    const titolo=event.currentTarget.parentNode.querySelector("h3");
    fetch("rimuoviPreferiti.php?title="+encodeURIComponent(titolo.textContent)).then(onResponse).then(json); 

}

function onResponse(response){
    return response.json();
}

function json(json){
    fetch("RitornaPreferiti.php").then(onResponse).then(onJson);
    
}