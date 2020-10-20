<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="signin.php" method="post">
        <p>Nom: <input type="text" name="Nom"></p>
        <p>Prenom: <input type="text" name="Prenom"></p>
        <p>Email: <input type="email" name="Email"></p>
        <?php if (isset($email)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Email non valide";
            }
        } ?>
        <p>Mot de passe: <input type="text" name="MotDePasse"></p>
        <p>Confirmez le mot de passe: <input type="text" name="MotDePasse1"></p>
        <p>Cochez si vous etes:<br>
            <label>Professionel</label><input type="radio" name="Statut" value="Professionel" id="">
            <label>Particulier</label><input type="radio" name="Statut" value="Particulier" id=""></p>
        <p>Accepter les conditions:<input type="checkbox" name="Conditions" id=""></p>
        <p><input type="submit" value="Envoyer"></p>
    </form>

    <a href="MDPoublie.php">Mot de passe oublié</a><br>

    <?php

    $servername = 'localhost';
    $username = 'root';
    $passwordDB = '';
    $erreurCond = "Vous devez accepter les conditions";

    $options = ['cost' => 12,]; // parametre a ajouter au cryptage pour le rendre plus complexe


    if (isset($checkConditions)) {
        if (empty($checkConditions)) {
            echo $erreurCond;
        } else {
            $nom = $_POST["Nom"];
            $prenom = $_POST["Prenom"];
            $email = $_POST["Email"];
            $motDePasse = $_POST["MotDePasse"];
            $MotDePasse1 = $_POST["MotDePasse1"];
            $statut = $_POST["Statut"];
            $checkConditions = $_POST["Conditions"];
            
        }
    }

    if (empty($_POST['Nom']) || empty($_POST['Prenom']) || empty($_POST['Email']) || empty($_POST['MotDePasse']) || empty($_POST['MotDePasse1']) || empty($_POST['Statut'])) {
        echo "ERREUR : tous les champs n'ont pas ete renseignés.";}
    elseif (!empty($_POST['Nom']) || !empty($_POST['Prenom']) || !empty($_POST['Email']) || !empty($_POST['MotDePasse']) || !empty($_POST['MotDePasse1']) || !empty($_POST['Statut'])) 
            {
            if (preg_match('@[A-Z]@', $motDePasse)) 
                {return "Mot de passe doit contenir au mois une lettre majuscule, une lettre miniscule, et un chiffre.";}
            elseif ($_POST['MotDePasse'] != $_POST['MotDePasse1']) {echo "mot de passe incorrect";}
            else {$motDePasseCrypt = password_hash($motDePasse, PASSWORD_BCRYPT, $options);} //cela cree une nouveau mot de passe ajoutons le cryptage et le cost aux mot de passe cree
            }
     else {

        try {
            $dbco = new PDO("mysql:host=$servername; dbname=n2_exo", $username, $passwordDB);

            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbco->beginTransaction(); //permet de démarrer ce qu’on appelle une transaction et de désactiver le mode autocommit.

            $sql1 = "INSERT INTO utilisateurs(nomU, prenomU, email, motDePasse, statut)
                    VALUES('$nom', '$prenom', '$email', '$motDePasseCrypt','$statut')";

            $dbco->exec($sql1);

            $dbco->commit(); //sert à valider une transaction, c’est-à-dire à valider l’application d’une ou d’un ensemble de requêtes SQL. Cette méthode va aussi replacer la connexion en mode autocommit.
            echo 'Entrées ajoutées dans la table';
        } catch (PDOException $e) {
            $dbco->rollBack(); //  sert à annuler une transaction si l’on s’aperçoit d’une erreur.
            echo "Erreur : " . $e->getMessage();
        }

        echo "<br>Vous etes inscrit!";
    }

    //aaaa8RRRa


    ?>
</body>

</html>