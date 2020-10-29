<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login.php</title>
</head>

<body>


    <?php
    session_start();

    $servername = 'localhost';
    $username = 'root';
    $passwordDB = '';

    /*if (isset($tempsBloq)) {
        $tempsAttente = time() - $tempsBloq;
        if ($tempsAttente > 30){ 
            //$motDePasseOublie = '<a href="MDPoublie.php">Mot de passe oublié</a><br>';
            $requeteEfface = $dbco->prepare("DELETE FROM connexions WHERE login= $login AND essaieconn = 'A'");
            $requeteEfface->execute();
        }
     } */

    if (isset($_POST["envoyer"])) {
        $login = $_POST["login"];
        $password = $_POST["Password"];
        $date = date("d-m-y H:i");
        if (!empty($_POST["Login"]) || !empty($_POST["Password"])) {
            $dbco = new PDO("mysql:host=$servername; dbname=n2_exo", $username, $passwordDB);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $verifEmail = $dbco->prepare("SELECT * FROM utilisateurs WHERE email=?");
            $verifEmail->execute([$login]);
            $user = $verifEmail->fetch();

            if ($user) {
                $hash = $user['motDePasse'];
                if (password_verify($password, $hash)) {
                    echo "connecte";

                    try {
                        $dbco->beginTransaction();                              //permet de démarrer ce qu’on appelle une transaction et de désactiver le mode autocommit.
                        $sql1 = "INSERT INTO connexions(login, motDePasse, date)
                                 VALUES('$login', '$password', '$date')";
                        $dbco->exec($sql1);
                        $dbco->commit();                                         //sert à valider une transaction, c’est-à-dire à valider l’application d’une ou d’un ensemble de requêtes SQL. Cette méthode va aussi replacer la connexion en mode autocommit.
                        echo 'Entrées ajoutées dans la table';
                    } catch (PDOException $e) {
                        $dbco->rollBack();                                       //  sert à annuler une transaction si l’on s’aperçoit d’une erreur.
                        echo "Erreur : " . $e->getMessage();
                    }
                    // $_SESSION['id'] = $user['id'];
                    $_SESSION['login'] = $login;
                    header("location: home.php");
                } else {
                    $essaieConn = "A";

                    $requeteConn = $dbco->prepare("SELECT count(*) as countConn FROM connexions WHERE login=? AND essaieconn = 'A'");
                    $requeteConn->execute([$login]);
                    $countConn = $requeteConn->fetch();
                    $requeteConn->closeCursor();
                    echo $countConn['countConn'] . "<br>";
                    if ($countConn['countConn'] >= 4) {
                       // $tempsBloq= time();
                        echo "vous devez attendre 30 sec";
                        
                    } else {
                        try {
                            $dbco->beginTransaction();
                            $sql2 = "INSERT INTO connexions(login, essaieConn ,date)
                                 VALUES('$login', '$essaieConn', '$date')";
                            $dbco->exec($sql2);
                            $dbco->commit();
                            echo "Mot de passe inexistant ou pas conforme!";
                        } catch (PDOException $e) {
                            $dbco->rollBack();
                            echo "Erreur : " . $e->getMessage();
                        }
                    }
                }
            } else {
                echo "L'identifiant n'existe pas!";
            }
        } else {
            echo "Remplissez les cases";
        }
    }

    ?>
    <form action="login.php" method="post">
        <p>Identifiant :<input type="email" name="login"></p>
        <p>Mot de passe :<input type="text" name="Password"></P>
        <input type="submit" value="Envoyer" name="envoyer">
    </form>
    <?php if (isset($motDePasseOublie)){echo $motDePasseOublie;}?>
    <a href="resetpassword.php">Mot de passe oublié</a>
</body>

</html>