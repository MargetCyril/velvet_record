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

        <form>

        <input type="hidden" name="id" value="<?= $myDisc->disc_id ?>">

        <label for="titre_for_label">Titre :</label><br>
        <input type="text" name="titre" id="titre_for_label" value="<?= $myDisc->disc_title ?>" readonly>
        <br><br>

        <label for="nom_for_label">Nom de l'artiste :</label><br>
        <input type="text" name="nom" id="nom_for_label" value="<?= $myDisc->artist_name ?>" readonly>
        <br><br>

        <label for="year_for_label">Année:</label><br>
        <input type="text" name="year" id="year_for_label" value="<?= $myDisc->disc_year ?>" readonly>
        <br><br>

        <label for="genre_for_label">Genre:</label><br>
        <input type="text" name="genre" id="genre_for_label" value="<?= $myDisc->disc_genre ?>" readonly>
        <br><br>

        <label for="label_for_label">Label:</label><br>
        <input type="text" name="label" id="label_for_label" value="<?= $myDisc->disc_label ?>" readonly>
        <br><br>

        <label for="price_for_label">Prix:</label><br>
        <input type="text" name="url" id="price_for_label" value="<?= $myDisc->disc_price ?>" readonly>
        <br><br>

        <img src="/jaquettes/<?=$myDisc->disc_picture?>">
        
    </form>
        <a href='disc_form.php?id=$myDisc->disc_id'><button>Modifier</button></a>
        <a href='script_disc_delete.php?id=$myDisc->disc_id' onclick='return confirm(`confirmer?`)'><button>Supprimer</button></a>
        
        <a href="discs.php"><button>Retour</button></a>

    </body>
    </html>