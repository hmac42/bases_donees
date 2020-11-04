<?php
session_start();

$servername = 'localhost';
$username = 'root';
$passwordDB = '';



if (isset($_POST['Envoyer'])) {
    $emailConfirm = $_POST['emailConfirm'];
    if (!empty($emailConfirm)) {
        $dbco = new PDO("mysql:host=$servername; dbname=n2_exo", $username, $passwordDB);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $verifEmail = $dbco->prepare("SELECT login FROM connexions WHERE login=? AND essaieconn = 'A'");
        $verifEmail->execute([$emailConfirm]);
        $user = $verifEmail->fetch();

        if ($user = $emailConfirm) {
            include 'sendemail.php';
            $to = 'hmac@yopmail.com';
            $subject = "test\r\n";
            $subject .= "MIME-Version: 1.0\r\n";
            $subject .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $body = 'blabla test 2 <html><a href="http://localhost/bases_donees/SQL_niveau2/n2_exercice/Page_niveau2/newpassword.php">lien</a></html>';
            send_mail($to, $subject, $body);
            
            echo "Email envoyé pour reinitialiser le mot de passe";
        } else {
            echo 'le Email ne existe pas dans la base de donées';
        }
    } else {
        $erreurEmail = "Entrez votre Email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resetpassword.php</title>
</head>

<body>
    <h2>Réinitialiser le mot de passe</h2>
    <form action="" method="post">
        <label for="">Entrez votre E-mail : <input type="text" name="emailConfirm" id="">
            <input type="submit" value="Envoyer" name="Envoyer">
            <p><?php if (isset($erreurEmail)) {
                    echo $erreurEmail;
                } ?></p>
    </form>
</body></label>

</html>