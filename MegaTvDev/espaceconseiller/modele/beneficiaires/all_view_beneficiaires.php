<?php

//modele
function liste_beneficiaires() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  eleve_famille.code_famille,eleve_famille.code_eleve,eleve_famille.date_inscription,CONCAT(eleve_famille.nom, '.',eleve_famille.prenom) AS nom_eleve,CONCAT(membre_famille.nom, '.',membre_famille.prenom) AS nom_famille  FROM eleve_famille,membre_famille WHERE eleve_famille.code_famille=membre_famille.code_famille   ORDER BY eleve_famille.date_inscription DESC ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['code_famille'] = $enregistrement['code_famille'];
            $liste[$i]['code_beneficiaire'] = $enregistrement['code_eleve'];
            $liste[$i]['nom_beneficiaire'] = html_entity_decode($enregistrement['nom_eleve']);
            $liste[$i]['date_inscription'] = html_entity_decode($enregistrement['date_inscription']);
            $liste[$i]['nom_famille'] = html_entity_decode($enregistrement['nom_famille']);            
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}


?>
