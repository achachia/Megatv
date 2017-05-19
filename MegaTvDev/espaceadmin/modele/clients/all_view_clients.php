<?php

//modele
function liste_clients() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  code_client,CONCAT(nom,'.',prenom) AS identite_client FROM ClientsMateriel ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['code_client'] = $enregistrement['code_client'];
            $liste[$i]['identite_client'] = html_entity_decode($enregistrement['identite_client']);            
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}


?>
