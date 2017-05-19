<?php

//modele
function liste_factures() {
    global $cxn;
    $liste = array();
    try {    
        $sql = " SELECT  facture_famille.N_facture,facture_famille.date_facture,facture_famille.total_paye,facture_famille.etat_facture,facture_famille.code_famille,CONCAT(membre_famille.nom,'.',membre_famille.prenom) AS identite_famille FROM  facture_famille,membre_famille  WHERE facture_famille.code_famille=membre_famille.code_famille  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['N_facture'] = $enregistrement['N_facture'];
            $liste[$i]['date_facture'] = $enregistrement['date_facture'];
            $liste[$i]['identite_famille']=html_entity_decode($enregistrement['identite_famille']);
            $liste[$i]['code_famille']=$enregistrement['code_famille']; 
            $liste[$i]['total_paye']=$enregistrement['total_paye']; 
            $liste[$i]['etat_facture']=$enregistrement['etat_facture'];
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}


?>