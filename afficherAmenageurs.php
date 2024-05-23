<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Ajout</title>
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

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Logo</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="afficherAmenageurs.php">Afficher</a></li>
                <li><a href="ajouterAmenageur.php">Ajouter</a></li>
                <li><a href="supprimerAmenageurs.php">Supprimer</a></li>
                <li><a href="recherches.php">Recherches</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-10">
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

		</table>
		</section>
</body>
</html>
