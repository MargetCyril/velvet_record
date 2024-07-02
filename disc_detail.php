<?php
    require "db.php";
    $db = connexionBase();

    $id = $_GET["id"];

    $requete = $db->prepare("SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE disc_id=?");
    $requete->execute(array($id));

    $myDisc = $requete->fetch(PDO::FETCH_OBJ);

    $requete->closeCursor();
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDO Detail</title>
    </head>
    <body>
        <h4>Details</h4>

        <?php 
        if ($myDisc->disc_id == NULL) {
        echo "disque inconnu à cette adresse";
        exit;
        }
        ?>

        <form action ="script_artist_modif.php" method="post">

        <input type="hidden" name="id" value="<?= $myDisc->disc_id ?>">

        <label for="nom_for_label">Nom de l'artiste :</label><br>
        <input type="text" name="nom" id="nom_for_label" value="<?= $myDisc->artist_name ?>" readonly>
        <br><br>

        <label for="url_for_label">Adresse site internet:</label><br>
        <input type="text" name="url" id="url_for_label" value="<?= $myDisc->artist_url ?>">
        <br><br>

        <input type="reset" value="Annuler">

    </form>


    </body>
    </html>