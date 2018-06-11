<?php

session_start();
session_regenerate_id();

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$etat = TRUE;

function InsertGenreMovie($name, $id) {

    global $cxn;

    try {

        $sql = " INSERT INTO  ListeGenreMovieTmdb (id_Tmdb,nom_genre) VALUES ('" . $id . "','" . $name . "') ";

        $resultat = $cxn->prepare($sql);

        $resultat->execute();
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}

/* * *********************** Donnes recus par le navigateur client *************************** */


$section_film = $_POST['section_film'];

$titre_original = $_POST['titre_original'];

$serveur_film = $_POST['serveur_film'];

$idtmd = $_POST['idtmd'];

$identifiant_streaming = $_POST['identifiant_streaming'];


$langage = 'VF';

if (!empty($_POST['url'])) {

    $url = $_POST['url'];
} else {

    $url = NULL;
}

$date_upload = date("Y-m-d");

$json_source = file_get_contents('https://api.themoviedb.org/3/movie/' . $idtmd . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');

// Décode le JSON
$json_data = json_decode($json_source);


$genres = '';

foreach ($json_data->genres as $key => $value) {

    $genres.= $value->name . ',';

    /*     * *********** Check genre film dans la table *********************** */

    try {

        $sql = " SELECT *  FROM  ListeGenreMovieTmdb  WHERE  nom_genre='" . $value->name . "'  ";

        $select = $cxn->query($sql);

        $nb = $select->rowCount();

        if ($nb <= 0) {

            InsertGenreMovie($value->id, $value->name);
        }
    } catch (Exception $e2) {

        echo $e2->getMessage();
    }

    /*     * ************************************************************* */
}
$genres = substr($genres, 0, -1);


if (!empty($_POST['add_serveur'])) {


    try {

        $sql = " INSERT INTO  FichierVod (titre_originale,date_upload,section_fichier,id_TMD,langage,genre) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)";
        
      

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $titre_original);

        $stmt->bindParam(':param2', $date_upload);

        $stmt->bindParam(':param3', $section_film);

        $stmt->bindParam(':param4', $idtmd);

        $stmt->bindParam(':param5', $langage);

        $stmt->bindParam(':param6', $genres);

        $stmt->execute();
        
    } catch (Exception $e1) {

        echo $e1->getMessage();

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
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

