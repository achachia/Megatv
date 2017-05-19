<?php

//modele
function liste_intervenants() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT intervenants.Date_adhesion AS Date_adhesion,intervenants.code_intervenant,intervenants.nom AS nom_intervenant,intervenants.prenom AS prenom_intervenant FROM intervenants   ORDER BY intervenants.Date_adhesion DESC ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {          
            $liste[$i]['nom_intervenant'] = html_entity_decode($enregistrement['nom_intervenant']);
            $liste[$i]['prenom_intervenant'] = html_entity_decode($enregistrement['prenom_intervenant']);
            $liste[$i]['Date_adhesion'] = $enregistrement['Date_adhesion'];
            $liste[$i]['code_intervenant'] = $enregistrement['code_intervenant']; 
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

?>
