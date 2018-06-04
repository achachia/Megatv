<?php

//header('Content-type: application/json');

require_once './../../connection/config_vod.php';


ini_set('date.timezone', 'Europe/Paris');


$titre_originale = $_POST['titre_originale'];

$identifiant_streaming = $_POST['identifiant_streaming'];



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




if (!empty($_POST['button_register'])) {


    try {

        if (!empty($_POST['id_saison'])) {
            

            $sql = " INSERT INTO  EpisodesSerieTvEtrangere (titre_originale,identifiant_streaming,id_saison,id_serie,id_serveur,url) VALUES ('" . $titre_originale . "','" . $identifiant_streaming . "','" . $id_saison . "','" . $id_serie . "','" . $id_serveur . "','" . $url . "')";
            
        } else {
            

            $sql = " INSERT INTO  EpisodesSerieTvEtrangere (titre_originale,identifiant_streaming,id_serie,id_serveur,url) VALUES ('" . $titre_originale . "','" . $identifiant_streaming . "','" . $id_serie . "','" . $id_serveur . "','" . $url . "')";
        }



        $stmt = $cxn->prepare($sql);

        $stmt->execute();
    } catch (Exception $e) {

        $etat = FALSE;

        $objet ['message_erreur'] [] = 'Probleme dans l\'excution de la requette' . $sql;
    }
}






if ($etat) {

    $url = $url_espace_admin . '/index.php?module=SerieTvTurke&action=all_serie_tv_turke&id_serie=' . $id_serie . '&&nom_serie=' . $nom_serie . '&saisonTV=yes&message=success';
} else {

    $url = $url_espace_admin . '/index.php?module=SerieTvTurke&action=all_serie_tv_turke&id_serie=' . $id_serie . '&&nom_serie=' . $nom_serie . '&saisonTV=yes&message=echec';
}

header("Location:  $url");
?>



