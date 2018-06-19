<?php

session_start();

session_regenerate_id();

require_once './connection/config_vod.php';

$etat = TRUE;

$objet = array();

$id_fichier = $_POST['id_fichier'];

$data = array();

/* * ***************** Infos bilan  *********************************** */

try {

    $sql = " SELECT LinksServersFichierVod.nom_fichier,FichierVod.id_fichier,FichierVod.titre_originale,FichierVod.section_fichier,FichierVod.taille_fichier,FichierVod.id_TMD,FichierVod.genre,FichierVod.overview,FichierVod.poster,FichierVod.annee_release "
            . " FROM  FichierVod,LinksServersFichierVod"
            . " WHERE FichierVod.id_fichier=LinksServersFichierVod.id_fichier  AND  FichierVod.id_fichier='" . $id_fichier . "'  ";
    


    $resultat = $cxn->prepare($sql);

    $resultat->execute();

    $enregistrement = $resultat->fetch();


    $data['id_fichier'] = $enregistrement['id_fichier'];

    $data['nom_fichier_complet'] = $enregistrement['nom_fichier'];    
    
    $data['titre_originale'] = $enregistrement['titre_originale'];

    $data['taille_fichier'] = $enregistrement['taille_fichier'];    

    $data['id_TMD'] = $enregistrement['id_TMD'];

    $data['section_fichier'] = $enregistrement['section_fichier'];

    $data['poster'] = $enregistrement['poster'];
    
    
} catch (Exception $ex) {

    echo $ex->getMessage();

    $etat = false;
}



$objet ['message'] ['reponse'] = $etat;

$objet ['message'] ['infos_movie'] = $data;

header('Content-type: application/json');

echo json_encode($objet);
?>