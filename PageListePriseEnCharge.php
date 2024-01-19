<?php
// Inclure le fichier de connexion à la base de données
include('connexionbdd.php');

// Requête SQL pour récupérer les prises en charge en cours
$sql = "SELECT `materiel_modele`, `materiel_mdp`, `materiel_id`, `id_client`, `materiel_prise_en_charge`, `materiel_etat_en_cours`, `materiel_type`, `materiel_marque`, `materiel_commentaire` FROM `materiel` WHERE 1";
$result = mysqli_query($db, $sql) or die("Erreur de requête");

// HTML pour afficher la page
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <title>Liste des prises en charge en cours</title>
</head>
<body>
  <header>
    <h1>Liste des prises en charge en cours</h1>
  </header>
  <div class="center">
    <table>
      <tr>
        <th>Nom</th>
        <th>Téléphone</th>
        <th>Date</th>
        <th>Type</th>
        <th>Modèle</th>
        <th>État</th>
      </tr>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['clientnom'] . ' ' . $row['clientprenom']; ?></td>
          <td><?php echo $row['clienttelephone']; ?></td>
          <td><?php echo $row['materiel_prise_en_charge']; ?></td>
          <td><?php echo $row['materiel_type']; ?></td>
          <td><?php echo $row['materiel_modele']; ?></td>
          <td><?php echo $row['materiel_etat_en_cours']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($db);
?>
