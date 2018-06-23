<?php

require_once './../../connection/config_vod.php';

ini_set('date.timezone', 'Europe/Paris');

$titre_originale = $_POST['titre_originale'];

$nom_fichier = $_POST['nom_fichier'];

$date_created = date("Y-m-d");

$id_serie = $_POST['id_serie'];

$id_saison = $_POST['id_saison'];

$nom_serie = $_POST['nom_serie'];

$nom_saison = $_POST['nom_saison'];

$Num_episode = $_POST['Num_episode'];

$id_serveur = $_POST['serveur_episode'];

$nom_serie = $_POST['nom_serie'];

$nom_saison = $_POST['nom_saison'];

$etat = TRUE;

/* * ************************************************************************** */

try {

    $sql = "  SELECT  SaisonsTvFr.Num_saison,SerieTvFr.id_TMD  "
            . " FROM SaisonsTvFr,SerieTvFr    "
            . " WHERE   SaisonsTvFr.id_serie=SerieTvFr.id_serie  AND  SaisonsTvFr.id_saison='" . $id_saison . "'  ";

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

$json_source = file_get_contents('https://api.themoviedb.org/3/tv/' . $id_TMD . '/season/' . $num_saison . '/episode/' . $Num_episode . '?api_key=cf673ba3b2a3baceeeefa90d7460cd10&language=fr');

$json_data = json_decode($json_source);

$tab = explode("-", $json_data->air_date);

$date_release = $tab[2] . '-' . $tab[1] . '-' . $tab[0];

$poster_path = "https://image.tmdb.org/t/p/w600_and_h900_bestv2" . $json_data->poster_path;

$overview = addslashes($json_data->overview);

/* * ********************************************************************** */
/* * **************** Recuperer url serveur ****************************************** */
try {

    $sql = " SELECT url_serveur FROM  ListeServeursVod  WHERE  id_serveur=:param";

    $stmt = $cxn->prepare($sql);

    $stmt->bindParam(':param', $id_serveur);

    $stmt->execute();

    $enregistrement = $stmt->fetch();

    $url_serveur = $enregistrement['url_serveur'];
} catch (Exception $ex) {

    $etat = FALSE;

    echo $ex->getMessage();
}
$url = $url_serveur . '/Serie-Tv/' . $nom_serie . "/" . $nom_saison . "/" . $nom_fichier;


/* * ********************************************************** */


if (!empty($_POST['button_register'])) {

    try {

        $sql = " INSERT INTO  EpisodesSerieTvFr (titre_originale,date_created,id_saison,Num_episode,date_release,poster_path,overview) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $titre_originale);       

        $stmt->bindParam(':param2', $date_created);

        $stmt->bindParam(':param3', $id_saison);

        $stmt->bindParam(':param4', $Num_episode);
        
        $stmt->bindParam(':param5', $date_release);
        
        $stmt->bindParam(':param6', $poster_path);
        
        $stmt->bindParam(':param7', $overview);

        $stmt->execute();
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
    
            /*         * ******************* Recuperation Id d'enregistrement ***************************** */
        try {

            $sql = " SELECT MAX(id_episode) AS MaxId  FROM EpisodesSerieTvFr ";

            $stmt = $cxn->prepare($sql);

            $stmt->execute();

            $enregistrement = $stmt->fetch();

            $MaxId = $enregistrement['MaxId'];
        } catch (Exception $e) {

            $etat = FALSE;

            $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
        }

        /*         * ************************ Insertion link server ********************************* */



        $date_created = date("Y-m-d");
        
        $qualite_video = $_POST['qualite_video'];

        try {

            $sql = " INSERT INTO  LinksServersEpisodesSeriesTvFr (id_fichier,nom_fichier,id_serveur,url,date_created,qualite) VALUES ('" . $MaxId . "','" . $nom_fichier . "','" . $id_serveur . "','" . $url . "','" . $date_created . "','" . $qualite_video . "') ";

            $resultat = $cxn->prepare($sql);

            $resultat->execute();
            
        } catch (Exception $e) {

            echo $e->getMessage();
        }
}


if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&id_saison=' . $id_saison . '&nom_serie=' . $nom_serie . '&nom_saison=' . $nom_saison . '&message=succes';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTv&action=all_serie_tv&id_serie=' . $id_serie . '&id_saison=' . $id_saison . '&nom_serie=' . $nom_serie . '&nom_saison=' . $nom_saison . '&message=echec';
}

header("Location:  $url");
?>
