<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Rechercher</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="BaseBootstrap/css/ajouterAmenageur.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
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
                <li class="active"><a href="#">Recherches</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1>Rechercher des aménageurs</h1>

    <section class="col-md-7">
        <form method="GET" action="votre_fichier_de_traitement.php">
            <div class="form-group">
                <label for="commune">Choisissez votre commune</label>
                <select id="commune" name="commune" class="form-control">
                    <option value="">Sélectionner une commune</option>
                    <?php
                    try {
                        // Connexion à la base de données
                        $servername = "127.0.0.1";
                        $dbname = "BUTRT1_lg409538";
                        $username = "lg409538";
                        $userpassword = "MDP_lg409538";

                        $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", $username, $userpassword);
                        $lienBDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Préparation de la requête SQL
                        $requeteSQL = $lienBDD->prepare("SELECT DISTINCT s.commune FROM stations s;");
                        $requeteSQL->execute();

                        // Afficher les résultats dans un tableau
                        $tab = $requeteSQL->fetchAll(PDO::FETCH_ASSOC);

                        if (count($tab) > 0) {
                            foreach ($tab as $donnees) {
                                echo "<option value='" . $donnees['commune'] . "'>" . $donnees['commune'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Aucune commune trouvée</option>";
                        }

                    } catch (PDOException $e) {
                        die("Erreur : " . $e->getMessage());
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="operateur">Choisissez votre opérateur</label>
                <select id="operateur" name="operateur" class="form-control">
                    <option value="">Sélectionner un opérateur</option>
                    <?php
                    try {
                        // Connexion à la base de données
                        $requeteSQL = $lienBDD->prepare("SELECT DISTINCT o.nom FROM operateurs o;");
                        $requeteSQL->execute();

                        // Afficher les résultats dans un tableau
                        $tab = $requeteSQL->fetchAll(PDO::FETCH_ASSOC);

                        if (count($tab) > 0) {
                            foreach ($tab as $donnees) {
                                echo "<option value='" . $donnees['nom'] . "'>" . $donnees['nom'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Aucun opérateur trouvé</option>";
                        }

                    } catch (PDOException $e) {
                        die("Erreur : " . $e->getMessage());
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </section>
</div>

</body>
</html>
