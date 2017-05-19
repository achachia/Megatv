<?php
function liste_fournisseurs() {
    global $cxn;
    $liste = array();
    try {        
        $sql = " SELECT code_fournisseur,nom_fournisseur FROM ListeFournisseursMateriel  ";
        $resultat = $cxn->prepare($sql); 
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_commande'] = $enregistrement['code_commande'];
            $liste[$i]['nom_fournisseur'] = html_entity_decode($enregistrement['nom_fournisseur']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function liste_modes_envoi() {
    global $cxn;
    $liste = array();
    try {        
        $sql = " SELECT code_mode,nom_mode FROM ModesEnvoiCommandes ";
        $resultat = $cxn->prepare($sql); 
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_envoi'] = $enregistrement['code_mode'];
            $liste[$i]['nom_envoi'] = html_entity_decode($enregistrement['nom_mode']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}



?>
