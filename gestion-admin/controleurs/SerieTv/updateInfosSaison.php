<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_serie = $_GET['nom_serie'];

$id_serie = $_GET['id_serie'];

$id_saison = $_GET['id_saison'];

$etat = TRUE;

$date_created = date("Y-m-d");

/* * ************************************************************************** */

try {

    $sql = "  SELECT  SaisonsTvFr.id_saison,SaisonsTvFr.Num_saison,SerieTvFr.id_TMD  FROM SaisonsTvFr,SerieTvFr    WHERE    SaisonsTvFr.id_serie=SerieTvFr.id_serie  AND  SaisonsTvFr.id_serie='" . $id_serie . "'   AND   SaisonsTvFr.id_saison='" . $id_saison . "' ";

    $stmt = $cxn->prepare($sql);

    $stmt->execute();

    $enregistrement = $stmt->fetch();

    $id_TMD = $enregistrement['id_TMD'];
    
    $num_saison = $enregistrement['Num_saison'];
    
    
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}


/* * ********************************************************************** */

$json_source = file_get_contents('https://api.themoviedb.org/3/tv/' . $id_TMD . '/season/' . $num_saison . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');


$json_data = json_decode($json_source);

$tab = explode("-", $json_data->air_date);

$date_release = $tab[2] . '-' . $tab[1] . '-' . $tab[0];

$date_release = $date_release;

$poster_path = "https://image.tmdb.org/t/p/w600_and_h900_bestv2" . $json_data->poster_path;



$overview = addslashes($json_data->overview);

/* * ********************************************************************** */
//var_dump($etat);


try {

    $sql = " UPDATE  SaisonsTvFr  SET  poster_path='" . $poster_path . "',overview='" . $overview . "',annee_release='" . $annee_release . "'   WHERE  id_saison='" . $id_saison . "' ";
 

    $stmt = $cxn->prepare($sql);

    $stmt->execute();
    
} catch (Exception $e) {

    $etat = FALSE;

    $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
}




if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&nom_serie=' . $nom_serie . '&message=success';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&nom_serie=' . $nom_serie . '&message=echec';
}

header("Location:  $url");
?>


