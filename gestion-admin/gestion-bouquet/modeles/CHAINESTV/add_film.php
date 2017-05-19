<?php

function liste_sources() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT nom_source,id_source FROM SourcesVod  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['id_source'] = $enregistrement['id_source'];
            $liste[$i]['nom_source'] = html_entity_decode($enregistrement['nom_source']);            
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function info_film($id_film) {
    global $cxn;
    $infos = array();
    try {     
        $sql = "  SELECT  titre_originale,nom_fichier,compte_source,date_upload,taille_fichier,section_fichier  FROM  FichierVod  WHERE id_fichier='" . $id_film . "' ";
        $select = $cxn->query($sql);
        $enregistrement = $select->fetch(); 
        $infos['titre_originale'] = html_entity_decode($enregistrement ['titre_originale']);
        $infos['nom_fichier'] = html_entity_decode($enregistrement ['nom_fichier']);
        $infos['id_source'] = html_entity_decode($enregistrement ['compte_source']);
        $infos['date_upload'] = html_entity_decode($enregistrement ['date_upload']);
        $infos['taille_fichier'] = html_entity_decode($enregistrement ['taille_fichier']);
        $infos['section_fichier'] = html_entity_decode($enregistrement ['section_fichier']);
        
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

