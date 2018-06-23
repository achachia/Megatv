<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_serie = $_GET['nom_serie'];

$id_serie = $_GET['id_serie'];

$etat = TRUE;

$date_created = date("Y-m-d");

/* * ************************************************************************** */

try {

    $sql = " SELECT  id_TMD   FROM  SerieTvFr    WHERE  id_serie='" . $id_serie . "' ";

    $stmt = $cxn->prepare($sql);

    $stmt->execute();

    $enregistrement = $resultat->fetch();

    $idtmd = $enregistrement['id_TMD'];
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}


/* * ********************************************************************** */

$json_source = file_get_contents('https://api.themoviedb.org/3/tv/' . $idtmd . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');


// Decode le JSON
$json_data = json_decode($json_source);

$tab = explode("-", $json_data->first_air_date);

$annee_release = $tab[0];

$poster_path = "https://image.tmdb.org/t/p/w600_and_h900_bestv2" . $json_data->poster_path;

$overview = $json_data->overview;

/* * ********************************************************************** */

try {

    $sql = " UPDATE  SerieTvFr  SET  poster_path='" . $poster_path . "',overview='" . $overview . "',annee_release='" . $annee_release . "'   WHERE  id_serie='" . $id_serie . "' ";

    $stmt = $cxn->prepare($sql);

    $stmt->execute();
    
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}




if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&nom_serie=' . $nom_serie . '"message=success';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&nom_serie=' . $nom_serie . '"message=echec';
}

header("Location:  $url");
?>

