<?php

session_start();

session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;

$id_serie = $_POST['id_serie'];

$nom_serie = $_POST['nom_serie'];

$optionSaisonTV = $_POST['optionSaisonTV'];

$identifiant_streaming = $_POST['identifiant_streaming'];

$serveur_film = $_POST['serveur_film'];

$id_fichier = $_POST['id_fichier'];

$qualite_video = $_POST['qualite_video'];

$date_created = date("Y-m-d");

if ($optionSaisonTV == 'yes') {

    $id_saison = $_POST['id_saison'];

    $nom_saison = $_POST['nom_saison'];
}


if (!empty($_POST['url'])) {

    $url = $_POST['url'];
} else {

    $url = NULL;
}
try {

    $sql = " INSERT INTO  LinksServersEpisodesSerieTvEtrangere  (id_fichier,identifiant_streaming,id_serveur,url,date_created,qualite) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";



    $stmt = $cxn->prepare($sql);

    $stmt->bindParam(':param1', $id_fichier);

    $stmt->bindParam(':param2', $identifiant_streaming);

    $stmt->bindParam(':param3', $serveur_film);

    $stmt->bindParam(':param4', $url);

    $stmt->bindParam(':param5', $date_created);

    $stmt->bindParam(':param6', $qualite_video);

    $stmt->execute();
} catch (Exception $e1) {

    echo $e1->getMessage();

    $etat = FALSE;
}
/* * ******************************************** ***************************************************** */


if ($etat) {

    if ($optionSaisonTV == 'yes') {

        $url = $url_espace_admin . "/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=" . $id_serie . "&nom_serie=" . $nom_serie . "&saisonTV=" . $optionSaisonTV . "&nom_saison=" . $nom_saison . "&id_saison=" . $id_saison . "&message=success";
    } else {

        $url = $url_espace_admin . "/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=" . $id_serie . "&nom_serie=" . $nom_serie . "&saisonTV=" . $optionSaisonTV . "&message=success";
    }
} else {

    if ($optionSaisonTV == 'yes') {

        $url = $url_espace_admin . "/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=" . $id_serie . "&nom_serie=" . $nom_serie . "&saisonTV=" . $optionSaisonTV . "&nom_saison=" . $nom_saison . "&id_saison=" . $id_saison . "&message=echec";
    } else {

        $url = $url_espace_admin . "/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=" . $id_serie . "&nom_serie=" . $nom_serie . "&saisonTV=" . $optionSaisonTV . "&message=echec";
    }
}

header("Location:  $url ");
exit();
?>



