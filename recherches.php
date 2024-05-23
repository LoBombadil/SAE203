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

    <label for="recherche">Choisissez votre commune</label>
    <select id="recherche" name="recherche">
      <option value="">Sélectionner une commune</option>
    </select>
    

    <label for="recherche"> Choisiser votre operateur</label>
    <select id="recherche" name="recherche">
      <option value="">Sélectionner un opérateur</option>
    </select>

   
      <?php

      try {
        // Connexion à la base de données
        $servername = "127.0.0.1";
        $dbname = "BUTRT1_lg409538";
        $username = "lg409538";
        $userpassword = "MDP_lg409538";

        $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", $username, $userpassword);
        $lienBDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparation de la requête SQL
        $requeteSQL = $lienBDD->prepare("SELECT DISTINCT o.nom, s.commune FROM operateurs o INNER JOIN stations s ON o.id = s.operateur_id;");
        $requeteSQL->execute();

        // Afficher les résultats dans un tableau
        $tab = $requeteSQL->fetchAll(PDO::FETCH_ASSOC);

        if (count($tab) > 0) {
          foreach ($tab as $donnees) {
		  echo "<option value='" . $donnees['nom'] . "'>" . $donnees['nom'] . "</option>";
		  echo "<option value='" . $donnees['commune'] . "'>" . $donnees['commune'] . "</option>";
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
