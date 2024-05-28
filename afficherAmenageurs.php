<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Affichage de l'Amenageur</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="BaseBootstrap/css/afficherAmenageurs.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
          rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-inverse">
	<div class="container-fluid">
	<div class="navbar-header">
	<button class="navbar-toggler" id="navbtn" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<img src="BaseBootstrap/img/logo_rt-removebg-preview.png" width=30%>
	</button>
	</div>
    <!--<div class="container-fluid">
        <div class="navbar-header">
            <img src="BaseBootstrap/img/logo_rt-removebg-preview.png" width=40%>
	</div>-->
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="afficherAmenageurs.php">Afficher</a></li>
                <li><a href="ajouterAmenageur.html">Ajouter</a></li>
                <li><a href="supprimerAmenageurs.html">Supprimer</a></li>
                <li><a href="recherches.php">Recherches</a></li>
	    </ul>
	COPYRIGHT © SAE203 - by GRANVISIR-CLERC
        </div>
    </div>
</nav>

    <div class="row content">
        <div class="col-sm-8 text-left">
            <h1>Amenageur</h1>
            <section class="col-md-7">
                <form action="afficherAmenageurs.php" method="get">
                    <fieldset>
                        <legend>Affiche Amenageur</legend>
                        <table>
                            <tr>
                                <th>siren</th>
                                <th>nom</th>
                                <th>contact</th>
                            </tr>
                    </fieldset>
                </form>
            </section>
        </div>
    </div>
</div>
            <?php

            try {
                // Récupération des données
                $servername = "127.0.0.1";
                $dbname = "BUTRT1_lg409538";
                $username = "lg409538";
                $userpassword = "MDP_lg409538";
                //echo 'ca ma';
                $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$userpassword");
                $lienBDD->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Acces BDD réaliser";

                //Prepare la requête
                $requeteSQL = $lienBDD->prepare("SELECT siren, nom, contact FROM amenageurs");
                $requeteSQL->execute();
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

<footer class="container-fluid text-center">
  <p>
    <img src="BaseBootstrap/img/cropped-LOGOS_ADIUT_IUT_DIJON.png" width=20% align=left />
    COPYRIGHT © SAE203 - by Louis GRANVISIR-CLERC
  </p>
</footer>
</body>
</html>
