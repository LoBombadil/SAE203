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

  <h1>Rechercher des aménageurs</h1>

  <section class="col-md-7">

    <label for="recherche">Quel est le nom de l'opérateur que vous recherchez ?</label>
    <select id="recherche" name="recherche">
      <option value="">Sélectionner un opérateur</option>

      <?php

      try {
        // Database connection details (replace with your actual credentials)
        $servername = "127.0.0.1";
        $dbname = "BUTRT1_lg409538";
        $username = "lg409538";
        $userpassword = "MDP_lg409538";

        $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", $username, $userpassword);
        $lienBDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL query
        $requeteSQL = $lienBDD->prepare("SELECT o.nom, s.commune FROM operateurs o INNER JOIN stations s ON o.id = s.operateur_id;");
        $requeteSQL->execute();

        // Fetch results as associative array
        $tab = $requeteSQL->fetchAll(PDO::FETCH_ASSOC);

        if (count($tab) > 0) {
          foreach ($tab as $donnees) {
            echo "<option value='" . $donnees['nom'] . "'>" . $donnees['nom'] . " (" . $donnees['commune'] . ")</option>";
          }
        } else {
          echo "<option value=''>Aucun opérateur trouvé</option>";
        }

      } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
      }

      ?>

    </select>

  </section>

</body>
</html>
