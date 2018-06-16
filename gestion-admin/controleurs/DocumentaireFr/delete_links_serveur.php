<?php

session_start();

session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;

$id_link = $_GET['id_link'];

try {

    $sql = " DELETE FROM  LinksServersFichierVod  WHERE  id_link='" . $id_link . "'";


    $stmt = $cxn->prepare($sql);



    $stmt->execute();
    
} catch (Exception $e1) {

    echo $e1->getMessage();

    $etat = FALSE;
}

if ($etat) {

    $url = $url_espace_admin . "/index.php?module=DocumentaireFr&action=all_films_ligne&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=DocumentaireFr&action=all_films_ligne&message=echec";
}

header("Location:  $url ");

exit();
?>


