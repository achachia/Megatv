<?php
// SELECT interventions.reference,DATE_FORMAT(interventions.date_creation,'%Y-%m-%d') AS date_creation,DATEDIFF( (DATE(now())), (DATE(DATE_FORMAT(interventions.date_creation,'%Y-%m-%d'))) ) AS delai_attente,CONCAT(eleve_famille.nom, '.', eleve_famille.prenom) AS identite_eleve,CONCAT(membre_famille.nom, '.', membre_famille.prenom) AS identite_famille
// FROM eleve_intervenant
// left JOIN interventions ON eleve_intervenant.reference=interventions.reference
// left JOIN eleve_famille ON eleve_intervenant.code_eleve = eleve_famille.code_eleve
// left JOIN membre_famille ON eleve_famille.code_famille = membre_famille.code_famille
// WHERE eleve_intervenant.statut='attente'
// AND eleve_intervenant.code_intervenant is NULL
// ORDER BY interventions.date_creation DESC
// modele
function liste_interventions_ss_intervenant($etat) {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT interventions.reference,DATE_FORMAT(interventions.date_creation,'%Y-%m-%d') AS date_creation,DATEDIFF( (DATE(now())), (DATE(DATE_FORMAT(interventions.date_creation,'%Y-%m-%d'))) ) AS delai_attente,CONCAT(eleve_famille.nom, '.', eleve_famille.prenom) AS identite_eleve,CONCAT(membre_famille.nom, '.', membre_famille.prenom) AS identite_famille";
		$sql .= " FROM eleve_intervenant ";
		$sql .= " left JOIN interventions ON eleve_intervenant.reference = interventions.reference ";
		$sql .= " left JOIN eleve_famille ON eleve_intervenant.code_eleve = eleve_famille.code_eleve ";
		$sql .= " left JOIN membre_famille ON eleve_famille.code_famille = membre_famille.code_famille ";
		$sql .= " WHERE eleve_intervenant.statut='" . $etat . "' AND eleve_intervenant.code_intervenant is NULL ORDER BY interventions.date_creation DESC";	
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['reference_intervention'] = $enregistrement ['reference'];
			$liste [$i] ['identite_famille'] = html_entity_decode ( $enregistrement ['identite_famille'] );
			$liste [$i] ['identite_eleve'] = html_entity_decode ( $enregistrement ['identite_eleve'] );
			$liste [$i] ['date_creation'] = $enregistrement ['date_creation'];
			$liste [$i] ['delai_attente'] = $enregistrement ['delai_attente'].' Jours';
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données1";
	}
	return $liste;
}
function liste_interventions_annule_sans_choix_intervenant() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT interventions.reference,DATE_FORMAT(interventions.date_creation,'%Y-%m-%d') AS date_creation,DATEDIFF( (DATE(now())), (DATE(DATE_FORMAT(interventions.date_creation,'%Y-%m-%d'))) ) AS delai_attente,CONCAT(eleve_famille.nom, '.', eleve_famille.prenom) AS identite_eleve,CONCAT(membre_famille.nom, '.', membre_famille.prenom) AS identite_famille";
		$sql .= " FROM eleve_intervenant ";
		$sql .= " left JOIN interventions ON eleve_intervenant.reference = interventions.reference ";
		$sql .= " left JOIN eleve_famille ON eleve_intervenant.code_eleve = eleve_famille.code_eleve ";
		$sql .= " left JOIN membre_famille ON eleve_famille.code_famille = membre_famille.code_famille ";
		$sql .= " WHERE eleve_intervenant.statut='annule' AND eleve_intervenant.code_intervenant is NULL ORDER BY interventions.date_creation DESC";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['reference_intervention'] = $enregistrement ['reference'];
			$liste [$i] ['identite_famille'] = html_entity_decode ( $enregistrement ['identite_famille'] );
			$liste [$i] ['identite_eleve'] = html_entity_decode ( $enregistrement ['identite_eleve'] );
			$liste [$i] ['date_creation'] = $enregistrement ['date_creation'];
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données2";
	}
	return $liste;
}
function liste_interventions_annule_avec_choix_intervenant() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT interventions.reference,DATE_FORMAT(interventions.date_creation,'%Y-%m-%d') AS date_creation,DATEDIFF( (DATE(now())), (DATE(DATE_FORMAT(interventions.date_creation,'%Y-%m-%d'))) ) AS delai_attente,CONCAT(eleve_famille.nom, '.', eleve_famille.prenom) AS identite_eleve,CONCAT(membre_famille.nom, '.', membre_famille.prenom) AS identite_famille";
		$sql .= " FROM eleve_intervenant ";
		$sql .= " left JOIN interventions ON eleve_intervenant.reference = interventions.reference ";
		$sql .= " left JOIN eleve_famille ON eleve_intervenant.code_eleve = eleve_famille.code_eleve ";
		$sql .= " left JOIN membre_famille ON eleve_famille.code_famille = membre_famille.code_famille ";
		$sql .= " WHERE eleve_intervenant.statut='annule' AND eleve_intervenant.code_intervenant is NOT NULL ORDER BY interventions.date_creation DESC";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['reference_intervention'] = $enregistrement ['reference'];
			$liste [$i] ['identite_famille'] = html_entity_decode ( $enregistrement ['identite_famille'] );
			$liste [$i] ['identite_eleve'] = html_entity_decode ( $enregistrement ['identite_eleve'] );
			$liste [$i] ['date_creation'] = $enregistrement ['date_creation'];
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données3";
	}
	return $liste;
}
function liste_interventions($etat) {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT interventions.reference,DATE_FORMAT(interventions.date_creation,'%Y-%m-%d') AS date_creation,DATEDIFF( (DATE(now())), (DATE(DATE_FORMAT(interventions.date_creation,'%Y-%m-%d'))) ) AS delai_attente,CONCAT(eleve_famille.nom, '.', eleve_famille.prenom) AS identite_eleve,CONCAT(membre_famille.nom, '.', membre_famille.prenom) AS identite_famille";
	
		$sql .= " FROM eleve_intervenant ";
		$sql .= " left JOIN interventions ON eleve_intervenant.reference = interventions.reference ";
		$sql .= " left JOIN eleve_famille ON eleve_intervenant.code_eleve = eleve_famille.code_eleve ";
		$sql .= " left JOIN membre_famille ON eleve_famille.code_famille = membre_famille.code_famille ";
		$sql .= " WHERE eleve_intervenant.statut='" . $etat . "' AND eleve_intervenant.code_intervenant is NOT NULL ORDER BY interventions.date_creation DESC";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['reference_intervention'] = $enregistrement ['reference'];
			$liste [$i] ['identite_famille'] = html_entity_decode ( $enregistrement ['identite_famille'] );
			$liste [$i] ['identite_eleve'] = html_entity_decode ( $enregistrement ['identite_eleve'] );
			$liste [$i] ['date_creation'] = $enregistrement ['date_creation'];
			$liste [$i] ['delai_attente'] = $enregistrement ['delai_attente'].' Jours';
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données4";
	}
	return $liste;
}
?>

