<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$nom_serie = $_POST['nom_serie'];

$idtmd = $_POST['idtmd'];

$etat = TRUE;

$date_created = date("Y-m-d");

$json_source = file_get_contents('https://api.themoviedb.org/3/tv/' . $idtmd . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');


// Decode le JSON
$json_data = json_decode($json_source);

$tab = explode("-", $json_data->first_air_date);

$annee_release = $tab[0];

$poster_path = "https://image.tmdb.org/t/p/w600_and_h900_bestv2" . $json_data->poster_path;

$overview = addslashes($json_data->overview);

if (!empty($_POST['button_register'])) {

    try {

        $sql = " INSERT INTO  SerieTvFr (nom_serie,id_TMD,date_created,overview,annee_release,poster_path) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nom_serie);

        $stmt->bindParam(':param2', $idtmd);

        $stmt->bindParam(':param3', $date_created);

        $stmt->bindParam(':param4', $overview);

        $stmt->bindParam(':param5', $annee_release);

        $stmt->bindParam(':param6', $poster_path);

        $stmt->execute();
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}

if (!empty($_POST['button_update'])) {

    $id_serie = $_POST['id_serie'];

    try {

        $sql = " UPDATE  SerieTvFr  SET  nom_serie=:param1,id_TMD=:param2,overview=:param4,annee_release=:param5,poster_path=:param6   WHERE id_serie=:param3 ";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $nom_serie);

        $stmt->bindParam(':param2', $idtmd);

        $stmt->bindParam(':param3', $id_serie);
        
        $stmt->bindParam(':param4', $overview);
        
        $stmt->bindParam(':param5', $annee_release);
        
        $stmt->bindParam(':param6', $poster_path);

        $stmt->execute();
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}

if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&message=success';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&message=echec';
}

header("Location:  $url");
?>

