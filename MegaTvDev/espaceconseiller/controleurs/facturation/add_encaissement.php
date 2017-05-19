<?php
session_start ();
session_regenerate_id ();
 require_once './../../../connection/config.php';
//require_once './../../config.php';
require './../../librairie/protection_contenu.php';
require_once './../../librairie/generer_code.php';
ini_set ( 'date.timezone', 'Europe/Paris' );
$etat = TRUE;
$objet = array ();
$tab_num_compte = explode ( "_", unhtmlentities ( $_POST ['num_compte'] ) );
$code_client = $tab_num_compte [0];
$num_compte = $tab_num_compte [1];
$code_encaissement = generer_code_encaissement ( random1 ( 6 ) );
$N_facture = unhtmlentities ( $_POST ['N_facture'] );
$N_cheque = unhtmlentities ( $_POST ['num_cheque'] );
$montant_cheque = unhtmlentities ( $_POST ['montant_cheque'] );
$date_encaissement = unhtmlentities ( $_POST ['date_encaiss'] );
$date_execution = unhtmlentities ( $_POST ['date_execution'] );
$date_enregistrement = unhtmlentities ( $_POST ['date_enregistrement'] );
$etat_encaissement = unhtmlentities ( $_POST ['etat_encaissement'] );
// controle de donnee
if ($code_client == '' || $num_compte == '' || $code_encaissement == '' || $date_execution=='' || $date_enregistrement=='' || $N_facture == '' || $N_cheque == '' || $montant_cheque == '' || $date_encaissement == '') {
        if ($date_enregistrement == '') {
		$objet ['message_erreur'] [] = 'la date de l\'enregistrement de cheque est vide';
	}
        if ($date_execution == '') {
		$objet ['message_erreur'] [] = 'la date de l\'execution de cheque est vide';
	}
       	if ($date_encaissement == '') {
		$objet ['message_erreur'] [] = 'la date de l\'encaissement de cheque est vide';
	}      
      	if ($N_cheque == '') {
		$objet ['message_erreur'] [] = 'le Numero de cheque est vide';
	}
       	if ($num_compte == '') {
		$objet ['message_erreur'] [] = 'le champ de numero de facture soit rempli';
	}
      	if ($montant_cheque == '') {
		$objet ['message_erreur'] [] = 'le montant de cheque est vide';
	}  
        if ($code_client == '') {
		$objet ['message_erreur'] [] = 'il ya aucun client qui correspond a cette facture';
	}
          if ($code_encaissement == '') {
		$objet ['message_erreur'] [] = 'le code de encaissement est vide';
	}	
	if ($N_facture == '') {
		$objet ['message_erreur'] [] = 'le code de la facture est vide';
	}
  
       
	$etat = FALSE;
}
////////////verifier que la date de l'enregistrement doit etre inferieur a la date d'execution et la date de l'encaissement
if ($etat) {
     if(($date_enregistrement>$date_encaissement)  ){
        $objet ['message_erreur'] [] = 'la date de l\'enregistrement de cheque doit etre inferieur a la date de l\'encaissement';    
     }
     if(($date_enregistrement>$date_execution) ){
        $objet ['message_erreur'] [] = 'la date de l\'enregistrement de cheque doit etre inferieur a la date de l\'execution'; 
     }
     if(($date_encaissement<$date_execution) ){
        $objet ['message_erreur'] [] = 'la date de l\'execution de cheque doit etre inferieur a la date de l\'encaissement'; 
     }
}
// ////////// controle la reference de l'intervention ////////////////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT id_facture  FROM facture_famille  WHERE N_facture='" . $N_facture . "'  " );
		$nb = $select->rowCount ();
		if ($nb <= 0) {
			$etat = FALSE;
			$objet ['message_erreur'] [] = 'il n\'existe pas une facture qui possede cette reference ';
		}
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données1";
	}
}

// ////////////////////// verifier l'etat de la facture //////////////////////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT etat_facture  FROM facture_famille  WHERE N_facture='" . $N_facture . "'  " );
		$enregistrement = $select->fetch ();
		if ('en_cours_reglement' != $enregistrement ['etat_facture'] && 'attente' != $enregistrement ['etat_facture']) {
			$etat = FALSE;
			$objet ['message_erreur'] [] = 'la facture est deja regle ou annule ';
		}
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données1";
	}
}
// //////////////////// comparer la somme des cheques encaiss� avec le total de la facture////////////////

