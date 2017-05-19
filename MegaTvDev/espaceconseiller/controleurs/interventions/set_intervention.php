<?php
require_once './../../../connection/config.php';
require './../../librairie/generer_code.php';
require './../../librairie/protection_contenu.php';
ini_set('date.timezone', 'Europe/Paris'); 
// http://www.epershand.net/developpement/mysql-bdd/timestamp-mysql-create-update
$etat = TRUE;
$objet = array ();
$date_creation = date ( "Y-m-d H:i:s" );
$type_intervention = unhtmlentities ( $_POST ['type_intervention'] );
$frequence = unhtmlentities ( $_POST ['frequence'] );
$code_famille = unhtmlentities ( $_POST ['choix_famille'] );
$date_debut_mission = unhtmlentities ( $_POST ['debut_mission'] );
$duree = unhtmlentities ( $_POST ['duree'] );
$observation = unhtmlentities ( $_POST ['infos_intervention'] );
$matiere = unhtmlentities ( $_POST ['matiere'] );
$sex = unhtmlentities ( $_POST ['choix_sex'] );
$statut_interv = unhtmlentities ( $_POST ['choix_statut'] );
$option_date_1_cours = unhtmlentities ( $_POST ['option_date_1_cours'] );
$option_bilan_1_cours = ($type_intervention == 'regulier' && isset ( $type_intervention )) ? unhtmlentities ( $_POST ['option_bilan_1_cours'] ) : '0';

// les controles les saisies du formulaire
if ($sex == '' || $statut_interv == '' || $type_intervention == '' || $frequence == '' || $code_famille == '' || $date_debut_mission == '' || $matiere == '' || $duree == '') {
	if ($type_intervention == '') {
		$objet ['message_erreur'] [] = 'Le champ type intervention  doit etre defini';
	}
	if ($frequence == '') {
		$objet ['message_erreur'] [] = 'Le champ frequence intervention doit etre defini';
	}
	if ($code_famille == '') {
		$objet ['message_erreur'] [] = 'Le champ choix famille doit etre defini';
	}
	if ($date_debut_mission == '') {
		$objet ['message_erreur'] [] = 'Le champ date debut mission doit etre defini';
	}
	if ($matiere == '') {
		$objet ['message_erreur'] [] = 'Le champ matiere doit etre defini';
	}
	if ($duree == '') {
		$objet ['message_erreur'] [] = 'Le champ duree doit etre defini';
	}
	if ($sex == '') {
		$objet ['message_erreur'] [] = 'Le champ de sex de intervenant doit etre defini';
	}
	if ($statut_interv == '') {
		$objet ['message_erreur'] [] = 'Le champ statut intervenant doit etre defini';
	}
	$etat = FALSE;
	$objet ['message_debug'] [] = 'les champs ne devra pas etre vide';
}
if ($type_intervention == 'regulier') {
	$date_fin_mission = NULL;
} elseif ($type_intervention == 'ponctuelle') {
	$date_fin_mission = unhtmlentities ( $_POST ['fin_mission'] );
	if ($date_fin_mission == '') {
		$objet ['message_erreur'] [] = 'Le champ date fin mission  doit etre defini';
	}
}
if ($code_famille != '') {
	$code_eleve = unhtmlentities ( $_POST ['choix_eleve'] );
	if ($code_eleve == '') {
		$etat = FALSE;
		$objet ['message_erreur'] [] = 'Le champ Choix eleve doit etre defini';
	}
}

// ////////////////////////intertion les informations de la intervention && eleve_intervenant //////////////////////
if ($etat) {
	
	if ($sex == 'pas_renseigne') {
		$sex = NULL;
	}
	if ($statut_interv == 'pas_renseigne') {
		$statut_interv = NULL;
	}
	$reference = generer_code_intervention ( random1 ( 6 ) );
	$cxn->beginTransaction ();
	try {
		// //////////////intertion les informations dans la table intervention
		$sql = "INSERT INTO interventions(date_creation,type_intervention,date_debut_mission,date_fin_mission,frequence,duree,sex,statut,observation,reference,exigeance_date_cours,exigeance_bilan_cours,code_eleve) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11,:param12,:param13) ";
		$stmt = $cxn->prepare ( $sql );
		$stmt->bindParam ( ':param1', $param1 );
		$stmt->bindParam ( ':param2', $param2 );
		$stmt->bindParam ( ':param3', $param3 );
		$stmt->bindParam ( ':param4', $param4 );
		$stmt->bindParam ( ':param5', $param5 );
		$stmt->bindParam ( ':param6', $param6 );
		$stmt->bindParam ( ':param7', $param7 );
		$stmt->bindParam ( ':param8', $param8 );
		$stmt->bindParam ( ':param9', $param9 );
		$stmt->bindParam ( ':param10', $param10 );
		$stmt->bindParam ( ':param11', $param11 );
		$stmt->bindParam ( ':param12', $param12 );
		$stmt->bindParam ( ':param13', $param13 );
		$param1 = $date_creation;
		$param2 = $type_intervention;
		$param3 = $date_debut_mission;
		$param4 = $date_fin_mission;
		$param5 = $frequence;
		$param6 = $duree;
		$param7 = $sex;
		$param8 = $statut_interv;
		$param9 = $observation;
		$param10 = $reference;
		$param11 = $option_date_1_cours;
		$param12 = $option_bilan_1_cours;
		$param13 = $code_eleve;
		$stmt->execute ();
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'intervention n\'a pas pu enregistrer  dans la table interventions ';
	}
	try {
		// /intertion les informations dans la table eleve_intervenant
		$sql = "INSERT INTO eleve_intervenant(code_eleve,matiere,reference) VALUES (:param1,:param2,:param3) ";
		$stmt = $cxn->prepare ( $sql );
		$stmt->bindParam ( ':param1', $param1 );
		$stmt->bindParam ( ':param2', $param2 );
		$stmt->bindParam ( ':param3', $param3 );
		$param1 = $code_eleve;
		$param2 = $matiere;
		$param3 = $reference;
		$stmt->execute ();
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'intervention n\'a pas pu enregistrer  dans le table eleve_intervenant ';
	}
	if ($etat) {
		$cxn->commit ();
	} else {
		$cxn->rollback ();
	}
}
// /////////////////////////////////////////////////////////////////
if (isset ( $_POST ['choix_interv'] ) && $_POST ['choix_interv'] == 'oui' && $etat) {
	$lien = "http://" . $_SERVER ['HTTP_HOST'] . rtrim ( dirname ( dirname ( dirname ( $_SERVER ['PHP_SELF'] ) ) ), '/\\' ) . "/index.php?module=interventions&action=choix_intervenant&reference_intervention=" . $reference;
	$objet ['message'] ['lien_choix_interv'] = $lien;
}
/**
 * ******************************
 */
$objet ['message'] ['reponse'] = $etat;
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>

