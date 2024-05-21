<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Amenageurs</title>
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
<ul class="row">
        <li><a href="afficherAmenageurs.php" target="_blank">Afficher_Amenageurs</a></li>
        <li><a href="ajouterAmenageur.php" target="_blank">Ajouter_Amenageurs</a></li>
        <li><a href="supprimerAmenageurs.php" target="_blank">Supprimer_Amenageurs</a></li>
        <li><a href="recherches.php" target="_blank">Recherches</a></li>
    </ul>
<body>
    <h1>Amenageurs</h1>
	<section class="col-md-7">

        <p>Entreprises ayant mis en place les stations de recharge.</p>

		<table>

				<th>siren</th>
				<th>nom</th>
				<th>contact</th>


            <?php

            try {
                // Récupération des données
                $servername = "127.0.0.1";
                $dbname = "BUTRT1_lg409538";
                $username = "lg409538";
                $userpassword = "MDP_lg409538";
                echo 'ca ma';
                $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$userpassword");
                $lienBDD->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$requeteSQL->execute();

                //Prepare la requête
                $requeteSQL = $lienBDD->prepare("SELECT siren, nom, contact FROM amenageurs");

                // Affichage des résultats dans un tableau
                $tab = $requeteSQL->fetchAll(PDO::FETCH_ASSOC);
                if ($tab) {
                    foreach ($tab as $row) {
                        echo "<tr><td>" . $row["siren"] . "</td><td>" . $row["nom"] . "</td><td>" . $row["contact"] . "</td></tr>";
                    }
                }
                else {
                    echo "<tr><td colspan='3'>0 résultats</td></tr>";
                }
            }
            catch (PDOException $e)
            {
            die("Erreur : ").$e-> getMessage();
            }
            ?>

		</table>
		</section>
</body>
</html>
