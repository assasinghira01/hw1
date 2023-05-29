<?php
    session_start();

    if (isset($_SESSION['username'])) {
        header("Location: Home.php");
        exit;
    }

    if (!empty($_POST["user"]) && !empty($_POST["password"])) {
        $conn = mysqli_connect("localhost", "root", "", "utenti") or die(mysqli_connect_error());

        $username = mysqli_real_escape_string($conn, $_POST["user"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $query = "SELECT userID, pass FROM utenti WHERE userID = '".$username."'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);

            if (password_verify($_POST['password'], $entry['pass']) && $_POST['user'] == $entry['userID']) {
                $_SESSION["username"] = $_POST["user"];
                header("Location: Home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            } else {
                $errore = "Credenziali non valide";
            }
        } else {
            $errore = "Credenziali non valide";
        }
    } else if (isset($_POST["user"]) || isset($_POST["password"])) {
        $errore = "Inserire entrambe le credenziali";
    }
?>

<html>
    <head>
        <script src="LoginJs.js" defer="true"></script>
        <link rel="stylesheet" href="login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Chorasmian&display=swap" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NETPLIX-ACCEDI</title>
    </head>
    <body>
        <div id="logo">
            NETPLIX
        </div>
        <main class="login">
            <section class="main">
                <h1>accedi per continuare</h1>
                
                <form id="form" name='login' method='post'>
                    <div class="username">
                        <label for='username'>Username</label>
                        <input type='text' name='user'>
                    </div>
                    <div class="password">
                        <label for='password'>Password</label>
                        <input type='password' name='password' <?php if (isset($_POST["password"])) { echo "value=" . $_POST["password"]; } ?>>
                    </div>
                    <div class="submit-container">
                        <div class="login-btn">
                            <input type='submit' value="ACCEDI">
                        </div>
                        <?php
                    
                 if (isset($errore)) {
               echo "<p class='error'>$errore</p>";
                   }

                ?>
                </form>
                <div class="signup">prima volta su NETPLIX? <a href="registrazione.php">registrati</a></div>
            </section>
        </main>
    </body>
</html>
