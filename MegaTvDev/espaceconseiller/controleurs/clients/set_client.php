<?php
session_start ();
session_regenerate_id ();
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
require './../../librairie/generer_code.php';
ini_set('date.timezone', 'Europe/Paris'); 
$etat = TRUE;
$objet = array ();
$statut = unhtmlentities ( $_POST ['statut'] );
$nom = unhtmlentities ( $_POST ['nom_client'] );
$prenom = unhtmlentities ( $_POST ['prenom_client'] );
$civilite = unhtmlentities ( $_POST ['civilite'] );
$adresse = unhtmlentities ( $_POST ['adresse'] );
$adresse_suite = unhtmlentities ( $_POST ['adresse_suite'] );
$code_postale = unhtmlentities ( $_POST ['cp'] );
$ville = unhtmlentities ( $_POST ['ville'] );
$tel_fixe = unhtmlentities ( $_POST ['tel_domicile'] );
$tel_portable = unhtmlentities ( $_POST ['tel_portable'] );
$tel_travail = unhtmlentities ( $_POST ['tel_travail'] );
$email = unhtmlentities ( $_POST ['email'] );
$fax = unhtmlentities ( $_POST ['fax'] );
$site_web = unhtmlentities ( $_POST ['site_web'] );
$date_adhesion = unhtmlentities ( $_POST ['date_adhesion'] );
$infos_interne = unhtmlentities ( $_POST ['infos_interne'] );
$infos_intervenants = unhtmlentities ( $_POST ['infos_intervenants'] );
$pays = unhtmlentities ( $_POST ['pays'] );
$date_saisi = date ( "Y-m-d H:i:s" );
$code_parrain = unhtmlentities ( $_POST ['liste_clients'] );
$code_parrain = (! empty ( $code_parrain )) ? $code_parrain : 'aucun';
// ///////////// controle les saisies//////////////////////////////////////////////
if ($statut == '' || $nom == '' || $prenom == '' || $civilite == '' || $adresse == '' || $code_postale == '' || $ville == '' || $email == '' || $date_adhesion == '') {
	if ($statut == '') {
		$objet ['message_erreur'] [] = 'Le champ statut ne doit pas etre vide';
	}
	if ($nom == '') {
		$objet ['message_erreur'] [] = 'Le champ nom ne doit pas etre vide';
	}
	if ($prenom == '') {
		$objet ['message_erreur'] [] = 'Le champ prenom ne doit pas etre vide';
	}
	if ($civilite == '') {
		$objet ['message_erreur'] [] = 'Le champ civilite ne doit pas etre vide';
	}
	if ($date_adhesion == '') {
		$objet ['message_erreur'] [] = 'Le champ date adhesion ne doit pas etre vide';
	}
	if ($email == '') {
		$objet ['message_erreur'] [] = 'Le champ email ne doit pas etre vide';
	}
	$etat = FALSE;
	$objet ['message_debug'] [] = 'les champs ne devra pas etre vide';
}
// ///////////////////////////// verification les champs de telephone
if ($tel_fixe == '' && $tel_portable == '' && $tel_travail == '') {
	$etat = FALSE;
	$objet ['message_debug'] [] = 'les champs tel_fixe et tel tel_portable et tel travail ne devra pas etre vide les trois en meme temps';
}
/* ***************** verification code postale ********************* */
if (! preg_match ( '/^([0-9]{5})$/', $code_postale ) && $code_postale != '') {
	$etat = FALSE;
	$objet ['message_erreur'] [] = 'le format de code postale est non valide ';
}
/**
 * *************** verification Numero tel portable ****************************
 */
if ($tel_portable != '') {
	$tel_portable = ereg_replace ( "[^0-9]", "", $tel_portable ); // formater le format de tel 01-52-54-52 => 01525452
	if (! preg_match ( '/^0[6-7][0-9]{8}$/', $tel_portable )) {
		$etat = FALSE;
		$objet ['message_erreur'] [] = 'le format de numero telephone portable est non valide ';
	}
}
/**
 * *************** verification Numero tel fixe ****************************
 */
if ($tel_fixe != '') {
	$tel_fixe = ereg_replace ( "[^0-9]", "", $tel_fixe ); // formater le format de tel 01-52-54-52 => 01525452
	if (!preg_match ( '/^0[1-59][0-9]{8}$/', $tel_fixe )) {
		$etat = FALSE;
		$objet ['message_erreur'] [] = 'le format de numero telephone fixe est non valide ';
	}
}
/**
 * *************** verification Numero tel travail ****************************
 */
if ($tel_travail != '') {
	$tel_travail = ereg_replace ( "[^0-9]", "", $tel_travail ); // formater le format de tel 01-52-54-52 => 01525452
	if (! preg_match ( '/^0[1-59][0-9]{8}$/', $tel_travail )) {
		$etat = FALSE;
		$objet ['message_erreur'] [] = 'le format de numero telephone travail est non valide ';
	}
}
/**
 * **************** verification le format de Email ************************
 */
