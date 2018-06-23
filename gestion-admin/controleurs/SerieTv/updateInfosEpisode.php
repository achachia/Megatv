<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$id_episode = $_GET['id_saison'];

$etat = TRUE;

$date_created = date("Y-m-d");

/* * ************************************************************************** */

try {

    $sql = "  SELECT  EpisodesSerieTvFr.Num_episode,SaisonsTvFr.Num_saison,SaisonsTvFr.id_saison,SaisonsTvFr.nom_saison,SerieTvFr.id_TMD,SerieTvFr.id_serie,SerieTvFr.nom_serie  "
            . " FROM EpisodesSerieTvFr,SaisonsTvFr,SerieTvFr    "
            . " WHERE  EpisodesSerieTvFr.id_saison=SaisonsTvFr.id_saison   AND SaisonsTvFr.id_serie=SerieTvFr.id_serie  AND  EpisodesSerieTvFr.id_episode='" . $id_episode . "'  ";

    $stmt = $cxn->prepare($sql);

    $stmt->execute();

    $enregistrement = $stmt->fetch();

    $id_serie = $enregistrement['id_serie'];

    $id_saison = $enregistrement['id_saison'];

    $nom_saison = $enregistrement['nom_saison'];

    $nom_serie = $enregistrement['nom_serie'];

    $id_TMD = $enregistrement['id_TMD'];

    $num_saison = $enregistrement['Num_saison'];

    $num_episode = $enregistrement['Num_episode'];
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}


/* * ********************************************************************** */

$json_source = file_get_contents('https://api.themoviedb.org/3/tv/' . $id_TMD . '/season/' . $num_saison . '/episode/' . $num_episode . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');

$json_data = json_decode($json_source);

$tab = explode("-", $json_data->air_date);

$date_release = $tab[2] . '-' . $tab[1] . '-' . $tab[0];

$poster_path = "https://image.tmdb.org/t/p/w600_and_h900_bestv2" . $json_data->poster_path;

$overview = addslashes($json_data->overview);

/* * ********************************************************************** */
//var_dump($etat);


try {

    $sql = " UPDATE  EpisodesSerieTvFr  SET  poster_path='" . $poster_path . "',overview='" . $overview . "',date_release='" . $date_release . "'   WHERE  id_saison='" . $id_saison . "' ";


    $stmt = $cxn->prepare($sql);

    $stmt->execute();
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}




if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&id_saison=' . $id_saison . '&nom_serie=' . $nom_serie . '&nom_saison=' . $nom_saison . '&message=succes';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&id_saison=' . $id_saison . '&nom_serie=' . $nom_serie . '&nom_saison=' . $nom_saison . '&message=echec';
}

header("Location:  $url");
?>



