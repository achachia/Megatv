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

