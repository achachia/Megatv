<?php
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
ini_set('date.timezone', 'Europe/Paris'); 
$etat = TRUE;
$objet = array ();
$ref_intervention = unhtmlentities ( $_POST ['ref_intervention'] );
$code_intervenant = unhtmlentities ( $_POST ['liste_intervenants'] );
$date_affectation = unhtmlentities ( $_POST ['date_affectation'] );
// lse controles de saisie
if ($ref_intervention == '' || $code_intervenant == '' || $date_affectation == '') {
	if ($ref_intervention == '') {
		$objet ['message_erreur'] [] = 'La valeur reference de l\'intervention doit etre defini';
	}
	if ($code_intervenant == '') {
		$objet ['message_erreur'] [] = 'Le champ reference de l\'intervention doit etre defini';
	}
	if ($date_affectation == '') {
		$objet ['message_erreur'] [] = 'Le champ date affectation de l\'intervention doit etre defini';
	}
	$objet ['message_debug'] [] = 'les champs ne devra pas etre vide';
	$etat = FALSE;
}

// // recherche les informations lié a l'intervention
// if ($etat) {
// $infos_intervention = array ();
// try {
// $sql = " SELECT code_eleve FROM interventions WHERE reference=:param ";
// $stmt = $cxn->prepare ( $sql );
// $stmt->bindParam ( ':param', $param );
// $param = $ref_intervention;
// $stmt->execute ();
// $enregistrement = $stmt->fetch ();
// $infos_intervention ['code_eleve'] = $enregistrement ['code_eleve'];
// $infos_intervention ['matiere'] = $enregistrement ['matiere'];
// } catch ( Exception $e ) {
// echo $e->getMessage ();
// $etat = FALSE;
// $objet ['message_debug'] [] = 'la requette SELECT dans la table interventions a echoué';
// }
// }
// intertion la liaison dans la table eleve_intervenant

if ($etat) {
	try {
		$sql = "UPDATE  eleve_intervenant  SET code_intervenant=:param1,date_affectation=:param2  WHERE  reference=:param3 ";
		$stmt = $cxn->prepare ( $sql );
		$stmt->bindParam ( ':param1', $param1 );
		$stmt->bindParam ( ':param2', $param2 );
		$stmt->bindParam ( ':param3', $param3 );
		$param1 = $code_intervenant;
		$param2 = $date_affectation;
		$param3 = $ref_intervention;
		$stmt->execute ();
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'la requette UPDATE  dans la table eleve_intervenant a echoué';
	}
}
/**
 * ******************************
 */
$objet ['message'] ['reponse'] = $etat;
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>
