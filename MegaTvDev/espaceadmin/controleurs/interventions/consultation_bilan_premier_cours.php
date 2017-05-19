<?php
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
ini_set('date.timezone', 'Europe/Paris'); 
// http://www.epershand.net/developpement/mysql-bdd/timestamp-mysql-create-update
$etat = TRUE;
$objet = array ();
$id_bilan = unhtmlentities ( $_POST ['id_bilan'] );

// les controles les saisies du formulaire
if ($id_bilan == '') {
	$objet ['message_erreur'] [] = 'Votre demande est refuse';
	$etat = FALSE;
	$objet ['message_debug'] [] = 'le champ id_bilan ne doit pas etre vide';
}
// / verification le id-bilan dans la table bilan premier cours
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT *  FROM bilan_premier_cours  WHERE  id_bilan='" . $id_bilan . "'  " );
		$nb = $select->rowCount ();
		if ($nb <= 0) {
			$objet ['message_erreur'] [] = 'le bilan que vous demander est introuvable';
			$etat = FALSE;
		}
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}
// //////////////////// identite eleve /////////////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT eleve_famille.nom,eleve_famille.prenom	FROM eleve_famille,bilan_premier_cours,eleve_intervenant	WHERE bilan_premier_cours.reference=eleve_intervenant.reference AND eleve_intervenant.code_eleve=eleve_famille.code_eleve AND bilan_premier_cours.id_bilan='" . $id_bilan . "'   " );
		$enregistrement = $select->fetch ();
		$objet ['bilan'] ['eleve'] = html_entity_decode ( $enregistrement ['nom'] ) . "." . html_entity_decode ( $enregistrement ['prenom'] );
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}
// //////////////////// identite intervenant /////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT intervenants.nom,intervenants.prenom FROM intervenants,bilan_premier_cours WHERE intervenants.code_intervenant=bilan_premier_cours.code_intervenant AND bilan_premier_cours.id_bilan='" . $id_bilan . "'   " );
		$enregistrement = $select->fetch ();
		$objet ['bilan'] ['intervenant'] = html_entity_decode ( $enregistrement ['nom'] ) . "." . html_entity_decode ( $enregistrement ['prenom'] );
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}
// /////////////////////////////////////////////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT rythme_cours,last_note_controle,notions_travaille,points_forts,points_faibles,objectifs_fixe,plan_progression  FROM bilan_premier_cours  WHERE  id_bilan='" . $id_bilan . "'  " );
		$enregistrement = $select->fetch ();
		$objet ['bilan'] ['rythme_cours'] = ($enregistrement ['rythme_cours'] == '0') ? 'Rythme non adapt&eacute;' : 'Rythme adapt&eacute;';
		$objet ['bilan'] ['last_note_controle'] = $enregistrement ['last_note_controle'];
		$objet ['bilan'] ['notions_travaille'] = $enregistrement ['notions_travaille'];
		$objet ['bilan'] ['points_forts'] = $enregistrement ['points_forts'];
		$objet ['bilan'] ['points_faibles'] = $enregistrement ['points_faibles'];
		$objet ['bilan'] ['objectifs_fixe'] = $enregistrement ['objectifs_fixe'];
		$objet ['bilan'] ['plan_progression'] = $enregistrement ['plan_progression'];
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}

// ////////////////////////intertion les informations de la intervention //////////////////////
/*
 * if ($etat) {
 * try {
 * $sql = "INSERT INTO interventions(date_creation,type_intervention,code_famille,code_eleve,date_debut_mission,date_fin_mission,frequence,duree,observation,matiere,reference,exigeance_date_cours,date_premier_cours,exigeance_bilan_cours) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11,:param12,:param13,:param14) ";
 * $stmt = $cxn->prepare ( $sql );
 * $stmt->bindParam ( ':param1', $param1 );
 * $stmt->bindParam ( ':param2', $param2 );
 * $stmt->bindParam ( ':param3', $param3 );
 * $stmt->bindParam ( ':param4', $param4 );
 * $stmt->bindParam ( ':param5', $param5 );
 * $stmt->bindParam ( ':param6', $param6 );
 * $stmt->bindParam ( ':param7', $param7 );
 * $stmt->bindParam ( ':param8', $param8 );
 * $stmt->bindParam ( ':param9', $param9 );
 * $stmt->bindParam ( ':param10', $param10 );
 * $stmt->bindParam ( ':param11', $param11 );
 * $stmt->bindParam ( ':param11', $param12 );
 * $stmt->bindParam ( ':param11', $param13 );
 * $stmt->bindParam ( ':param11', $param14 );
 * $param1 = $date_creation;
 * $param2 = $type_intervention;
 * $param3 = $code_famille;
 * $param4 = $code_eleve;
 * $param5 = $date_debut_mission;
 * $param6 = $date_fin_mission;
 * $param7 = $frequence;
 * $param8 = $duree;
 * $param9 = $observation;
 * $param10 = $matiere;
 * $param11 = $reference;
 * $param12 = $option_date_1_cours;
 * $param13 = $date_1er_cours;
 * $param14 = $option_bilan_1_cours;
 * $stmt->execute ();
 * } catch ( Exception $e ) {
 * echo $e->getMessage ();
 * $etat = FALSE;
 * $objet ['message_debug'] [] = 'la requette INSERT dans la table interventions a echoué';
 * }
 * }
 *
 * /**
 * ******************************
 */
$objet ['message'] ['reponse'] = $etat;
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>

