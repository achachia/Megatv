<?php

//header('Content-type: application/json');

require_once './../../connection/config_vod.php';


ini_set('date.timezone', 'Europe/Paris');


$titre_originale = $_POST['titre_originale'];

$identifiant_streaming = $_POST['identifiant_streaming'];

$qualite_video = $_POST['qualite_video'];

$id_serie = $_POST['id_serie'];

$nom_serie = $_POST['nom_serie'];

$saisonTV = $_POST['saisonTV'];

$id_serveur = $_POST['serveur_film'];

if (!empty($_POST['url'])) {

    $url = $_POST['url'];
} else {

    $url = NULL;
}


$etat = TRUE;

$date_upload = date("Y-m-d");

$objet = array();


if (!empty($_POST['id_saison'])) {   


    $optionSaison = 'yes';
    
    $id_saison=$_POST['id_saison'];
    
} else {

    $optionSaison = 'no';
}




if (!empty($_POST['button_register'])) {


    try {

        if (!empty($_POST['id_saison'])) {


            $sql = " INSERT INTO  EpisodesSerieTvEtrangere (titre_originale,id_saison,id_serie) VALUES ('" . $titre_originale . "','" . $id_saison . "','" . $id_serie . "')";
        } else {


            $sql = " INSERT INTO  EpisodesSerieTvEtrangere (titre_originale,id_serie) VALUES ('" . $titre_originale . "','" . $id_serie . "')";
        }



        $stmt = $cxn->prepare($sql);

        $stmt->execute();
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }

    /*     * ************************************************************************************************* */

    try {

        $sql = " SELECT MAX(id_episode) AS MaxId  FROM EpisodesSerieTvEtrangere ";

        $stmt = $cxn->prepare($sql);

        $stmt->execute();

        $enregistrement = $stmt->fetch();

        $MaxId = $enregistrement['MaxId'];
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }

    /*     * ********************************************************************************************* */
    try {

        if (!empty($_POST['id_saison'])) {


            $sql = " INSERT INTO  LinksServersEpisodesSerieTvEtrangere  (id_fichier,identifiant_streaming,id_serveur,url,qualite,date_created) VALUES ('" . $MaxId . "','" . $identifiant_streaming . "','" . $id_serveur . "','" . $url . "','" . $qualite_video . "','" . $date_upload . "')";
        } else {


            $sql = " INSERT INTO  LinksServersEpisodesSerieTvEtrangere (id_fichier,identifiant_streaming,id_serveur,url,qualite,date_created) VALUES ('" . $MaxId . "','" . $identifiant_streaming . "','" . $id_serveur . "','" . $url . "','" . $qualite_video . "','" . $date_upload . "')";
        }


        $stmt = $cxn->prepare($sql);

      $stmt->execute();
        
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}






if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=' . $id_serie . '&&nom_serie=' . $nom_serie . '&saisonTV=' . $optionSaison . '&message=success';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTvArabic&action=all_serie_tv_arabic&id_serie=' . $id_serie . '&&nom_serie=' . $nom_serie . '&saisonTV=' . $optionSaison . '&message=echec';
}

echo $url;

header("Location:  $url");
?>



