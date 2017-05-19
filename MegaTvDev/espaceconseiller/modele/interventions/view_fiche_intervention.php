<?php
// modele
function infos_intervention($reference_intervention) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "   SELECT DATE_FORMAT(interventions.date_creation,'%Y-%m-%d' ) AS date_creation_intervention,interventions.reference,interventions.type_intervention,liste_matiere.nom AS matiere_choisi,interventions.date_debut_mission,interventions.date_fin_mission,interventions.frequence,interventions.duree,interventions.exigeance_date_cours,interventions.exigeance_bilan_cours,interventions.date_premier_cours,interventions.heure_premier_cours,interventions.observation ";
		$sql .= "  FROM interventions,eleve_intervenant,liste_matiere ";
		$sql .= "  WHERE interventions.reference=eleve_intervenant.reference ";
		$sql .= "  AND  eleve_intervenant.matiere=liste_matiere.id ";
		$sql .= "  AND  interventions.reference='" . $reference_intervention . "' ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['date_creation_intervention'] = $enregistrement ['date_creation_intervention'];
		$infos ['reference'] = $enregistrement ['reference'];
		$infos ['type_intervention'] = $enregistrement ['type_intervention'];
		$infos ['matiere'] = $enregistrement ['matiere_choisi'];
		$infos ['frequence'] = $enregistrement ['frequence'];
		$infos ['duree'] = $enregistrement ['duree'];
		$infos ['date_debut_mission'] = $enregistrement ['date_debut_mission'];
		$infos ['exigeance_date_cours'] = ($enregistrement ['exigeance_date_cours'] == '1') ? 'OUI' : 'NON';
		$infos ['exigeance_bilan_cours'] = ($enregistrement ['exigeance_bilan_cours'] == '1') ? 'OUI' : 'NON';
		if ($enregistrement ['type_intervention'] == 'ponctuelle') {
			$infos ['date_fin_mission'] = $enregistrement ['date_fin_mission'];
		}
		if ($enregistrement ['exigeance_date_cours'] == '1') {
			$infos ['date_heure_premier_cours'] = ($enregistrement ['date_premier_cours'] != NULL && $enregistrement ['heure_premier_cours'] != NULL) ? $enregistrement ['date_premier_cours'] . "/" . $enregistrement ['heure_premier_cours'] : 'INDISPONIBLE';
		}
		if ($enregistrement ['exigeance_bilan_cours'] == '1') {
			$infos ['date_heure_premier_cours'] = ($enregistrement ['date_premier_cours'] != NULL && $enregistrement ['heure_premier_cours'] != NULL) ? $enregistrement ['date_premier_cours'] . "/" . $infos_intervention ['heure_premier_cours'] : 'INDISPONIBLE';
		}
		$infos ['observation'] = $enregistrement ['observation'];
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	// ////// chercher id de bilan de premier cours //////////////////
	if ($enregistrement ['exigeance_bilan_cours'] == '1') {
		try {
			$select = $cxn->query ( " SELECT id_bilan  FROM bilan_premier_cours  WHERE  reference='" . $reference_intervention . "'  " );
			$nb = $select->rowCount ();
			if ($nb > 0) {
				$enregistrement = $select->fetch ();
				$infos ['id_bilan_premier_cours'] = $enregistrement ['id_bilan'];
			} else {
				$infos ['id_bilan_premier_cours'] = NULL;
			}
		} catch ( Exception $e ) {
			$etat = FALSE;
			echo "Une erreur est survenue lors de la récupération des données";
		}
	}
	
	// /////////////////////////////////////////////////////////////////////////////
	return $infos;
}
function infos_famille($reference_intervention) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "  SELECT membre_famille.code_famille,membre_famille.nom,membre_famille.prenom,membre_famille.civilite,membre_famille.email,membre_famille.adresse,membre_famille.code_postale,membre_famille.ville,membre_famille.telephone_fixe,membre_famille.telephone_portable,membre_famille.telephone_travail ";
		$sql .= " FROM eleve_intervenant,membre_famille,eleve_famille";
		$sql .= " WHERE eleve_intervenant.code_eleve=eleve_famille.code_eleve  ";
		$sql .= " AND eleve_famille.code_famille=membre_famille.code_famille ";
		$sql .= " AND eleve_intervenant.reference='" . $reference_intervention . "' ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$infos ['identite_famille'] = html_entity_decode ( $enregistrement ['nom'] ) . "." . html_entity_decode ( $enregistrement ['prenom'] );
			$infos ['civilite'] = $enregistrement ['civilite'];
			$infos ['code_client'] = $enregistrement ['code_famille'];
			$infos ['adresse'] = $enregistrement ['adresse'];
			$infos ['code_postale'] = $enregistrement ['code_postale'];
			$infos ['ville'] = $enregistrement ['ville'];
			$infos ['tel_fixe'] = $enregistrement ['telephone_fixe'];
			$infos ['tel_portable'] = $enregistrement ['telephone_portable'];
			$infos ['tel_travail'] = $enregistrement ['telephone_travail'];
			$infos ['email'] = $enregistrement ['email'];
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}
function fiche_eleve($code_eleve) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "SELECT eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve,eleve_famille.tel_portable  AS tel_portable,liste_niveau_option.nom_option AS niveau_peda";
		$sql .= " FROM eleve_famille,liste_niveau_option WHERE ";
		$sql .= "  eleve_famille.niveau_peda=liste_niveau_option.id_option ";
		$sql .= "AND  eleve_famille.code_eleve=:param1 ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param1', $param1 );
		$param1 = $code_eleve;
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['nom_eleve'] = html_entity_decode ( $enregistrement ['nom_eleve'] );
		$infos ['prenom_eleve'] = html_entity_decode ( $enregistrement ['prenom_eleve'] );
		$infos ['tel_eleve'] = ($enregistrement ['tel_portable'] != '') ? $enregistrement ['tel_portable'] : '-----';
		$infos ['niveau_peda'] = $enregistrement ['niveau_peda'];
		$sql1 = "SELECT * FROM dispo_hebdo_eleve WHERE code_eleve=:param2 ";
		$resultat1 = $cxn->prepare ( $sql1 );
		$resultat1->bindParam ( ':param2', $param2 );
		$param2 = $code_eleve;
		$resultat1->execute ();
		$j = 0;
		while ( $enregistrement1 = $resultat1->fetch () ) {
			$periode = $enregistrement1 ['periode'];
			$infos ['diponibilite'] [$periode] ['lundi'] = $enregistrement1 ['lundi'];
			$infos ['diponibilite'] [$periode] ['mardi'] = $enregistrement1 ['mardi'];
			$infos ['diponibilite'] [$periode] ['mercredi'] = $enregistrement1 ['mercredi'];
			$infos ['diponibilite'] [$periode] ['jeudi'] = $enregistrement1 ['jeudi'];
			$infos ['diponibilite'] [$periode] ['vendredi'] = $enregistrement1 ['vendredi'];
			$infos ['diponibilite'] [$periode] ['samedi'] = $enregistrement1 ['samedi'];
			$infos ['diponibilite'] [$periode] ['dimanche'] = $enregistrement1 ['dimanche'];
			$j ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	
	return $infos;
}
function infos_eleve($reference_intervention) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "  SELECT eleve_intervenant.code_eleve ";
		$sql .= " FROM eleve_intervenant ";
		$sql .= " WHERE  eleve_intervenant.reference='" . $reference_intervention . "' ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos = fiche_eleve ( $enregistrement ['code_eleve'] );
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}
function infos_intervenant($reference_intervention) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "  SELECT nom,prenom,intervenants.code_intervenant,email,civilite,tel_fixe,tel_portable,adresse,CP,ville ";
		$sql .= " FROM   eleve_intervenant,intervenants ";
		$sql .= " WHERE  eleve_intervenant.code_intervenant=intervenants.code_intervenant   ";
		$sql .= " AND eleve_intervenant.reference='" . $reference_intervention . "' ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$infos ['identite_intervenant'] = html_entity_decode ( $enregistrement ['nom'] ) . "." . html_entity_decode ( $enregistrement ['prenom'] );
			$infos ['civilite'] = $enregistrement ['civilite'];
			$infos ['code_intervenant'] = $enregistrement ['code_intervenant'];
			$infos ['adresse'] = $enregistrement ['adresse'];
			$infos ['code_postale'] = $enregistrement ['CP'];
			$infos ['ville'] = $enregistrement ['ville'];
			$infos ['tel_fixe'] = $enregistrement ['tel_fixe'];
			$infos ['tel_portable'] = $enregistrement ['tel_portable'];
			$infos ['email'] = $enregistrement ['email'];
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}
function liste_etat($refrence_intervention) {
	global $cxn;
	try {
		$tab_valeurs_possible = array ();
		$sql = " SELECT statut,code_intervenant  FROM eleve_intervenant  WHERE reference=:param ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $param );
		$param = $refrence_intervention;
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$etat = $enregistrement ['statut'];
		$code_intervenant = $enregistrement ['code_intervenant'];
		if ($etat == 'attente' && $code_intervenant == NULL) {
			$tab_valeurs_possible = [ 
					'annule' 
			];
		} elseif ($etat == 'attente' && $code_intervenant != NULL) {
			$tab_valeurs_possible = [ 
					'confirme',
					'annule' 
			];
		} elseif ($etat == 'confirme') {
			$tab_valeurs_possible = [ 
					'termine',
					'annule' 
			];
		} else {
			$tab_valeurs_possible = array ();
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	
	return $tab_valeurs_possible;
}

?>