if ($email != '') {
	$control_interne = true;
	if (! preg_match ( "$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $email )) {
		$etat = FALSE;
		$control_interne = false;
		$objet ['message_erreur'] [] = 'Le format de adresse e-mail n\'pas valide';
	}
	if ($control_interne) {
		try {
			$select = $cxn->query ( " SELECT email  FROM membre_famille WHERE email='" . $email . "'   UNION  SELECT email  FROM intervenants   WHERE email='" . $email . "'   UNION  SELECT email  FROM eleve_famille WHERE email='" . $email . "'  " );
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		$nb = $select->rowCount ();
		if ($nb > 0) {
			$etat = FALSE;
			$objet ['message_erreur'] [] = 'il existe une personne qui possede le meme mail ';
		}
	}
}
// //////////////////// verification le nom et le prenom de client /////////////////////////////
if ($nom != '' && $prenom != '') {
	try {
		$select = $cxn->query ( " SELECT nom,prenom  FROM membre_famille WHERE nom='" . $nom . "' AND  prenom='" . $prenom . "'  UNION  SELECT nom,prenom  FROM intervenants   WHERE nom='" . $nom . "' AND  prenom='" . $prenom . "'  UNION  SELECT nom,prenom  FROM eleve_famille WHERE nom='" . $nom . "' AND  prenom='" . $prenom . "' " );
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	$nb = $select->rowCount ();
	if ($nb > 0) {
		$etat = FALSE;
		$objet ['message_erreur'] [] = 'il existe une personne qui possede le meme nom et prenom ';
	}
}
// /////////// intertion les informations de client//////////////////////////////////
if ($etat) {
	try {
		$cxn->beginTransaction ();
		// intertion les informations de client
		$sql = " INSERT INTO membre_famille(statut,nom,prenom,civilite,adresse,adresse_suite,code_postale,ville,pays,telephone_fixe,telephone_portable,telephone_travail,email,fax,site_web,Date_adhesion,infos_interne,infos_intervenants,date_saisi,code_parrain) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11,:param12,:param13,:param14,:param15,:param16,:param17,:param18,:param19,:param20)";
		$stmt = $cxn->prepare ( $sql );
		$param1 = $statut;
		$param2 = $nom;
		$param3 = $prenom;
		$param4 = $civilite;
		$param5 = $adresse;
		$param6 = $adresse_suite;
		$param7 = $code_postale;
		$param8 = $ville;
		$param9 = $pays;
		$param10 = $tel_fixe;
		$param11 = $tel_portable;
		$param12 = $tel_travail;
		$param13 = $email;
		$param14 = $fax;
		$param15 = $site_web;
		$param16 = $date_adhesion;
		$param17 = $infos_interne;
		$param18 = $infos_intervenants;
		$param19 = $date_saisi;
		$param20 = $code_parrain;
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
		$stmt->bindParam ( ':param14', $param14 );
		$stmt->bindParam ( ':param15', $param15 );
		$stmt->bindParam ( ':param16', $param16 );
		$stmt->bindParam ( ':param17', $param17 );
		$stmt->bindParam ( ':param18', $param18 );
		$stmt->bindParam ( ':param19', $param19 );
		$stmt->bindParam ( ':param20', $param20 );
		$stmt->execute ();
		$objet ['etapes_creation'] [] = '<span class="glyphicon glyphicon-ok"></span> Creation la filleul associee au client.';
		// //////////////////////// chercher le ID-famille ////////////////////////////
		$stmt = $cxn->prepare ( " SELECT id_famille FROM membre_famille WHERE email=:param " );
		$param = $email;
		$stmt->bindParam ( ':param', $param );
		$stmt->execute ();
		$enregistrement = $stmt->fetch ();
		$id_famille = $enregistrement ['id_famille'];
		// Mettre a jour le code de famille
		$code = 'CF' . $id_famille;
		$sql = " UPDATE  membre_famille SET code_famille='" . $code . "'  WHERE email='" . $email . "' ";
		$select = $cxn->query ( $sql );
		// creation mot de passe et envoi un mail au client
		$mot_passe = generer_code_client ( random ( 6 ) );
		$mot_passe_crypte = md5 ( $mot_passe );
		$sql = " UPDATE  membre_famille SET mot_passe='" . $mot_passe_crypte . "'  WHERE email='" . $email . "' ";
		$select = $cxn->query ( $sql );
		// Insertion la liaison entre la famille et le conseiller pedagogique
		$code_famille = 'CF' . $id_famille;
		$code_conseiller = unhtmlentities ( $_POST ['conseiller_peda'] );
		$sql = " INSERT INTO famille_conseiller (code_famille,code_conseiller,debut_mission) VALUES (:param1,:param2,:param3) ";
		$stmt = $cxn->prepare ( $sql );
		$param1 = $code_famille;
		$param2 = $code_conseiller;
		$param3 = date ( "Y-m-d" );
		$stmt->bindParam ( ':param1', $param1 );
		$stmt->bindParam ( ':param2', $param2 );
		$stmt->bindParam ( ':param3', $param3 );
		$stmt->execute ();
		$cxn->commit ();
	} catch ( Exception $e ) {
		$cxn->rollback ();
		$etat = FALSE;
	}
}


/* * *********************************** Insertion la table liste_filleuls ****** */
/**
 * ******************** 1.chercher identification de code parrain **********************************
 */

if ($etat) {
	try {
		$cxn->beginTransaction ();
		// chercher le code de parrain
		$sql = "  SELECT membre_famille.code_famille AS code_client, membre_famille.nom AS nom_client, membre_famille.prenom AS prenom_client ";
		$sql .= "  FROM membre_famille  WHERE membre_famille.code_famille='" . $code_parrain . "' ";
		$sql .= "  UNION ";
		$sql .= "  SELECT intervenants.code_intervenant AS code_client, intervenants.nom AS nom_client, intervenants.prenom AS prenom_client ";
		$sql .= "  FROM intervenants WHERE intervenants.code_intervenant='" . $code_parrain . "' ";
		$select = $cxn->query ( $sql );
		$nb = $select->rowCount ();
		if ($nb <= 0) {
			$etat = FALSE;
			$objet ['message_debug'] [] = 'il n\'existe une personne qui possede ce code client  ';
			$objet ['message_erreur'] [] = 'il n\'existe une personne qui possede ce code client ';
		} else {
			// intertion dans la table liste_filleuls
			$code_filleul = $code_famille;
			$sql = " INSERT INTO liste_filleuls (code_referent,code_filleul,date_affectation) VALUES (:param1,:param2,:param3) ";
			$stmt = $cxn->prepare ( $sql );
			$param1 = $code_parrain;
			$param2 = $code_filleul;
			$param3 = date ( "Y-m-d H:i:s" );
			$stmt->bindParam ( ':param1', $param1 );
			$stmt->bindParam ( ':param2', $param2 );
			$stmt->bindParam ( ':param3', $param3 );
			$stmt->execute ();
		}
		$cxn->commit ();
	} catch ( Exception $e ) {
		$cxn->rollback ();
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}

/* * ************* envoi mail ******** */
 if ($etat) {
 	$entetedate = date ( "D, j M Y H:i:s -0600" ); // Offset horaire
 	$headers = "From: \"espacefamille@mega-cours.fr\"<espacefamille@mega-cours.fr>\n";
 	$headers .= "Reply-To: espacefamille@mega-cours.fr\n";
 	$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
 	$message = "<html>";
 	// $message.="<titre>Votre identifiant de connexion &agrave; l'espace famille </titre>";
 	$message .= "<head></head>";
 	$message .= "<body>Bonjour,<br/><br/><br/>";
 	$message .= "Voici les informations vous permettant de vous identifier sur votre Espace famille de mega-cours,<br/>";
 	$message .= "Votre e-mail : " . $email . " <br/>";
 	$message .= "Votre mot de passe : " . $mot_passe . " <br/><br/>";
 	$message .= "Pour vous connecter,<br/>";
 	$message .= "veuillez utiliser le lien ci-dessous : <br/>";
 	$message .= "<a href = 'http://mega-cours.fr/espacefamille/login.php' >http://mega-cours.fr/espacefamille/login.php</a><br/><br/>";
 	$message .= " Pour rappel dans cet espace qui vous est r&eacute;serv&eacute;, vous pourrez notamment :,<br/>";
 	$message .= " - consulter les comptes-rendus<br/>";
 	$message .= " - consulter vos factures<br/>";
 	$message .= " - acc&eacute;der &aacute; une base de supports p&eacute;dagogiques.<br/><br/>";
 	$message .= "Bonne d&eacute;couverte et utilisation.<br/>";
 	$message .= "Mega-cours.";
 	if (! mail ( $email, "Votre identifiant de connexion a l'espace famille", $message, $headers )) {
 		$etat = FALSE;
 		$objet ['message_debug'] [] = "desole l'inscrption a echoué.";
 		$objet ['etapes_creation'] [] = '<span class="glyphicon glyphicon-remove"></span> Envoi le mail de connection au client.';
 	} else {
 		$objet ['etapes_creation'] [] = '<span class="glyphicon glyphicon-ok"></span> Envoi le mail de connection au client.';
 	}
 }
            /* * ****************************************************/
$objet ['message'] = array (
		'reponse' => $etat 
);
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>
