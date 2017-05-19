<?php
session_start ();
session_regenerate_id ();
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
require './../../librairie/generer_code.php';
ini_set('date.timezone', 'Europe/Paris'); 
$etat = TRUE;
$objet = array ();
$code_membre=unhtmlentities ( $_POST ['code_client'] );
/***************** controle de saisie *************************/
if ($code_membre == '') {
	$objet ['message_erreur'] [] = 'Votre demande ne peut etre effectue';
	$etat = FALSE;
	$objet ['message_debug'] [] = 'les champs ne devra pas etre vide';
}
// //////////////////// verification le code client /////////////////////////////
if ($etat) {
	try {
		$select = $cxn->query ( " SELECT *  FROM membre_famille WHERE code_famille='" . $code_membre . "'  " );
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	$nb = $select->rowCount ();
	if ($nb <= 0) {
		$etat = FALSE;
		$objet ['message_debug'] [] = 'il n\'existe pas une personne qui possede ce profil  ';
		$objet ['message_erreur'] [] = 'il n\'existe pas une personne qui possede ce profil ';
	}
}
/* //////////////////////// chercher le ID-famille ////////////////////////////*/
if ($etat) {
	try {
		$stmt = $cxn->prepare ( " SELECT email FROM membre_famille WHERE code_famille=:param " );
		$param = $code_membre;
		$stmt->bindParam ( ':param', $param );
		$stmt->execute ();
		$enregistrement = $stmt->fetch ();
		$email = $enregistrement ['email'];
	} catch ( Exception $e ) {
		$etat = FALSE;
		echo "Une erreur est survenue lors de la récupération des données";
	}
}


/* * ********* creation mot de passe et envoi un mail au client ********************** */
if ($etat) {
	$mot_passe = generer_code_client ( random ( 6 ) );
	$mot_passe_crypte = md5 ( $mot_passe );
	try {
		$sql = " UPDATE  membre_famille SET mot_passe='" . $mot_passe_crypte . "'  WHERE code_famille='" . $code_membre . "' ";
		$select = $cxn->query ( $sql );
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'la requette N UPDATE  dans la table membre_famille a echoué';
	}
}
/* * ************* envoi mail ******** */
if ($etat) {
	$entetedate = date ( "D, j M Y H:i:s -0600" ); // Offset horaire
	$headers = "From: \"espacefamille@mega-cours.fr\"<espacefamille@mega-cours.fr>\n";
	$headers .= "Reply-To: espacefamille@mega-cours.fr\n";
	$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
	$message = "<html>";	
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
	}
}
/**
 * ******************************
 */

$objet ['message'] = array (
		'reponse' => $etat 
);
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>
