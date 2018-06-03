<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_saison = $_POST['nom_saison'];

$id_serie = $_POST['id_serie'];

$nom_serie = $_POST['nom_serie'];

$etat = TRUE;

$date_created = date("Y-m-d");

if (!empty($_POST['button_register'])) {

    try {

        $sql = " INSERT INTO  SaisonsTvEtrangere (nom_saison,id_serie ) VALUES (:param1,:param2)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nom_saison);

        $stmt->bindParam(':param2', $id_serie);


        $stmt->execute();
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}


if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=' . $id_serie . '&&nom_serie=' . $nom_serie . '&saisonTV=yes&message=success';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=' . $id_serie . '&&nom_serie=' . $nom_serie . '&saisonTV=yes&message=echec';
}

header("Location:  $url");
?>

