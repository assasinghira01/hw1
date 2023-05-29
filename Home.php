<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: Login.php");
        exit;
    }
?>

<!DOCTYPE html>
    <html>
        <head>
            <title >NETPLIX-HOME</title>
            
            <script src="AggiungiRimuoviPreferiti.js" defer="true"></script>
            <script src="ApiHomePage.js" defer="true"></script>

            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="Home.css"/>
            <link rel="preconnect" href="https://fonts.googleapis.com">
             <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
             <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
             <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
             <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Chorasmian&display=swap" rel="stylesheet">
        </head>

        <body>

            <article>


            <nav>
                    
                    <div id="intestazione">
                        <div id="menu">
                                 
                            <a id="cerca"href=Cerca.php>Cerca</a>
                            <a id="preferiti" href=seriepreferiti.php>Preferiti</a>
                            <a id="musica"href=musiche.php>song</a>
                            <a id="logout"href=Logout.php>Logout</a>
                                

                        </div>
                    </div>
                    </nav>


                <header> 

                        <h1>
                            NETPLIX
                        </h1>
                    
                </header>

                <section>
                    <div id="titolo">
                        <h2>SERIE PIU AMATE DAL PUBBLICO</h2>
                    </div>

                       <div id="mostra_serie"> </div>
                      

                </section>
    
            </article>
            <footer>
        <div>
            <p>Copyright © 2023 NETPLIX.</p>
            <div id=aiuto>
            <p>Domande? Chiama al 3888779286 <br>
            NETPLIX è un sito sviluppato indipendentemente, segnalare eventuali bug all'indirizzo NETPLIX@libero.it
        </p>
           </div>
        </div>
        <div>
            <p>Contatti:</p>
          
            <ul>
                <li>Nome:   Antonio Nicolò</A></li>
                <li>Cognome: Scarvaglieri</li>
                <li>Matricola: 1000016405</li>
                <li>Residenza: Adrano,Italia</li>
                <li>Email personale: antonioscarva@libero.it</li>
            </ul>
            
        </div>
    </footer>

        </body>

    </html>