<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="login.php" method="post">
        <p>Identifiant :<input type="email" name="Login"></p>
        <?php if (isset($email)) { if (filter_var($email, FILTER_VALIDATE_EMAIL)) {echo "Login non valide"; }} ?>
        <p>Mot de passe :<input type="text" name="Password"></P>
        <input type="submit" value="Envoyer" name="envoyer">
    </form>

    <?php
    $login = isset($_POST["Login"]);
    $password = isset($_POST["Password"]);
    $date = date("d-m-y H:i");

    $servername = 'localhost';
    $username = 'root';
    $passwordDB = '';
    // $dbnom = 'n2_exo';

    /*//On établit la connexion
            $conn = new mysqli($servername, $username, $password);
            
            //On vérifie la connexion
            if($conn->connect_error){
                die('Erreur : ' .$conn->connect_error); //die() - arrete l'execution du script et affiche le erreur
            }
            echo 'Connexion réussie';*/
    if (isset($_POST["envoyer"])) {
        if (!empty($_POST["Login"]) || !empty($_POST["Password"])) {
            try {
                $dbco = new PDO("mysql:host=$servername; dbname=n2_exo", $username, $passwordDB);

                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $dbco->beginTransaction(); //permet de démarrer ce qu’on appelle une transaction et de désactiver le mode autocommit.

                $sql1 = "INSERT INTO connexions(login, motDePasse, date)
                         VALUES('$login', '$password', '$date')";

                $verifEmail = $dbco->prepare("SELECT * FROM utilisateurs WHERE email=?");
                $verifEmail->execute([$login]);
                $user = $verifEmail->fetch();
                    if ($user === $login) { }


                $dbco->exec($sql1);

                $dbco->commit(); //sert à valider une transaction, c’est-à-dire à valider l’application d’une ou d’un ensemble de requêtes SQL. Cette méthode va aussi replacer la connexion en mode autocommit.
                echo 'Entrées ajoutées dans la table';
            } catch (PDOException $e) {
                $dbco->rollBack(); //  sert à annuler une transaction si l’on s’aperçoit d’une erreur.
                echo "Erreur : " . $e->getMessage();
            }
        } else{ echo "Remplissez les cases";}
    }
    ?>
</body>

</html>