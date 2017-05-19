<?php

require 'modele.php';


function list_alerte_date_premier_cours($code_user) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille 
                     FROM  interventions,eleve_intervenant,eleve_famille,membre_famille 
                     WHERE interventions.reference=eleve_intervenant.reference
					 AND   eleve_intervenant.code_eleve=eleve_famille.code_eleve  
					 AND   eleve_famille.code_famille=membre_famille.code_famille                   
                     AND   eleve_intervenant.statut='attente' 
                     AND   eleve_intervenant.code_intervenant=:param 
                     AND   interventions.exigeance_date_cours='1' 
                     AND   interventions.date_premier_cours=NULL ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_user;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $infos [$i] ['reference_mission'] = $enregistrement ['reference'];
            $infos [$i] ['identite_famille'] = html_entity_decode($enregistrement ['nom_famille']) . "." . html_entity_decode($enregistrement ['prenom_famille']);
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function list_alerte_bilan_premier_cours($code_user) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille
                     FROM   interventions,eleve_intervenant,eleve_famille,membre_famille
                     WHERE  interventions.reference=eleve_intervenant.reference
                     AND    eleve_intervenant.code_eleve=eleve_famille.code_eleve  
					 AND    eleve_famille.code_famille=membre_famille.code_famille                   
                     AND    eleve_intervenant.statut='attente'
                     AND    eleve_intervenant.code_intervenant='" . $code_user . "'
                     AND    interventions.exigeance_bilan_cours='1'
                     AND    NOT EXISTS ( SELECT id_bilan    FROM  bilan_premier_cours  WHERE bilan_premier_cours.reference=interventions.reference  ) ";
        $select = $cxn->query($sql);
        $i = 0;
        while ($enregistrement = $select->fetch()) {
            $infos [$i] ['reference_mission'] = $enregistrement ['reference'];
            $infos [$i] ['identite_famille'] = html_entity_decode($enregistrement ['nom_famille']) . "." . html_entity_decode($enregistrement ['prenom_famille']);
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function list_alerte_bilan_trimestrielle($code_user) {
    global $cxn;
    $infos = array();
    /*
     * try {
     * $sql = " SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille
     * FROM interventions,eleve_intervenant,membre_famille
     * WHERE interventions.reference=eleve_intervenant.reference
     * AND interventions.code_famille=membre_famille.code_famille
     * AND interventions.etat='traitement'
     * AND eleve_intervenant.code_intervenant=:param
     * AND interventions.exigeance_bilan_trims='1' ";
     * $resultat = $cxn->prepare ( $sql );
     * $resultat->bindParam ( ':param', $param );
     * $param = $code_user;
     * $resultat->execute ();
     * $i = 0;
     * while ( $enregistrement = $resultat->fetch () ) {
     * $infos [$i] ['reference_mission'] = $enregistrement ['reference'];
     * $infos [$i] ['identite_famille'] = html_entity_decode($enregistrement['nom_famille']) . "." . html_entity_decode($enregistrement['prenom_famille']);
     * $i ++;
     * }
     * } catch ( Exception $e ) {
     * echo "Une erreur est survenue lors de la récupération des données";
     * }
     */
    return $infos;
}

?>
