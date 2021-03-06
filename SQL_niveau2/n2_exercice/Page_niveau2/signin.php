<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signin.php</title>
</head>

<body>


    <?php

    $servername = 'localhost';
    $username = 'root';
    $passwordDB = '';
    $erreurCond = "Vous devez accepter les conditions";

    $options = ['cost' => 12,]; // parametre a ajouter au cryptage pour le rendre plus complexe
    if (isset($_POST["envoyer"])) {
        $nom = $_POST["Nom"];
        $prenom = $_POST["Prenom"];
        $email = $_POST["Email"];
        $motDePasse = $_POST['MotDePasse'];
        $MotDePasseconfirm = $_POST["MotDePasseconfirm"];
        $statut = isset($_POST["Statut"]);
        $checkConditions = isset($_POST["Conditions"]);
    }

    if (isset($checkConditions)) {
        if (empty($checkConditions)) {
            echo $erreurCond;
        } else {

            if (
                empty($_POST['Nom']) ||
                empty($_POST['Prenom']) ||
                empty($_POST['Email']) ||
                empty($_POST['MotDePasse']) ||
                empty($_POST['MotDePasseconfirm']) ||
                empty($_POST['Statut'])
            ) {
                echo "ERREUR : tous les champs n'ont pas ete renseignés.";
            } else {
                if (
                    !empty($_POST['Nom']) ||
                    !empty($_POST['Prenom']) ||
                    !empty($_POST['Email']) ||
                    !empty($_POST['MotDePasse']) ||
                    !empty($_POST['MotDePasse1']) ||
                    !empty($_POST['Statut']))
                 {
                    $condMDP = '/^(?=.{8,}$)(?=.*[A-Z])(?=.*[a-z])(?=.*\d)/';
                    $motDePasseCrypt = password_hash($_POST['MotDePasse'], PASSWORD_BCRYPT, $options);

                    if (preg_match($condMDP, $_POST['MotDePasse'])) {

                        if ($_POST['MotDePasse'] === $_POST['MotDePasseconfirm']) {
                            echo "mot de passe confirmé<br>";

                            $dbco = new PDO("mysql:host=$servername; dbname=n2_exo", $username, $passwordDB);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $verifEmail = $dbco->prepare("SELECT * FROM utilisateurs WHERE email = ?"); //on peut utiliser query a la place de prepare mais il faut preciser le parametre ciblé .....WHERE email = 'email' !!!
                            $verifEmail->execute([$email]);
                            $user = $verifEmail->fetch();

                            if (!$user) {
                                 //email n'existe pas
                                try {

                                    $dbco->beginTransaction();                                          //permet de démarrer ce qu’on appelle une transaction et de désactiver le mode autocommit.
                                    $sql1 = "INSERT INTO utilisateurs(nomU, prenomU, email, motDePasse, statut)
                                            VALUES('$nom', '$prenom', '$email', '$motDePasseCrypt','$statut')";
                                    $dbco->exec($sql1);
                                    $dbco->commit();                                                     //sert à valider une transaction, c’est-à-dire à valider l’application d’une ou d’un ensemble de requêtes SQL. Cette méthode va aussi replacer la connexion en mode autocommit.
                                    echo 'Entrées ajoutées dans la table<br>';
                                } catch (PDOException $e) {
                                    $dbco->rollBack();                                  //  sert à annuler une transaction si l’on s’aperçoit d’une erreur.
                                    echo "Erreur : " . $e->getMessage();
                                }
                                echo "<br>Vous etes inscrit!<br>";
                            } else {
                                $erreurEmail = "Il existe un compte associe a ce e-mail. Essayez un nouveau e-mail. <br>";
                                
                            } // verifie si le mail existe dans la base de donnees

                        } else {
                            $erreurMotDePasse = 'Veuillez confirméz le mot de passe';
                        }
                        $mdpBon = "mot de passe bon<br>";
                    } else {
                        echo "mot de passe pas conforme<br>";
                    }
                }
            }
        }
    }

    ?>
<?php ?>

    <form action="signin.php" method="post">
        <p>Nom:
            <input type="text" name="Nom"></p>
        <p>Prenom:
            <input type="text" name="Prenom"></p>
        <p>Email:
            <input type="email" name="Email"></p>
            <?php if (isset($email)) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "Email non valide";}} 
                            if(isset($erreurEmail)){echo $erreurEmai;}?>
        <p>Mot de passe:
            <input type="text" name="MotDePasse"><span><?phpif(isset($mdpBon)){echo $mdpBon;}?> 
        <p>Confirmez le mot de passe:
            <input type="text" name="MotDePasseconfirm"></p><?php if(isset($erreurMotDePasse)){echo $erreurMotDePasse;}?>
        <p>Cochez si vous etes:<br>
            <label>Professionel</label>
            <input type="radio" name="Statut" value="Professionel" id="">
            <label>Particulier</label>
            <input type="radio" name="Statut" value="Particulier" id=""></p>
        <p>Accepter les conditions:
            <input type="checkbox" name="Conditions" id=""></p>
            <p><input type="submit" value="Envoyer" name="envoyer"></p>
    </form>

    


</body>
</html>