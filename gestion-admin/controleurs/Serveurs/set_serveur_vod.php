<?php

session_start();

session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_serveur = $_POST['nom_serveur'];

$url_serveur = $_POST['url_serveur'];

$logo_serveur = $_POST['logo_serveur'];

$emplacement_serveur = $_POST['emplacement_serveur'];

$date_created = date("Y-m-d H:i:s");

$etat = true;

try {

    $sql = " INSERT INTO  ListeServeursVod (nom_serveur,logo,url_serveur,date_created,emplacement) VALUES ('" . $nom_serveur . "','" . $logo_serveur . "','" . $url_serveur . "','" . $date_created . "','" . $emplacement_serveur . "')";

    $stmt = $cxn->prepare($sql);

    $stmt->execute();
} catch (Exception $e) {

    echo $e->getMessage();

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}
if ($etat) {

    $url = $url_espace_admin . "/index.php?module=Serveurs&action=all_serveurs_vod&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=Serveurs&action=all_serveurs_vod&message=echec";
}

header("Location:  $url ");
exit();
?>

