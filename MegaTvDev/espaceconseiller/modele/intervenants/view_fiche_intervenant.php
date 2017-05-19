<?php

// modele
function infos_intervenant($code_intervenant) {
    global $cxn;
    $infos = array();
    try {
        $sql  = "  SELECT intervenants.fax,intervenants.n_compte,intervenants.cle_rib,intervenants.guichet AS code_guichet,intervenants.banque AS code_banque,intervenants.numero_sec_sc,intervenants.nationalite,liste_sex.nom_sex,intervenants.civilite,intervenants.nom,intervenants.prenom,CONCAT(intervenants.nom, '.',intervenants.prenom) AS identite_intervenant,intervenants.code_intervenant ";
        $sql .= " ,DATE_FORMAT(intervenants.date_naissance,'%d/%m/%Y') AS date_naissance,DATE_FORMAT(intervenants.Date_adhesion,'%d/%m/%Y') AS date_adhesion ";
        $sql .= " ,intervenants.adresse,intervenants.adresse_suite,intervenants.CP,intervenants.ville,intervenants.pays ";
        $sql .= "  ,intervenants.tel_fixe,intervenants.tel_portable,intervenants.email,intervenants.site_web,liste_statut_intervenant.nom_statut,niveau_diplomes.diplome,niveau_diplomes.niveau_etude   ";
        $sql .= ",intervenants.infos_interne,intervenants.infos_familles";
        $sql .= " FROM intervenants,liste_statut_intervenant,niveau_diplomes,liste_sex ";
        $sql .= " WHERE intervenants.statut=liste_statut_intervenant.id_statut ";
        $sql .= " AND intervenants.diplome=niveau_diplomes.id_liaison ";
        $sql .= " AND intervenants.sex=liste_sex.id_sex ";
        $sql .= " AND code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $code_intervenant);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['code_intervenant'] = $enregistrement ['code_intervenant'];
        $infos ['identite_intervenant'] = html_entity_decode($enregistrement ['identite_intervenant']);
        $infos ['civilite'] = html_entity_decode($enregistrement ['civilite']);
        $infos ['sex'] = html_entity_decode($enregistrement ['nom_sex']);
        $infos ['nom'] = html_entity_decode($enregistrement ['nom']);
        $infos ['prenom'] = html_entity_decode($enregistrement ['prenom']);
        $infos ['nationalite'] = html_entity_decode($enregistrement ['nationalite']);
        $infos ['numero_sec_sc'] = ($enregistrement ['numero_sec_sc'] != NULL) ? html_entity_decode($enregistrement ['numero_sec_sc']) : '-------------------------------';
        $infos ['code_banque'] = ($enregistrement ['code_banque'] != NULL) ? html_entity_decode($enregistrement ['code_banque']) : '-------------------------------';
        $infos ['code_guichet'] = ($enregistrement ['code_guichet'] != NULL) ? html_entity_decode($enregistrement ['code_guichet']) : '-------------------------------';
        $infos ['cle_rib'] = ($enregistrement ['cle_rib'] != NULL) ? html_entity_decode($enregistrement ['cle_rib']) : '-------------------------------';
        $infos ['n_compte'] = ($enregistrement ['n_compte'] != NULL) ? html_entity_decode($enregistrement ['n_compte']) : '-------------------------------';
        $infos ['date_naissance'] = ($enregistrement ['date_naissance'] != NULL) ? html_entity_decode($enregistrement ['date_naissance']) : '-------------------------------';
        $infos ['date_adhesion'] = html_entity_decode($enregistrement ['date_adhesion']);
        $infos ['adresse'] = ($enregistrement ['adresse'] != NULL) ? html_entity_decode($enregistrement ['adresse']) : '-------------------------------';
        $infos ['adresse_suite'] = ($enregistrement ['adresse_suite'] != NULL) ? html_entity_decode($enregistrement ['adresse_suite']) : NULL;
        $infos ['code_postale'] = html_entity_decode($enregistrement ['CP']);
        $infos ['ville'] = ($enregistrement ['ville'] != NULL) ? html_entity_decode($enregistrement ['ville']) : '-------------------------------';
        $infos ['pays'] = ($enregistrement ['pays'] != NULL) ? html_entity_decode($enregistrement ['pays']) : '-------------------------------';
        $infos['email'] = ($enregistrement['email'] != NULL) ? html_entity_decode($enregistrement['email']) : '-------------------------------';
        $infos['tel_portable'] = ($enregistrement['tel_portable'] != NULL) ? html_entity_decode($enregistrement['tel_portable']) : '-------------------------------';
        $infos['fax'] = ($enregistrement['fax'] != NULL) ? html_entity_decode($enregistrement['fax']) : '-------------------------------';
        $infos['tel_fixe'] = ($enregistrement['tel_fixe'] != NULL) ? html_entity_decode($enregistrement['tel_fixe']) : '-------------------------------';
        $infos['site_web'] = ($enregistrement['site_web'] != NULL) ? html_entity_decode($enregistrement['site_web']) : '-------------------------------';
        $infos['infos_interne'] = ($enregistrement['infos_interne'] != NULL) ? html_entity_decode($enregistrement['infos_interne']) : '-------------------------------';
        $infos['infos_famille'] = ($enregistrement['infos_familles'] != NULL) ? html_entity_decode($enregistrement['infos_familles']) : '-------------------------------';
        $infos['niveau_etude'] = ($enregistrement['niveau_etude'] != NULL) ? html_entity_decode($enregistrement['niveau_etude']) : '-------------------------------';
        $infos['diplome'] = ($enregistrement['diplome'] != NULL) ? html_entity_decode($enregistrement['diplome']) : '-------------------------------';
        $infos['statut_peda'] = ($enregistrement['nom_statut'] != NULL) ? html_entity_decode($enregistrement['nom_statut']) : '-------------------------------';
        try {
            $sql = "SELECT * FROM dispo_hebdo_intervenant WHERE code_intervenant=:param ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param', $code_intervenant);
            $resultat->execute();
            $j = 0;
            while ($enregistrement = $resultat->fetch()) {
                $periode = $enregistrement ['periode'];
                $infos ['diponibilite'] [$periode] ['lundi'] = $enregistrement ['lundi'];
                $infos ['diponibilite'] [$periode] ['mardi'] = $enregistrement ['mardi'];
                $infos ['diponibilite'] [$periode] ['mercredi'] = $enregistrement ['mercredi'];
                $infos ['diponibilite'] [$periode] ['jeudi'] = $enregistrement ['jeudi'];
                $infos ['diponibilite'] [$periode] ['vendredi'] = $enregistrement ['vendredi'];
                $infos ['diponibilite'] [$periode] ['samedi'] = $enregistrement ['samedi'];
                $infos ['diponibilite'] [$periode] ['dimanche'] = $enregistrement ['dimanche'];
                $j ++;
            }
        } catch (Exception $ex) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function liste_matiere_par_interv($code_intervenant) {
    global $cxn;
    $liste = array();
    try {       
        $sql = "SELECT DISTINCT (intervenant_matiere.matiere) AS id_matiere, liste_matiere.nom AS nom_matiere
                FROM intervenant_matiere,liste_matiere
                WHERE intervenant_matiere.matiere = liste_matiere.id
                AND intervenant_matiere.code_intervenant = :code_intervenant ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':code_intervenant', $code_intervenant);
        $resultat->execute();
        while ($enregistrement = $resultat->fetch()) {
            $key = $enregistrement ['id_matiere'];           
            $liste [$key] = $enregistrement ['nom_matiere'];
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function liste_niveau_par_matiere($code_matiere, $code_intervenant) {
    global $cxn;
    $liste = array();
    try {        
        $sql = "SELECT DISTINCT (liste_organisme_niveau.niveau) AS nom_niveau,liste_niveau_scolaire.nom AS organisme_scolaire
                FROM intervenant_matiere,liste_organisme_niveau,liste_niveau_scolaire
                WHERE intervenant_matiere.niveau = liste_organisme_niveau.id_liste
                AND liste_organisme_niveau.organisme=liste_niveau_scolaire.id
                AND intervenant_matiere.code_intervenant = :code_intervenant 
                AND intervenant_matiere.matiere = :code_matiere ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':code_intervenant', $code_intervenant);
        $resultat->bindParam(':code_matiere', $code_matiere);
        $resultat->execute();
        while ($enregistrement = $resultat->fetch()) {
            $liste [] = $enregistrement ['nom_niveau'].'[ '.$enregistrement ['organisme_scolaire'].']';
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function liste_niveau_matiere_par_intervenant($code_intervenant) {
    global $cxn;
    $liste = array();
    $liste_matiere = liste_matiere_par_interv($code_intervenant);      
    foreach ($liste_matiere as $key => $value) {
        $liste_niveau = liste_niveau_par_matiere($key, $code_intervenant);
        $i=0;
        foreach ($liste_niveau as $niveau) {
            $liste[$value][$i] = $niveau;
             $i++; 
        }       
    }
   // var_dump($liste);
    return $liste;
}

?>