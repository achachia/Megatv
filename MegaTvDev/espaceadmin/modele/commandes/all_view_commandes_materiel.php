<?php

//modele
function liste_commandes() {
    global $cxn;
    $liste = array();
    try {    
        $sql = " SELECT CommandesMateriel.date_commande, CommandesMateriel.code_commande, CommandesMateriel.N_order_fournisseur, CommandesMateriel.etat_commande, ListeFournisseursMateriel.nom_fournisseur
                 FROM CommandesMateriel, ListeFournisseursMateriel
                 WHERE CommandesMateriel.code_fournisseur = ListeFournisseursMateriel.code_fournisseur  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['date_commande'] = $enregistrement['date_commande'];
            $liste[$i]['code_commande'] = $enregistrement['code_commande'];
            $liste[$i]['order_commande']=$enregistrement['N_order_fournisseur'];
            $liste[$i]['etat_reception']=$enregistrement['etat_commande']; 
            $liste[$i]['fournisseur']=$enregistrement['nom_fournisseur'];           
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}


?>