<?php

// modele
function infos_beneficiaire($code_beneficiaire) {
    global $cxn;
    $infos = array();
    try {     
        $sql  =  " SELECT  eleve_famille.code_famille,eleve_famille.code_eleve,eleve_famille.tel_portable,eleve_famille.email,eleve_famille.date_inscription,CONCAT(eleve_famille.nom, '.',eleve_famille.prenom) AS identite_eleve,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve  ";
        $sql .= " ,CONCAT(membre_famille.nom, '.',membre_famille.prenom) AS nom_famille,eleve_famille.date_naissance,eleve_famille.email,eleve_famille.tel_portable,liste_niveau_option.nom_option,liste_niveau_scolaire.nom AS niveau_peda ";
        $sql .= " ,eleve_famille.adresse,eleve_famille.adresse_suite,eleve_famille.code_postale,eleve_famille.ville,eleve_famille.pays";
        $sql .= " ,eleve_famille.tel_fixe,eleve_famille.site_web,eleve_famille.infos_interne,eleve_famille.infos_intervenant,CONCAT(conseiller_peda.nom, '.',conseiller_peda.prenom) AS identite_conseiller,eleve_famille.date_naissance ";
        $sql .= " FROM eleve_famille,membre_famille,liste_niveau_scolaire,liste_niveau_option,liste_organisme_niveau,famille_conseiller,conseiller_peda";
        $sql .= " WHERE eleve_famille.code_famille=membre_famille.code_famille";
        $sql .= " AND membre_famille.code_famille=famille_conseiller.code_famille ";
        $sql .= " AND conseiller_peda.code_conseiller=famille_conseiller.code_conseiller ";
        $sql .= " AND liste_niveau_option.id_option=eleve_famille.niveau_peda ";
        $sql .= " AND liste_niveau_option.id_organisme=liste_organisme_niveau.id_liste";
        $sql .= " AND liste_organisme_niveau.organisme=liste_niveau_scolaire.id";
        $sql .= " AND eleve_famille.code_eleve=:param ";
       //echo $sql;
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $code_beneficiaire);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['code_famille'] = $enregistrement['code_famille'];
        $infos['code_beneficiaire'] = $enregistrement['code_eleve'];
        $infos['identite_beneficiaire'] = html_entity_decode($enregistrement['identite_eleve']);
        $infos['nom_beneficiaire'] = html_entity_decode($enregistrement['nom_eleve']);
        $infos['prenom_beneficiaire'] = html_entity_decode($enregistrement['prenom_eleve']);
        $infos['date_naissance'] = ($enregistrement['date_naissance']!=NULL)? html_entity_decode($enregistrement['date_naissance']) : '-------------------------------';
        $infos['date_inscription'] = html_entity_decode($enregistrement['date_inscription']);
        $infos['email'] = ($enregistrement['email']!=NULL)? html_entity_decode($enregistrement['email']) : '-------------------------------';
        $infos['tel_portable'] = ($enregistrement['tel_portable']!=NULL)? html_entity_decode($enregistrement['tel_portable']) : '-------------------------------';
        $infos['tel_fixe'] = ($enregistrement['tel_fixe']!=NULL)? html_entity_decode($enregistrement['tel_fixe']) : '-------------------------------';
        $infos['site_web'] = ($enregistrement['site_web']!=NULL)? html_entity_decode($enregistrement['site_web']) : '-------------------------------';
        $infos['nom_famille'] = html_entity_decode($enregistrement['nom_famille']);
        $infos['identite_conseiller'] = html_entity_decode($enregistrement['identite_conseiller']);
        $infos['option_peda_beneficiaire'] = html_entity_decode($enregistrement['nom_option']);
        $infos['niveau_beneficiaire'] = html_entity_decode($enregistrement['niveau_peda']);      
        $infos['adresse_benef'] = ($enregistrement['adresse']!=NULL)? html_entity_decode($enregistrement['adresse']) : '-------------------------------';
        $infos['adresse_suite_benef'] = ($enregistrement['adresse_suite']!=NULL)? html_entity_decode($enregistrement['adresse_suite']) : NULL;
        $infos['code_post_benef'] = ($enregistrement['code_postale']!=NULL)? html_entity_decode($enregistrement['code_postale']) : '-------------------------------';
        $infos['ville_benef'] = ($enregistrement['ville']!=NULL)? html_entity_decode($enregistrement['ville']) : '-------------------------------';
        $infos['pays_benef'] = ($enregistrement['pays']!=NULL)? html_entity_decode($enregistrement['pays']) : '-------------------------------';
        $infos['infos_interne'] = ($enregistrement['infos_interne']!=NULL)? html_entity_decode($enregistrement['infos_interne']) : '-------------------------------';
        $infos['infos_intervenant'] = ($enregistrement['infos_intervenant']!=NULL)? html_entity_decode($enregistrement['infos_intervenant']) : '-------------------------------';
        try {
                $sql = "SELECT * FROM dispo_hebdo_eleve WHERE code_eleve=:param ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $code_beneficiaire );		
		$resultat->execute ();
		$j = 0;
		while ( $enregistrement = $resultat->fetch () ) {
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

?>