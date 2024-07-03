<?php
include "db.php";
$db = connexionBase();

$requete = $db->query("SELECT artist_name FROM artist");
$tableau = $requete->fetchAll(PDO::FETCH_OBJ);
$requete->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>PDO - Ajout</title>
</head>
<body>

    <h1>Saisie d'un nouveau disque</h1>

    <a href="discs.php"><button>Retour à la liste des disques</button></a>

    <br>
    <br>

    <form action ="script_disc_ajout.php" method="post">

        <label for="titre_for_label">Titre :</label><br>
        <input type="text" name="titre" id="titre_for_label" >
        <br><br>

        <label for="nom_for_label">Nom de l'artiste :</label><br>
        <select name="artist" id="nom_for_label">
                <option value=""> Choissisez l'artiste </option>
                <?php foreach($tableau as $disc): ?>
                    <option value="<?= $disc->artist_id ?>"><?= $disc->artist_name?></option>
                <?php endforeach ?>
        </select>
        <br><br>

        <label for="year_for_label">Année:</label><br>
        <input type="text" name="year" id="year_for_label">
        <br><br>

        <label for="genre_for_label">Genre:</label><br>
        <input type="text" name="genre" id="genre_for_label">
        <br><br>

        <label for="label_for_label">Label:</label><br>
        <input type="text" name="label" id="label_for_label">
        <br><br>

        <label for="price_for_label">Prix:</label><br>
        <input type="text" name="price" id="price_for_label">
        <br><br>

        <label for="img_for_label">Image:</label><br>
        <input type="file" name="img" id="img_for_label">
        <br><br>

        <input type="submit" value="Ajouter">

    </form>
</body>
</html>