  <!DOCTYPE html>
    <html lang="en">
    <?php
    session_start();
    $id_session = session_id();
    $servername = 'localhost';
    $username = 'root';
    $passwordDB = '';

    $dbco = new PDO("mysql:host=$servername; dbname=n2_exo", $username, $passwordDB);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $verifEmail = $dbco->prepare("SELECT * FROM utilisateurs WHERE email=?");
            $verifEmail->execute([$login]);
            $user = $verifEmail->fetch();

    ?> 
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>home.php</title>
        </head>

        <body>
            <h4>Vous êtes connecté!</h4>
            <h5>Bienvenue </h5>
            <?php if(isset($_SESSION['login'])){echo "bienvenue ".$_SESSION['login'];} ?>
            <?php
            /*if($id_session){
                echo $id_session.'<br>'; // id de la session récupéré  avec session_id
            }*/

            /*if(isset($_COOKIE['PHPSESSID'])){
                echo $_COOKIE['PHPSESSID'];
            }*/
            ?>


        </body>

    </html>
<?php

    


?>