<?php

session_start();
session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;



/* * *********************** Donnes recus par le navigateur client *************************** */


$section_film = $_POST['section_film'];

$titre_original = $_POST['titre_original'];

$idtmd = $_POST['idtmd'];

$langage = 'VF';

$genre=$_POST['genre_doc'];

if (!empty($_POST['url'])) {

    $url = $_POST['url'];
    
} else {

    $url = NULL;
}

$date_upload = date("Y-m-d");


if (!empty($_POST['add_serveur'])) {


    try {

        $sql = " INSERT INTO  FichierVod (titre_originale,date_upload,section_fichier,id_TMD,langage,genre) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";



        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $titre_original);

        $stmt->bindParam(':param2', $date_upload);

        $stmt->bindParam(':param3', $section_film);

        $stmt->bindParam(':param4', $idtmd);

        $stmt->bindParam(':param5', $langage);

        $stmt->bindParam(':param6', $genre);

        $stmt->execute();
        
    } catch (Exception $e1) {

        echo $e1->getMessage();

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
    /*     * ******************************************************************* */

    try {

        $sql = " SELECT MAX(id_fichier) AS MaxId  FROM FichierVod ";

        $stmt = $cxn->prepare($sql);

        $stmt->execute();

        $enregistrement = $stmt->fetch();

        $MaxId = $enregistrement['MaxId'];
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }




    /*     * ******************************************************************* */

    $id_serveur = $_POST['serveur_film'];

    $identifiant_streaming = $_POST['identifiant_streaming'];

    $qualite_video = $_POST['qualite_video'];

    if (!empty($_POST['url'])) {

        $url = $_POST['url'];
    } else {

        $url = NULL;
    }
    try {

        $sql = " INSERT INTO  LinksServersFichierVod (id_fichier,id_serveur,url,date_created,qualite) VALUES ('" . $MaxId . "','" . $id_serveur . "','" . $url . "','" . $date_upload . "','" . $qualite_video . "') ";

        $resultat = $cxn->prepare($sql);

        $resultat->execute();
        
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}



if ($etat) {

    $url = $url_espace_admin . "/index.php?module=DocumentaireFr&action=all_films_ligne&message=success";
} else {

    $url = $url_espace_admin . "/index.php?module=DocumentaireFr&action=all_films_ligne&message=echec";
}

header("Location:  $url ");

exit();
?>

