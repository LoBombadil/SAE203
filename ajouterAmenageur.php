<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Ajout</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="BaseBootstrap/css/afficherAmenageurs.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
</head>
<body>
        <ul class="row">
                <li><a href="afficherAmenageurs.php" target="_blank">Afficher_Amenageurs</a></li>
                <li><a href="ajouterAmenageur.php" target="_blank">Ajouter_Amenageurs</a></li>
                <li><a href="supprimerAmenageurs.php" target="_blank">Supprimer_Amenageurs</a></li>
                <li><a href="recherches.php" target="_blank">Recherches</a></li>
        </ul>
        <h1>Amenageurs</h1>
        <section class="col-md-7">

                <?php
                        // récupération des données du formulaire
                        $siren=$_GET["siren"];
                        $nom=$_GET["nom"];
                        $contact=$_GET["contact"];
                        echo "<p>siren : $siren</p>";
                        echo "<p>nom : $nom</p>";
                        echo "<p>contact : $contact</p>";

                        try {
                                // Récupération des données
                                $servername = "127.0.0.1";
                                $dbname = "BUTRT1_lg409538";
                                $username = "lg409538";
                                $userpassword = "MDP_lg409538";

                                $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$userpassword");
                                $lienBDD->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                // Preparation de la requête
                                $requeteSQL = $lienBDD->prepare("INSERT INTO amenageurs (siren, nom, contact) VALUES (:siren, :nom, :contact)");

                                // Liaison des données avec la requête SQL
                                $requeteSQL->bindParam(":siren",$siren);
                                $requeteSQL->bindParam(":nom",$nom);
                                $requeteSQL->bindParam(":contact",$contact);

                                // Exécution de la requête SQL
                                $requeteSQL->execute();
                                echo "<p>Votre aménageur a bien été ajouté à la base de donnée !</p>"
                        }
                        catch (PDOException $e)
                        {
                                // traitement d'erreurs
                                die ("Erreur : ".$e->getMessage());
                        }
                        $lienBDD=null;
        ?>
</body>
</html>
