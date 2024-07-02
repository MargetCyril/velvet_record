<?php
    require "db.php";
    $db = connexionBase();

    $id = $_GET["id"];

    $requete = $db->prepare("SELECT * FROM artist WHERE artist_id=?");
    $requete->execute(array($id));

    $myArtist = $requete->fetch(PDO::FETCH_OBJ);

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
        
        <?php 
        if ($myArtist->artist_id == NULL)
        echo "artiste inconnu à cette adresse";

        else
        echo "
        Artiste N°$myArtist->artist_id
        Nom de l'artiste: $myArtist->artist_name
        Site Internet: $myArtist->artist_url
        <a href='artist_form.php?id=$myArtist->artist_id'>Modifier</a>
        <a href='script_artist_delete.php?id=$myArtist->artist_id' onclick='return confirm(`confirmer?`)'>Supprimer</a>"
        ?>


    </body>
    </html>