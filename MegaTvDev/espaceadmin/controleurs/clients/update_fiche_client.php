<?php
session_start ();
session_regenerate_id ();
require_once './../../../connection/config.php';
ini_set('date.timezone', 'Europe/Paris'); 
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/modele/clients/edit_fiche_client.php';
$control = true;
$objet = array ();
if ($_POST ['code_client'] == '') {
	$control = false;
	$objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande ';
} else {
	$code_client = htmlspecialchars ( $_POST ['code_client'] );
	try {
		$select = $cxn->query ( " SELECT email  FROM membre_famille WHERE code_famille='" . $code_client . "' " );
		$nb = $select->rowCount ();
		if ($nb <= 0) {
			$control = FALSE;
			$objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande ';
		}
	} catch ( Exception $e ) {
		$control = FALSE;
		$objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande ';
	}
}
if ($control) {
	$req2 = "";
	$infos_client = infos_client ( $code_client );
	if (! isset ( $_POST ['adresse'] ) || empty ( $_POST ['adresse'] )) {
		$control = false;
		$objet ['message_erreur'] [] = 'Le champ adresse est vide';
	} else {
		if (isset ( $_POST ['adresse'] ) && ! empty ( $_POST ['adresse'] ) && $_POST ['adresse'] != $infos_client ['adresse']) {
			$_POST ['adresse'] = htmlspecialchars ( $_POST ['adresse'] );
			$req2 .= "adresse='" . $_POST ['adresse'] . "',";
		}
		if (isset ( $_POST ['adresse_suite'] ) && ! empty ( $_POST ['adresse_suite'] ) && $_POST ['adresse_suite'] != $infos_client ['adresse_suite']) {
			$_POST ['adresse_suite'] = htmlspecialchars ( $_POST ['adresse_suite'] );
			$req2 .= "adresse_suite='" . $_POST ['adresse_suite'] . "',";
		}
	}
	if (! isset ( $_POST ['cp'] ) || empty ( $_POST ['cp'] )) {
		$control = false;
		$objet ['message_erreur'] [] = 'Le champ code-postale  est vide  ';
	} else {
		if ($_POST ['cp'] != $infos_client ['code_postale']) {
			$_POST ['cp'] = htmlspecialchars ( $_POST ['cp'] );
			if (! preg_match ( '/^([0-9]{5})$/', $_POST ['cp'] )) {
				$control = false;
				$objet ['message_erreur'] [] = 'Le format  code-postale n\'est pas valide ';
			} else {
				$req2 .= "code_postale='" . $_POST ['cp'] . "',";
			}
		}
	}
	
	if (! isset ( $_POST ['ville'] ) || empty ( $_POST ['ville'] )) {
		$control = false;
		$objet ['message_erreur'] [] = 'Le champ ville est vide  ';
	} else {
		if ($_POST ['ville'] != $infos_client ['ville']) {
			$_POST ['ville'] = htmlspecialchars ( $_POST ['ville'] );
			$req2 .= "ville='" . $_POST ['ville'] . "',";
		}
	}
	
	if (! isset ( $_POST ['email'] ) || empty ( $_POST ['email'] )) {
		$control = false;
		$objet ['message_erreur'] [] = 'Le champ email est vide  ';
	} elseif (! preg_match ( "$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $_POST ['email'] ) && $_POST ['email'] != '') {
		$control = false;
		$objet ['message_erreur'] [] = 'Le format de adresse e-mail n\'pas valide';
	} elseif ($_POST ['email'] != $infos_client ['email'] && $_POST ['email'] != '') {
		$email = htmlspecialchars ( $_POST ['email'] );
		try {
			$select = $cxn->query ( " SELECT email  FROM membre_famille WHERE email='" . $email . "'   UNION  SELECT email  FROM intervenants   WHERE email='" . $email . "'   UNION  SELECT email  FROM eleve_famille WHERE email='" . $email . "'  " );
			$nb = $select->rowCount ();
			if ($nb > 0) {
				$control = FALSE;
				$objet ['message_erreur'] [] = 'il existe une personne qui possede le meme mail ';
			} else {
				$req2 .= "email='" . $email . "',";
			}
		} catch ( Exception $e ) {
			$control = FALSE;
			$objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande 1';
		}
	}
	
	if (empty ( $_POST ['tel_portable'] ) && empty ( $_POST ['tel_fixe'] ) && empty ( $_POST ['tel_travail'] )) {
		$control = false;
		$objet ['message_erreur'] [] = 'Le champ telephone est vide ';
	} else {
		if (isset ( $_POST ['tel_portable'] ) && ! empty ( $_POST ['tel_portable'] ) && $_POST ['tel_portable'] != $infos_client ['tel_portable']) {
			$_POST ['tel_portable'] = htmlspecialchars ( $_POST ['tel_portable'] );
			if (! preg_match ( "#^0[6-7]([-]?[0-9]{2}){4}$#", $_POST ['tel_portable'] )) {
				$control = false;
				$objet ['message_erreur'] [] = 'Le format telephone portable  n\'est pas valide ';
			} else {
				$req2 .= "telephone_portable='" . $_POST ['tel_portable'] . "',";
			}
		}
		if (isset ( $_POST ['tel_domicile'] ) && ! empty ( $_POST ['tel_domicile'] ) && $_POST ['tel_domicile'] != $infos_client ['tel_domicile']) {
			$_POST ['tel_domicile'] = htmlspecialchars ( $_POST ['tel_domicile'] );
                        $tel_fixe = ereg_replace ( "[^0-9]", "", $_POST ['tel_domicile'] ); // formater le format de tel 01-52-54-52 => 01525452
			if (! preg_match ('/^0[1-59][0-9]{8}$/', $tel_fixe )) {
				$control = false;
				$objet ['message_erreur'] [] = 'Le format telephone fixe  n\'est pas valide ';
			} else {
				$req2 .= "telephone_fixe='" . $tel_fixe . "',";
			}
		}
		if (isset ( $_POST ['tel_travail'] ) && ! empty ( $_POST ['tel_travail'] ) && $_POST ['tel_travail'] != $infos_client ['tel_travail']) {
			$_POST ['tel_travail'] = htmlspecialchars ( $_POST ['tel_travail'] );
			if (! preg_match ( "#^0[1-59]([-]?[0-9]{2}){4}$#", $_POST ['tel_travail'] )) {
				$control = false;
				$objet ['message_erreur'] [] = 'Le format telephone travail  n\'est pas valide ';
			} else {
				$req2 .= "telephone_travail='" . $_POST ['tel_travail'] . "',";
			}
		}
		if (isset ( $_POST ['fax'] ) && ! empty ( $_POST ['fax'] ) && $_POST ['fax'] != $infos_client ['fax']) {
			$_POST ['fax'] = htmlspecialchars ( $_POST ['fax'] );
			if (! preg_match ( "#^0[1-9]([-]?[0-9]{2}){4}$#", $_POST ['fax'] )) {
				$control = false;
				$objet ['message_erreur'] [] = 'Le format Fax  n\'est pas valide ';
			} else {
				$req2 .= "fax='" . $_POST ['fax'] . "',";
			}
		}
	}
	if (isset ( $_POST ['site_web'] ) && ! empty ( $_POST ['site_web'] ) && $_POST ['site_web'] != $infos_client ['site_web']) {
		$_POST ['site_web'] = htmlspecialchars ( $_POST ['site_web'] );
		if (! preg_match ( '#^http://[w-]+[w.-]+.[a-zA-Z]{2,6}#i', $_POST ['site_web'] )) {
			$control = false;
			$objet ['message_erreur'] [] = 'Le format Site web  n\'est pas valide ';
		} else {
			$req2 .= "site_web='" . $_POST ['site_web'] . "',";
		}
	}
	if (isset ( $_POST ['infos_interne'] ) && ! empty ( $_POST ['infos_interne'] ) && $_POST ['infos_interne'] != $infos_client ['infos_interne']) {
		$_POST ['infos_interne'] = htmlspecialchars ( $_POST ['infos_interne'] );
		$req2 .= "infos_interne='" . $_POST ['infos_interne'] . "',";
	}
	if (isset ( $_POST ['infos_intervenants'] ) && ! empty ( $_POST ['infos_intervenants'] ) && $_POST ['infos_intervenants'] != $infos_client ['infos_intervenants']) {
		$_POST ['infos_intervenants'] = htmlspecialchars ( $_POST ['infos_intervenants'] );
		$req2 .= "infos_intervenants='" . $_POST ['infos_intervenants'] . "',";
	}
     	if (isset ( $_POST ['numero_compte'] ) && ! empty ( $_POST ['numero_compte'] ) && $_POST ['numero_compte'] != $infos_client ['N_compte_banc']) {
		$_POST ['numero_compte'] = htmlspecialchars ( $_POST ['numero_compte'] );
		$req2 .= "N_compte_banc='" . $_POST ['numero_compte'] . "',";
	}
	if ($control && $req2 != '') {
		$req2 = substr ( $req2, 0, - 1 );
		$sql = " UPDATE membre_famille SET " . $req2 . " WHERE code_famille=:param ";
		try {
			$stmt = $cxn->prepare ( $sql );
			$stmt->bindParam ( ':param', $code_client );
			$stmt->execute ();
		} catch ( Exception $e ) {
			$control = FALSE;
			$objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande 2 ';
		}
	}
}
$objet ['message'] = array (
		'reponse' => $control 
);
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>