if ($etat) {
	// 1. recuperer le total de la facture
	try {
		$select = $cxn->query ( " SELECT total_paye  FROM facture_famille  WHERE N_facture='" . $N_facture . "'  " );
		$enregistrement = $select->fetch ();
		$total_facture = $enregistrement ['total_paye'];
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données1";
	}
	// 2. recuperer le total des encaissements des cheques
	try {
		$select = $cxn->query ( " SELECT SUM(montant) AS total_encaisse  FROM liste_encaissements  WHERE N_facture='" . $N_facture . "'  " );
		$enregistrement = $select->fetch ();
		$total_encaisse = $montant_cheque + $enregistrement ['total_encaisse'];
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données1";
	}
       	// 3. recuperer le total des encaissements des cheques regles
	try {
		$select = $cxn->query ( " SELECT SUM(montant) AS total_encaisse_regle  FROM liste_encaissements  WHERE N_facture='" . $N_facture . "' AND  etat='regl&eacute;'  " );
		$enregistrement = $select->fetch ();
		$total_encaisse_regle = $montant_cheque +$enregistrement ['total_encaisse_regle'];
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données1";
	}
	
	
}
 // 3. comparaison le total des encaissements et le total de la facture
if(  $etat && !empty($total_encaisse) && !empty($total_facture)){   
    if ($total_encaisse > $total_facture) {
		$etat = FALSE;
		$objet ['message_erreur'] [] = 'le total des cheques encaisses est superieur au total de la facture ';
    }
}
 // 3. comparaison le total des encaissements regle  et le total de la facture
if(  $etat && !empty($total_encaisse_regle) && !empty($total_facture)){   
    if ($total_encaisse_regle == $total_facture) {
		try {
		$sql = " UPDATE  facture_famille SET etat_facture='attente'  WHERE  N_facture=:param ";
		$stmt = $cxn->prepare ( $sql );
		$stmt->bindParam ( ':param', $N_facture );	
		$stmt->execute ();
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_erreur'] [] = 'Nous somme desole ,votre demande a echoue.contacter adminstrateur de site';
	}	
    }
}

// ///////////////////////enregistrer l'encaissement  ///////////////////////////
if ($etat) {
	try {
		$sql = " INSERT INTO  liste_encaissements (code_encaissement,date_prevu,montant,N_facture,N_cheque,N_compte,date_execution,date_enregistrement) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8) ";
		$stmt = $cxn->prepare ( $sql );
		$stmt->bindParam ( ':param1', $code_encaissement );
		$stmt->bindParam ( ':param2', $date_encaissement );
		$stmt->bindParam ( ':param3', $montant_cheque );
		$stmt->bindParam ( ':param4', $N_facture );
		$stmt->bindParam ( ':param5', $N_cheque );
		$stmt->bindParam ( ':param6', $num_compte );
                $stmt->bindParam ( ':param7', $date_execution );
                $stmt->bindParam ( ':param8', $date_enregistrement );
                //$stmt->bindParam ( ':param9', $etat_encaissement );
		$stmt->execute ();
	} catch ( Exception $e ) {
                $objet ['message_erreur'] []= " INSERT INTO  liste_encaissements (code_encaissement,date_prevu,montant,N_facture,N_cheque,N_compte) VALUES ('".$code_encaissement."','".$date_encaissement."','".$montant_cheque."','".$N_facture."','".$N_cheque."','".$num_compte."') ";
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_erreur'] [] = 'Nous somme desole ,votre demande a echoue.contacter adminstrateur de site';
	}
}else{
   $objet ['valeur_saisi'] ['date_enregistrement']=$date_enregistrement;
    $objet ['valeur_saisi'] ['date_execution']=$date_execution;
   $objet ['valeur_saisi'] ['date_encaissement']=$date_encaissement;
   $objet ['valeur_saisi'] ['N_cheque']=$N_cheque;
   //$objet ['valeur_saisi'] []=$num_compte;
   $objet ['valeur_saisi'] ['montant_cheque']=$montant_cheque;
   
}

/**
 * *****************************
 */
$objet ['message'] ['reponse'] = $etat;
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>


