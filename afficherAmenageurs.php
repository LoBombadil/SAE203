<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Amenageurs</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/afficherAmenageurs.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
</head>
<ul class="row">
        <li><a href="afficherAmenageurs.php" target="_blank">Afficher_Amenageurs</a></li>
        <li><a href="afficherOperateurs.php" target="_blank">Afficher_Operateurs</a></li>
        <li><a href="afficherBornes.php" target="_blank">Afficher_Bornes</a></li>
        <li><a href="recherche.php" target="_blank">Recherche</a></li>
    </ul>
<body>
<h1>LE BOSS LOUIS</h1>
	<section class="col-md-7">
		<h1>Amenageurs</h1>
		<table>

				<th>siren</th>
				<th>nom</th>
				<th>contact</th>


            <?php

            //recuperation des donnees
            $servername = "127.0.0.1";
            $dbname = "BUTRT1_lg409538";
            $username = "lg409538";
            $userpassword = "MDP_lg409538";
            $lienBDD = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$userpassword");
            $lienBDD->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            if ($lienBDD->connect_error) {
                die("Erreur de connection: " . $lienBDD->connect_error);
            }

            $sql = "SELECT siren, nom, contact from amenageurs";
            $result = $lienBDD->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["siren"]."</td><td>".$row["nom"]."</td><td>".$row["contact"]."</td></tr>";
                }
                echo "</table>";
            }
            else {
                echo "0 resultats";
            }
            $lienBDD->close();

            ?>

		</table>
		</section>
</body>
</html>
