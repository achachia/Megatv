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
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_zone() {
	global $cxn;
	$liste = array ();
	try {
		// requete prepare
		$sql = " SELECT  id_intercommunalite,nom FROM  liste_intercommunalités ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$nom_intercommunalite = $enregistrement ['nom'];
			$id_intercommunalite = $enregistrement ['id_intercommunalite'];
			$sql1 = " SELECT nom AS nom_commune,code_postale  FROM liste_commune WHERE id_intercommunalite='" . $id_intercommunalite . "' ";
			$resultat1 = $cxn->query ( $sql1 );
			while ( $enregistrement1 = $resultat1->fetch () ) {
				$liste [$nom_intercommunalite] ['code_postale'] = $enregistrement1 ['code_postale'];
				$liste [$nom_intercommunalite] ['nom_commune'] = $enregistrement1 ['nom_commune'];
			}
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_niveau() {
	global $cxn;
	$liste = array ();
	try {
		// requete prepare
		$sql = " SELECT   id_liste,organisme,niveau FROM  liste_organisme_niveau ORDER BY ordre_affichage ASC ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id_liste'];
			$value = $enregistrement ['niveau'] . "[" . $enregistrement ['organisme'] . "]";
			$liste [$key] = $value;
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_matiere() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT  id,nom FROM  liste_matiere ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id'];
			$value = $enregistrement ['nom'];
			$liste [$key] = $value;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_sex() {
	global $cxn;
	$liste = array ();
	try {
		// requete prepare
		$sql = " SELECT   id_sex,nom_sex  FROM  liste_sex  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id_sex'];
			$value = $enregistrement ['nom_sex'];
			$liste [$key] = $value;
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_statut() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT   id_statut,nom_statut  FROM  liste_statut_intervenant  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id_statut'];
			$value = $enregistrement ['nom_statut'];
			$liste [$key] = $value;
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}

?>
