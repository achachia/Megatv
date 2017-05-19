<?php

function model_coupon() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  id_model,nom  FROM model_coupon  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_model'] = $enregistrement['id_model'];
            $liste[$i]['nom'] = html_entity_decode($enregistrement['nom']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function liste_famille($code_conseiller) {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille,membre_famille.code_famille AS code_famille  FROM membre_famille,famille_conseiller  WHERE membre_famille.code_famille=famille_conseiller.code_famille AND famille_conseiller.code_conseiller=:param  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_conseiller;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_famille'] = $enregistrement['code_famille'];
            $liste[$i]['identite_famille'] = html_entity_decode($enregistrement['nom_famille']) . "." . html_entity_decode($enregistrement['prenom_famille']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function infos_facture($code_facture) {
    global $cxn;
    $infos = array();
    /*     * ************* infos famille ************ */
    try {
        // requete prepare
        $sql =  " SELECT  eleve_famille.code_eleve,CONCAT(eleve_famille.nom,'.',eleve_famille.prenom) AS identite_eleve       ";
        $sql .= ",facture_famille.code_famille,facture_famille.date_facture,facture_famille.date_excution,facture_famille.mode_paiement,facture_famille.id_model,facture_famille.PrixHT AS prix_heure_HT,facture_famille.Qte AS nb_heure";
        $sql .= ",facture_famille.genre_remise,facture_famille.remise,facture_famille.designation,facture_famille.objet_facture,facture_famille.paie_cpt_recp_facture,facture_famille.total_paye ";
        $sql .= " FROM facture_famille,eleve_famille ";
        $sql .= " WHERE  eleve_famille.code_eleve=facture_famille.code_eleve  ";
        $sql .= " AND facture_famille.N_facture=:param";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $code_facture);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['code_famille'] = $enregistrement['code_famille'];
        $infos['code_eleve'] = $enregistrement ['code_eleve'];
        $infos['identite_eleve'] = html_entity_decode($enregistrement ['identite_eleve']);
        $infos['date_facture'] = $enregistrement['date_facture'];
        $infos['date_execution'] = $enregistrement['date_excution'];
        $infos['mode_paiement'] = $enregistrement ['mode_paiement'];
        $infos['id_model'] = $enregistrement ['id_model'];
        $infos['prix_heure_HT'] = $enregistrement ['prix_heure_HT'];
        $infos['Total_HT'] = $enregistrement ['total_paye'];
        $infos['nb_heure'] = $enregistrement ['nb_heure'];
        $infos['application_remise'] = ($enregistrement ['genre_remise'] == NULL) ? '0' : '1';
        $infos['type_remise'] = ($enregistrement ['genre_remise'] == NULL) ? '' : $enregistrement ['genre_remise'];
        $infos['valeur_remise'] = $enregistrement ['remise'];
        $infos['objet_facture'] = html_entity_decode($enregistrement ['objet_facture']);
        $infos['designation_facture'] = html_entity_decode($enregistrement ['designation']);
        if($enregistrement ['paie_cpt_recp_facture']=='1'){
             $infos['chekbox_paiement'] = $enregistrement ['paie_cpt_recp_facture'];
        }       
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    /*     * ****************************************** */






    return $infos;
}

?>
