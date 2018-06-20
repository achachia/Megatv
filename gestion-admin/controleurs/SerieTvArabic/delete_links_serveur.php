<?php

session_start();

session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;

$id_serie = $_GET['id_serie'];

$nom_serie = $_GET['nom_serie'];

$optionSaisonTV = $_GET['optionSaisonTV'];

$id_link = $_GET['id_link'];

if ($optionSaisonTV == 'yes') {

    $id_saison = $_GET['id_saison'];

    $nom_saison = $_GET['nom_saison'];
}

try {

    $sql = " DELETE FROM  LinksServersEpisodesSerieTvEtrangere  WHERE  id_link='" . $id_link . "'";


    $stmt = $cxn->prepare($sql);



    $stmt->execute();
} catch (Exception $e1) {

    echo $e1->getMessage();

    $etat = FALSE;
}


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

