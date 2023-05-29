<?php
    session_start();
  
        $errore=false;
        if(!empty($_POST["nome"]) && !empty($_POST["cognome"])&& !empty($_POST["email"])&& !empty($_POST["IDuser"])&& !empty($_POST["password"])&& !empty($_POST["ConfermaPassword"])){ 

            $conn=mysqli_connect("localhost","root","","utenti")or die(mysqli_connect_error());



            if(!preg_match('/^[a-zA-Z ]*$/', $_POST['nome'])){ 
                $errore=true;
            }
        
            if(!preg_match('/^[a-zA-Z ]*$/', $_POST['cognome'])){ 
                $errore=true;
            }

            
            if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['IDuser'])){ //
                $errore=true;
            }else{
                $usernameID= mysqli_real_escape_string($conn,$_POST["IDuser"]);
                $query="SELECT userID FROM utenti where userID='".$usernameID."'";
                $res=mysqli_query($conn,$query);
                $num_rows=mysqli_num_rows($res);
                if($num_rows>0){
                    $errore=true;
                }
            }
        

            if(strlen($_POST["password"])<8){
                $errore=true;
            }

            if(strcmp($_POST['password'],$_POST['ConfermaPassword'])!= 0){
                $errore=true;
            }

            if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                $errore=true;
            } else{
                $email= mysqli_real_escape_string($conn,strtoLower($_POST["email"]));

                $query="SELECT email FROM utenti where email='".$email."'";
                $res=mysqli_query($conn,$query);
                $num_rows=mysqli_num_rows($res);

                if($num_rows>0){
                    $errore=true;
                }
            }

            if( $errore==false){
                    
                $nome= mysqli_real_escape_string($conn,$_POST["nome"]);
                $cognome= mysqli_real_escape_string($conn,$_POST["cognome"]);
                $password= mysqli_real_escape_string($conn,$_POST["password"]);
                $password=password_hash($password,PASSWORD_BCRYPT);
                $email= mysqli_real_escape_string($conn,$_POST["email"]);
                $query="INSERT INTO  utenti values('".$nome."','".$cognome."','".$email."','".$usernameID."','".$password."')";
                if(mysqli_query($conn,$query)){
                    $_SESSION['username']=$usernameID;
                    header('Location:Home.php');
                    
                    mysqli_close($conn);
                    exit;
                }
            }

        }
    
    
?>


<!DOCTYPE html>
    <html>
    <head>
        <title>Login</title>
        <script src="RegistrazioneJs.js" defer="true"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="registrazione.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Chorasmian&display=swap" rel="stylesheet">
       

    </head>

    <body>
    <div id="logo">
                NETPLIX
        </div>
        <main>
        <section class="main_left">
        </section>
        <section class="main_right">
            <h1>Iscriviti gratuitamente per entrare nel mondo del cinema</h1>
            <form id="form" name="registrazione" method="post" >
                  <div class=name >
                <label id="labelNome">Nome <input id="inputNome" type='text' name='nome'></label><div id="erroreNome"></div>
                </div>

                <div class="surname">
                <label >Cognome <input id="inputCognome"  type='text' name='cognome'></label><div id="erroreCognome"></div>
                </div>
                <div class="email"> 
                <label>Email <input id="inputEmail"type='text' name='email'></label><div id="erroreEmail"></div>
                </div>
                <div class="username">
                <label >Username <input id="inputID" type='text' name='IDuser'></label><div id="erroreUser"></div>
                </div>
                <div class="password">
                <label>Password <input id="inputPassword" type='password' name='password'></label><div id="errorePassword"></div>
                </div>
                <div class="confirm_password">
                <label>Conferma Password <input id="inputConfermaPass"type='password' name='ConfermaPassword'></label><div id="erroreConferma"></div>
                </div>
                <div class="submit">
                    <input type='submit' value="REGISTRATI" id="submit">
                </div>
                
            </form>
            <div class="signup">Hai un account? <a href="login.php">Accedi</a>
            
        </section>
        </main>
    

    </body>

 

</html>    