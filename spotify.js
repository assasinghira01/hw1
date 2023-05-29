const risultati_canzoni=6;
let token;
const id="462d98b2adef4375958591ff7a2330f2";
const id_nascosto="7ca7c516b35746719263a6af1312400a";


function onResponseSpotify(response){  
    return response.json();
}

function onTokenJsonSpotify(json){
    token=json.access_token;
}


function ricerca_playlist(event){
    const testoCodificato=encodeURIComponent("NETFLIX SERIES");
    fetch("https://api.spotify.com/v1/search?type=playlist&q="+testoCodificato,{
        headers:{
            'Authorization':"Bearer "+ token
        }
    }).then(onResponseSpotify).then(visualizza_playlist);
}

function generaNumeroCasuale(max) {
    return Math.floor(Math.random() * max);
  }
  

function visualizza_playlist(json){
console.log(json);
const playlist= document.querySelector("#playlist");
playlist.innerHTML="";
for (let i = 0; i < risultati_canzoni; i++) {
    const numeroCasuale = generaNumeroCasuale(json.playlists.items.length);
    const item = json.playlists.items[numeroCasuale];
  
    const container=document.createElement("div");
    const link=document.createElement('a');
    link.href=item.external_urls.spotify;
    link.textContent=item.name+"("+item.tracks.total+" tracks)";
    link.target="_blank"; //apro il link della playlist in un'altra pagina
    playlist.appendChild(link);
    const copertina=document.createElement('img');
    copertina.src=item.images[0].url;
    container.appendChild(copertina);
    container.appendChild(link);
    playlist.appendChild(container);
    
}
const eliminaPlaylist=document.createElement('button');
eliminaPlaylist.textContent="ELIMINA LE PLAYLIST";
playlist.appendChild(eliminaPlaylist);
eliminaPlaylist.addEventListener('click',rimuoviContenuto);
}

function rimuoviContenuto(event){
const playlist=document.querySelector('#playlist');
playlist.innerHTML="";
}





const bottone=document.querySelector('button');
bottone.addEventListener('click',ricerca_playlist);

fetch("https://accounts.spotify.com/api/token",{
        method:'POST',
        body:"grant_type=client_credentials",
        headers:{
            "Authorization": "Basic "+btoa(id+":"+id_nascosto),
            "Content-Type":"application/x-www-form-urlencoded"
        }
}).then(onResponseSpotify).then(onTokenJsonSpotify);

