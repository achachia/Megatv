<?php

function infos_facture($id_facture) {
    global $cxn;
    $infos = array();
    try {
        // requete prepare
        $sql = " SELECT TotalTva,MontantTva,TauxTVA,date_facture,N_facture,etat_facture,mode_paiement,objet_facture,total_paye,designation,Qte,PrixHT,genre_remise,remise,total_paye,numero_acompte FROM facture_famille  WHERE   N_facture=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $id_facture;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['date_facture'] = $enregistrement ['date_facture'];
        $infos ['N_facture'] = $enregistrement ['N_facture'];
        $infos ['etat_facture'] = $enregistrement ['etat_facture'];
        $infos ['mode_paiement'] = $enregistrement ['mode_paiement'];
        $infos ['objet_facture'] = $enregistrement ['objet_facture'];
        $infos ['total_paye'] = $enregistrement ['total_paye'];
        $infos ['designation_facture'] = $enregistrement ['designation'];
        $infos ['Qte'] = $enregistrement ['Qte'];
        $infos ['PU_HT'] = $enregistrement ['PrixHT'];
        if ($enregistrement ['genre_remise'] != NULL) {
            $infos ['remise'] = $enregistrement ['remise'];
        } else {
            $infos ['remise'] = 0;
        }
        if ($enregistrement ['TauxTVA'] != NULL) {
            $infos ['TauxTVA'] = $enregistrement ['TauxTVA'];
            $infos ['MontantTva'] = $enregistrement ['MontantTva'];
            $infos ['TotalTva'] = $enregistrement ['TotalTva'];
        }
        if ($enregistrement ['numero_acompte'] != 0) {
            try {
                $sql1 = " SELECT total_acompte,date_acompte FROM acompte WHERE   N_acompte=:param3 ";
                $resultat1 = $cxn->prepare($sql1);
                $resultat1->bindParam(':param3', $param3);
                $param3 = $enregistrement ['numero_acompte'];
                $resultat1->execute();
                $enregistrement1 = $resultat1->fetch();
                $infos ['numero_acompte'] = $enregistrement ['numero_acompte'];
                $infos ['total_acompte'] = $enregistrement1 ['total_acompte'];
                $infos ['date_acompte'] = $enregistrement1 ['date_acompte'];
            } catch (Exception $e) {
                echo "Une erreur est survenue lors de la récupération des données00";
            }
        } else {
            $infos ['total_acompte'] = 0;
        }
        $infos ['total_restant'] = $infos ['total_paye'] - $infos ['total_acompte'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données01";
    }
    return $infos;
}

function infos_famille($code_famille) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT statut,civilite,nom,prenom,telephone_fixe,telephone_portable,telephone_travail,email,fax,adresse,adresse_suite,site_web,code_postale,ville,pays FROM membre_famille WHERE code_famille=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_famille;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['civilité'] = $enregistrement ['civilite'];
        $infos ['nom'] = $enregistrement ['nom'];
        $infos ['prenom'] = $enregistrement ['prenom'];
        $infos ['adresse'] = $enregistrement ['adresse'];
        $infos ['adresse_suite'] = $enregistrement ['adresse_suite'];
        $infos ['code_postale'] = $enregistrement ['code_postale'];
        $infos ['ville'] = $enregistrement ['ville'];
        $infos ['pays'] = $enregistrement ['pays'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function infos_gerant() {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT nom,prenom,adresse,code_postale,ville,pays,email,numero_identification,numero_agrement  FROM agences  WHERE id_agence='1' ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['nom'] = $enregistrement ['nom'];
        $infos ['prenom'] = $enregistrement ['prenom'];
        $infos ['adresse'] = $enregistrement ['adresse'];
        $infos ['code_postale'] = $enregistrement ['code_postale'];
        $infos ['ville'] = $enregistrement ['ville'];
        $infos ['pays'] = $enregistrement ['pays'];
        $infos ['email'] = $enregistrement ['email'];
        $infos ['n_siret'] = $enregistrement ['numero_identification'];
        $infos ['n_agrement'] = $enregistrement ['numero_agrement'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

?>
