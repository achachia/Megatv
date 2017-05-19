<?php

//modele
function liste_commandes() {
    global $cxn;
    $liste = array();
    try {    
        $sql = " SELECT CommandesFournisseursIptv.date_achat,CommandesFournisseursIptv.code_commande,CommandesFournisseursIptv.quantite,ListeFournisseurAbo.nom AS nom_fournisseur,InfosAbonnements.ref AS type_abo

                 FROM  CommandesFournisseursIptv,ListeFournisseurAbo,InfosAbonnements

                 WHERE CommandesFournisseursIptv.code_fournisseur=ListeFournisseurAbo.code_fournisseur

                 AND CommandesFournisseursIptv.code_abo=InfosAbonnements.code_abo  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['date_commande'] = $enregistrement['code_commande'];
            $liste[$i]['code_commande'] = $enregistrement['date_achat'];
            $liste[$i]['fournisseur']=html_entity_decode($enregistrement['nom_fournisseur']);        
            $liste[$i]['type_abo']=$enregistrement['type_abo']; 
            $liste[$i]['quantite']=$enregistrement['quantite']; 
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}


?>