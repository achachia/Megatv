<?php

//modele
function liste_clients() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  membre_famille.code_famille AS code_client,membre_famille.Date_adhesion AS Date_adhesion,membre_famille.code_famille,membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille,conseiller_peda.nom AS nom_conseiller,conseiller_peda.prenom AS prenom_conseiller FROM membre_famille,famille_conseiller,conseiller_peda WHERE membre_famille.code_famille=famille_conseiller.code_famille AND famille_conseiller.code_conseiller=conseiller_peda.code_conseiller  ORDER BY membre_famille.Date_adhesion DESC ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {            
            $liste[$i]['code_client'] = $enregistrement['code_client'];
            $liste[$i]['nom_famille'] = html_entity_decode($enregistrement['nom_famille']);
            $liste[$i]['prenom_famille'] = html_entity_decode($enregistrement['prenom_famille']);
            $liste[$i]['Date_adhesion'] = $enregistrement['Date_adhesion'];
            $liste[$i]['conseiller_attache'] = html_entity_decode($enregistrement['nom_conseiller']) . "." . html_entity_decode($enregistrement['prenom_conseiller']);
            $i++;
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}


?>
