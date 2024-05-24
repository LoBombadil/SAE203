<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Rechercher</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="BaseBootstrap/css/ajouterAmenageur.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <img src="BaseBootstrap/img/logo_rt-removebg-preview.png" width=40%>
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
        <form method="POST" action="">
            <div class="form-group">
                <label for="commune">Choisissez votre commune</label>
                <select id="commune" name="commune" class="form-control" onchange="this.form.submit()">
                    <option value="">Sélectionner une commune</option>
                    <?php
                    // Connexion à la base de données
                    $servername = "127.0.0.1";
                    $dbname = "BUTRT1_lg409538";
                    $username = "lg409538";
                    $userpassword = "MDP_lg409538";

                    try {
                        $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", $username, $userpassword);
                        $lienBDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Obtenir la liste des communes
                        $requeteSQL = $lienBDD->prepare("SELECT DISTINCT s.commune FROM stations s ORDER BY s.commune;");
                        $requeteSQL->execute();
                        $communes = $requeteSQL->fetchAll(PDO::FETCH_ASSOC);

                        // Initialiser la liste des opérateurs
                        if (isset($_POST['commune']) && $_POST['commune'] !== '') {
                            $commune = $_POST['commune'];
                            // Obtenir la liste des opérateurs pour la commune sélectionnée
                            $requeteSQL = $lienBDD->prepare("SELECT DISTINCT o.nom FROM operateurs o
                                                    INNER JOIN stations s
                                                    ON o.id = s.operateur_id
                                                    WHERE s.commune = :commune
                                                    ORDER BY o.nom");
                            
                            $requeteSQL->bindParam(':commune', $commune, PDO::PARAM_STR);
                            $requeteSQL->execute();
                            $operateurs = $requeteSQL->fetchAll(PDO::FETCH_ASSOC);
                        }
                    } catch (PDOException $e) {
                        die("Erreur : " . $e->getMessage());
                    }
                    ?>

                    <?php 
                    foreach ($communes as $donnee): 
                    ?>
                        <option value="<?= $donnee['commune'] ?>" <?= (isset($commune) && $commune === $donnee['commune']) ? 'selected' : '' ?>>
                            <?= $donnee['commune'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <?php if (!empty($operateurs)): ?>
            <h2>Liste des opérateurs pour <?= $commune ?></h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nom de l'opérateur</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($operateurs as $operateur): ?>
                    <tr>
                        <td><?= $operateur['nom'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (isset($commune)): ?>
            <p>Aucun opérateur trouvé pour la commune sélectionnée.</p>
        <?php endif; ?>
    </section>
</div>
<footer class="container-fluid text-center">
  <p>
    <img src="BaseBootstrap/img/cropped-LOGOS_ADIUT_IUT_DIJON.png" width=20% align=left />
    sae203 © Yohann TSANGUE & Louis GRANVISIR-CLERC
  </p>
</footer>
    
</body>
</html>
