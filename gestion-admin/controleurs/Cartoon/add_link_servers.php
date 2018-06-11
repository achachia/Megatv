<?php

session_start();

session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;

$identifiant_streaming = $_POST['identifiant_streaming'];

$serveur_film = $_POST['serveur_film'];

$id_fichier = $_POST['id_fichier'];


$date_created = date("Y-m-d");


if (!empty($_POST['url'])) {

    $url = $_POST['url'];
} else {

    $url = NULL;
}
if ($_POST['action_module'] == 'all_films') {

    $action = 'all_cartoon';
}
if ($_POST['action_module'] == 'all_films_ligne') {

    $action = 'all_films_ligne';
}
try {

    $sql = " INSERT INTO  LinksServersFichierVod  (id_fichier,identifiant_streaming,id_serveur,url,date_created) VALUES (:param1,:param2,:param3,:param4,:param5)";



    $stmt = $cxn->prepare($sql);

    $stmt->bindParam(':param1', $id_fichier);

    $stmt->bindParam(':param2', $identifiant_streaming);

    $stmt->bindParam(':param3', $serveur_film);

    $stmt->bindParam(':param4', $url);

    $stmt->bindParam(':param5', $date_created);

    $stmt->execute();
} catch (Exception $e1) {

    echo $e1->getMessage();

    $etat = FALSE;
}
/* * ******************************************** ***************************************************** */


if ($etat) {

    $url = $url_espace_admin . "/index.php?module=Cartoon&action=".$action."&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=Cartoon&action=".$action."&message=echec";
}

header("Location:  $url ");
exit();
?>



