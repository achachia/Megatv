<?php
session_start ();
session_regenerate_id ();
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
ini_set('date.timezone', 'Europe/Paris'); 
$etat = TRUE;
$objet = array ();
$etat_intervention = unhtmlentities ( $_POST ['etat'] );
$reference_intervention = intval ( unhtmlentities ( $_POST ['reference'] ) );
// controle de donnee
if ($etat_intervention == '' || $reference_intervention == '') {
	if ($etat_intervention == '') {
		$objet ['message_erreur'] [] = 'Le champ etat intervention ne doit pas etre vide';
	}
	if ($reference_intervention == '') {
		$objet ['message_erreur'] [] = 'intervention n\'est pas defini';
	}
	$etat = FALSE;	
}
if (! is_int ( $reference_intervention ) && $reference_intervention > 0) {
	$etat = FALSE;
	$objet ['message_erreur'] [] = 'le champ  reference intervention n\'est pas entier';
}
// ////////// controle la reference de l'intervention ////////////////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT id_intervention  FROM interventions  WHERE reference='" . $reference_intervention . "'  " );
		$nb = $select->rowCount ();
		if ($nb <= 0) {
			$etat = FALSE;			
			$objet ['message_erreur'] [] = 'il n\'existe pas une intervention qui possede cette reference ';
		}
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}
// ////////// controle code_intervenant de l'intervention non NULL ////////////////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT code_intervenant  FROM eleve_intervenant  WHERE reference='" . $reference_intervention . "'  " );
		$enregistrement = $select->fetch ();
		$code_intervenant = $enregistrement ['code_intervenant'];
		if ($code_intervenant == NULL) {
			$etat = FALSE;			
			$objet ['message_erreur'] [] = 'le choix de l\'intervenant n\'est pas encore defini pour l\'intervention ';
		}
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}
// ////////// controle la date de 1er cours de l'intervention ////////////////////////////

if ($etat) {
	// ////////////// chercher est ce que l'intervention possede une exigence de date de premier cours
	try {
		$select = $cxn->query ( " SELECT date_premier_cours  FROM interventions  WHERE  reference='" . $reference_intervention . "'  " );
		$enregistrement = $select->fetch ();
		$exigeance_date_cours = $enregistrement ['date_premier_cours'];
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
	// /////////////// verifier est de que le bilan de premier cours existe en cas ou il demande
	if ($etat_intervention == 'confirme' && $exigeance_date_cours == '1') {
		try {
			$select = $cxn->query ( " SELECT date_premier_cours  FROM interventions  WHERE  reference='" . $reference_intervention . "'  " );
			$date_premier_cours = $enregistrement ['date_premier_cours'];
			if ($date_premier_cours == '0000-00-00') {
				$etat = FALSE;				
				$objet ['message_erreur'] [] = 'cette intervention ne possede pas une date de premier cours  ';
			}
		} catch ( Exception $e ) {
			$etat = FALSE;
			echo "Une erreur est survenue lors de la récupération des données";
		}
	}
}
// ////////// controle le bilan de 1er cours de l'intervention ////////////////////////////

if ($etat) {
	// ////////////// chercher est ce que l'intervention possede une exigence de bilan de premier cours
	try {
		$select = $cxn->query ( " SELECT exigeance_bilan_cours  FROM interventions  WHERE  reference='" . $reference_intervention . "'  " );
		$enregistrement = $select->fetch ();
		$exigeance_bilan_cours = $enregistrement ['exigeance_bilan_cours'];
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
	// /////////////// verifier est de que le bilan de premier cours existe en cas ou il demande
	if ($etat_intervention == 'confirme' && $exigeance_bilan_cours == '1') {
		try {
			$select = $cxn->query ( " SELECT id_bilan  FROM bilan_premier_cours  WHERE  reference='" . $reference_intervention . "'  " );
			$nb = $select->rowCount ();
			if ($nb <= 0) {
				$etat = FALSE;				
				$objet ['message_erreur'] [] = 'cette intervention ne possede pas un bilan de premier cours ';
			}
		} catch ( Exception $e ) {
			$etat = FALSE;
			echo "Une erreur est survenue lors de la récupération des données";
		}
	}
}
// ////////////////////// verifier l'etat de l'intervention //////////////////////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT *  FROM eleve_intervenant  WHERE reference='" . $reference_intervention . "'  AND  statut='" . $etat_intervention . "'  " );
		$nb = $select->rowCount ();
		if ($nb > 0) {
			$etat = FALSE;		
			$objet ['message_erreur'] [] = 'il existe  une intervention qui possede deja cette etat ';
		}
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}
// ///////////////////// les etats possible de l'intervention
if ($etat) {
	try {
		$sql = "  SELECT statut  FROM eleve_intervenant  WHERE reference=:param ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $param );
		$param = $reference_intervention;
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$etat = $enregistrement ['statut'];
                $tab_valeurs_possible = array ();
		if ($etat == 'attente') {
			$tab_valeurs_possible = [ 
					'confirme',
					'termine',
					'annule' 
			];
		} elseif ($etat == 'confirme') {
			$tab_valeurs_possible = [ 
					'termine',
					'annule' 
			];
		}
		if (!in_array ( $etat_intervention, $tab_valeurs_possible )) {
			$etat = FALSE;
			$objet ['message_erreur'] [] = 'Nous sommes desole,votre demande de changement etat est refuse';
		}
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}

// ///////////////////////Mise a jur etat de intervention ///////////////////////////
if ($etat) {
	try {
		$sql = " UPDATE  eleve_intervenant  SET statut=:param1  WHERE reference=:param2 ";
		$stmt = $cxn->prepare ( $sql );
		$stmt->bindParam ( ':param1', $param1 );
		$stmt->bindParam ( ':param2', $param2 );
		$param1 = $etat_intervention;
		$param2 = $reference_intervention;
		$stmt->execute ();
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;		
		$objet ['message_erreur'] [] = 'Nous somme desole ,votre demande a echoue.contacter adminstrateur de site';
	}
}

/**
 * *****************************
 */

$objet ['message'] ['reponse'] = $etat;
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>