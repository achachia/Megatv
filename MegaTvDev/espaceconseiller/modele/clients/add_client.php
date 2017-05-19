<?php

// modele
function liste_conseiller() {
	global $cxn;
	$liste = array ();
	try {
		// requete prepare
		$sql = " SELECT  conseiller_peda.code_conseiller AS code_conseiller,conseiller_peda.nom AS nom_conseiller,conseiller_peda.prenom AS prenom_conseiller FROM conseiller_peda   ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['code_conseiller'] = $enregistrement ['code_conseiller'];
			$liste [$i] ['identite_conseiller'] = html_entity_decode ( $enregistrement ['nom_conseiller'] ) . "." . html_entity_decode ( $enregistrement ['prenom_conseiller'] );
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_clients() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT membre_famille.code_famille AS code_client, membre_famille.nom AS nom_client, membre_famille.prenom AS prenom_client ";
		$sql .= "  FROM membre_famille";
		$sql .= "  UNION ";
		$sql .= "  SELECT intervenants.code_intervenant AS code_client, intervenants.nom AS nom_client, intervenants.prenom AS prenom_client ";
		$sql .= " FROM intervenants ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['code_parrain'] = $enregistrement ['code_client'];
			$liste [$i] ['identite_parrain'] = html_entity_decode ( $enregistrement ['nom_client'] ) . "." . html_entity_decode ( $enregistrement ['prenom_client'] );
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}

?>
