<?php
    $id = (isset($_POST['id']) && $_POST['id'] !="") ? $_POST['id'] : Null;
    $nom = (isset($_POST['nom']) && $_POST['nom'] != "") ? $_POST['nom'] : Null;
    $url = (isset($_POST['url']) && $_POST['url'] != "") ? $_POST['url'] :Null;

    if ($id == null) {
        header("Location: artists.php");
    }
    elseif ($nom == Null || $url == Null) {
        header("Location: artist_form.php?id=".$id);
        exit;
    }

    require "db.php";
    $db = connexionBase();

    try {
        $requete = $db->prepare("UPDATE artist SET artist_name = :nom, artist_url = :url WHERE artist_id = :id;");
        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->bindValue(":nom", $nom, PDO::PARAM_STR);
        $requete->bindValue(":url", $url, PDO::PARAM_STR);

        $requete->execute();
        $requete->closeCursor();
    }

    catch (Exception $e) {
        echo "Erreur : ".$e->getMessage()."<br>";
        die("Fin du script (script_artist_modif.php");
    }

    header("Location: artist_detail.php?id=".$id);
    exit;
    ?>
