<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="n2_exo.php" method="post">
        <input type="text" name="Login">
        <input type="text" name="Password">
        <input type="submit" value="Envoyer">
    </form>

    <?php
            $login = $_POST["Login"];
            $password = $_POST["Password"];


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
            
            try{
                $dbco = new PDO("mysql:host=$servername; dbname=n2_exo", $username, $passwordDB);

                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $dbco->beginTransaction(); //permet de démarrer ce qu’on appelle une transaction et de désactiver le mode autocommit.

                $sql1 = "INSERT INTO connexions(id, login, motDePasse, date)
                         VALUES( '1', '$login', '$password', '2010-01-01 10:10:11')";

                $dbco->exec($sql1);

                $dbco->commit(); //sert à valider une transaction, c’est-à-dire à valider l’application d’une ou d’un ensemble de requêtes SQL. Cette méthode va aussi replacer la connexion en mode autocommit.
                echo 'Entrées ajoutées dans la table';

                }

                catch(PDOException $e){
                    $dbco->rollBack(); //  sert à annuler une transaction si l’on s’aperçoit d’une erreur.
                  echo "Erreur : " . $e->getMessage();
                }
        ?>
</body>
</html>