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

/* * ********************************************** */
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

        $sql = " INSERT INTO  EpisodesSerieTvFr (titre_originale,date_created,id_saison,Num_episode) VALUES (:param1,:param2,:param3,:param4)";

        $stmt = $cxn->prepare($sql);

        $stmt->bindParam(':param1', $titre_originale);       

        $stmt->bindParam(':param2', $date_created);

        $stmt->bindParam(':param3', $id_saison);

        $stmt->bindParam(':param4', $Num_episode);

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

        try {

            $sql = " INSERT INTO  LinksServersEpisodesSeriesTvFr (id_fichier,nom_fichier,id_serveur,url,date_created) VALUES ('" . $MaxId . "','" . $nom_fichier . "','" . $id_serveur . "','" . $url . "','" . $date_created . "') ";

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
