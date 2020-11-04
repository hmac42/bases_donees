<?php
session_start();

$servername = 'localhost';
$username = 'root';
$passwordDB = '';

$reinitPassword = isset($_POST['passwordConfirm']);
$reinitPassword1 = isset($_POST['passwordConfirm1']);

if (isset($_POST['Envoyer1'])) {
    
        if ($reinitPassword = $reinitPassword1) {
            $options = ['cost' => 12,];
            $condMDP = '/^(?=.{8,}$)(?=.*[A-Z])(?=.*[a-z])(?=.*\d)/';
            $reinitPasswordCrypt = password_hash($_POST['passwordConfirm'], PASSWORD_BCRYPT, $options);
            $dbco = new PDO("mysql:host=$servername; dbname=n2_exo", $username, $passwordDB);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $verifEmail = $dbco->prepare("SELECT login FROM connexions WHERE login=? AND essaieconn = 'A'");
            //$verifEmail->execute([$verifEmail]);
            $user = $verifEmail->fetch();

            $newpassword = $dbco->prepare("UPDATE utilisateurs SET motDePasse = ? WHERE email = '$user'");
            $newpassword->execute([$reinitPasswordCrypt]);
            echo "mot de passe reinitialisé";
        } else {
            echo "mot de passe passe n'est pas bon!";
        }
    } else {
        echo "remplissez les cases!";
    }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newpassword.php</title>
</head>

<body>
    <form action="" method="post">
        <p><label for="">Entrez votre nouveau mot de passe : <input type="text" name="passwordConfirm" id=""></p>
        <p><label for="">Confirmez votre mot de passe : <input type="text" name="passwordConfirm1" id=""></p>
        <input type="submit" value="Envoyer" name="Envoyer1">
    </form>
</body>

</html>