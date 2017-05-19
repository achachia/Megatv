<?php

//modele
function liste_chaines_TV() {
    global $cxn;
    $liste = array();
    try {
        
        $sql = " SELECT id AS id_chaine,nom AS nom_chaine FROM ChainesTv ";      
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['id_chaine'] = $enregistrement['id_chaine'];
//            $liste[$i]['date_upload'] = $enregistrement['date_upload'];
//            $liste[$i]['taille_fichier'] = $enregistrement['taille_fichier'];
//            $liste[$i]['nom_section'] = $enregistrement['nom_section'];
//            $liste[$i]['nom_compte'] = $enregistrement['nom_compte'];
//            $liste[$i]['nom_source'] = $enregistrement['nom_source'];
            $liste[$i]['nom_chaine'] = html_entity_decode($enregistrement['nom_chaine']);           
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}


?>
