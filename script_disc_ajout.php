<?php
if (isset($_POST['titre']) && $_POST['titre'] != "") {
    $titre = $_POST['titre'];
}
else {
    $titre = Null;
}
$artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
$year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null;
$genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
$label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
$price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;

$uploaddir = "uploads/";
$uploadfile = $uploaddir . basename( $_FILES['file']['name']);

if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile))
{
  echo "The file has been uploaded successfully";
}
else
{
  echo "There was an error uploading the file";
}

if ($titre == Null || $artist == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $img == Null) {
    header("Location: disc_new.php");
    exit;
}

require "db.php";
$db = connexionBase();

try {
    $requete = $db->prepare("INSERT INTO disc (disc_title, artist_id, disc_year, disc_genre, disc_label, disc_price, disc_picture) VALUES (:titre, :artiste, :year, :genre, :label, :price, :img);");

    $requete->bindvalue(":titre", $titre, PDO::PARAM_STR);
    $requete->bindvalue(":artiste", $artiste, PDO::PARAM_STR);
    $requete->bindvalue(":year", $year, PDO::PARAM_INT);
    $requete->bindvalue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindvalue(":label", $label, PDO::PARAM_STR);
    $requete->bindvalue(":price", $price, PDO::PARAM_STR);
    $requete->bindvalue(":img", $img, PDO::PARAM_STR);

    $requete->execute();
    $requete->closeCursor();
}
catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : ". $e->getMessage()."<br>";
    die("Fin du script (script_disc_ajout.php)");
}

header("Location: discs.php");

exit;
?>