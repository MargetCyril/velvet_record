<?php
include "db.php";
$db = connexionBase();

$requete = $db->query("SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id");
$tableau = $requete->fetchAll(PDO::FETCH_OBJ);
$requete->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discs</title>
</head>
<body>
    
<h1> Liste des disques (<?= $disc->disc_id?>) </h1>

    <?php foreach ($tableau as $disc): ?>
        
        <table>
            <tr><td rowspan=7 ><img src="/jaquettes/<?=$disc->disc_picture?>" style="width: 50%"></td></tr>
            <tr><td><?= $disc->disc_title?></td></tr>
            <tr><td><?= $disc->artist_name?></td></tr>
            <tr><td><?= $disc->disc_label?></td></tr>
            <tr><td><?= $disc->disc_year?></td></tr>
            <tr><td><?= $disc->disc_genre?></td></tr>
            <tr><td><a href="disc_detail.php?id=<?= $disc->disc_id?>"><button>Détail</button></a></td>
        </table>
        
    <?php endforeach; ?>
   
</body>
</html>