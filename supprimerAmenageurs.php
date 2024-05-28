<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Supprimer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="BaseBootstrap/css/ajouterAmenageur.css">
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
        </div>
    </div>
</nav>

    <div class="row content">
        <div class="col-sm-2 sidenav">

        </div>
        <div class="col-sm-8 text-left">
            <h1>Amenageur</h1>
            <section class="col-md-7">
            <?php
                // récupération des données du formulaire
                $siren=$_GET["siren"];
                $nom=$_GET["nom"];
                $contact=$_GET["contact"];
                //echo "<p>siren : $siren</p>";
                //echo "<p>nom : $nom</p>";
                //echo "<p>contact : $contact</p>";

                try {
                    // Récupération des données
                    $servername = "127.0.0.1";
                    $dbname = "BUTRT1_lg409538";
                    $username = "lg409538";
                    $userpassword = "MDP_lg409538";

                    $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$userpassword");
                    $lienBDD->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Suppression de donne de la table amenageurs
                    $requeteSQL = $lienBDD->prepare("DELETE FROM amenageurs
                                                    WHERE siren=:siren
                                                    AND nom=:nom
                                                    AND contact=:contact");

                    // Liaison des données avec la requête SQL
                    $requeteSQL->bindParam(":siren",$siren);
                    $requeteSQL->bindParam(":nom",$nom);
                    $requeteSQL->bindParam(":contact",$contact);

                    // Exécution de la requête SQL
                    $requeteSQL->execute();
                    echo "<p class='panel panel-success'>Votre aménageur a bien été supprimé à la base de données !</p>";
                }
                catch (PDOException $e)
                {
                    // traitement d'erreurs
                    die ("Erreur : ".$e->getMessage());
                }
                ?>
		<a class="btn btn-primary" href="supprimerAmenageurs.html" role="button">Supprimer un autre amenageur</a>
		<a class="btn btn-outline-dark" href="ajouterAmenageur.html" role="button">Ajouter un amenageur</a>
            </section>
        </div>
    </div>
</div>
    
<footer class="container-fluid text-center">
  <p>
    <img src="BaseBootstrap/img/cropped-LOGOS_ADIUT_IUT_DIJON.png" width=20% align=left />
    COPYRIGHT © SAE203 - by TSANGUE
  </p>
</footer>
    
</body>
</html>
