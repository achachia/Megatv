<?php
session_start ();
session_regenerate_id ();
require_once './../connection/config.php';
$etat = TRUE;
if (isset ( $_POST ['identification'] )) {
	if (empty ( $_POST ["email"] ) || ! preg_match ( "$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $_POST ["email"] )) {
		$etat = FALSE;
	}
	if (empty ( $_POST ["password"] )) {
		$etat = FALSE;
	}
	if ($etat) {
		$email = htmlentities ( addslashes ( trim ( $_POST ['email'] ) ), ENT_QUOTES );
		$password = htmlentities ( addslashes ( trim ( $_POST ['password'] ) ), ENT_QUOTES );
		$password = md5 ( $password );
		try {		
			$select = $cxn->query ( " SELECT code_conseiller FROM conseiller_peda  WHERE email='" . $email . "'  AND  mot_passe='" . $password . "' " );
			$nb = $select->rowCount ();
			if ($nb <= 0) {
				$etat = FALSE;
			} else {
				$enregistrement = $select->fetch ();
				$_SESSION ['code_conseiller'] = $enregistrement ['code_conseiller'];
			}
		} catch ( Exception $e ) {
			$etat = FALSE;
			echo "Une erreur est survenue lors de la récupération des données";
		}
	}
	
	if ($etat) {
		header ( "Location:  index.php?action=home" );
	} else {
		header ( "Location:  login.php?message_erreur=erreur" );
	}
	exit ();
}
?>
