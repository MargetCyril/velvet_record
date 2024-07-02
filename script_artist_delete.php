<?php
if (!(isset($_GET['id'])) || intval($_GET['id']) <= 0) {
    header("Location: artists.php");
    exit;
}

require "db.php";
$db = connexionBase();

try {
    $requete = $db->prepare("DELETE FROM artist WHERE artist_id=?");
    $requete->execute(array($_GET["id"]));
    $requete->closeCursor();
}
catch (exception $e) {
    echo"Erreur : ".$e->getMessage()."<br>";
    die("Fin du script(script_artist_modif.php");
}

header("Location: artists.php");
exit;

?>