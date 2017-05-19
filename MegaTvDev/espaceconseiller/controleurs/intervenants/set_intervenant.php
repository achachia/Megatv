<?php
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
ini_set('date.timezone', 'Europe/Paris'); 
$etat = TRUE;
$objet = array ();
$sql_array = array ();
$jour_array = [ 
		'lundi' => '1',
		'mardi' => '2',
		'mercredi' => '3',
		'jeudi' => '4',
		'vendredi' => '5',
		'samedi' => '6',
		'dimanche' => '7' 
];
$periode_array = [ 
		'periode1' => 'matin',
		'periode2' => '13h-14h',
		'periode3' => '14h-15h',
		'periode4' => '15h-16h',
		'periode5' => '16h-17h',
		'periode6' => '17h-18h',
		'periode7' => '18h-19h',
		'periode8' => '19h-20h' 
];
$nom = unhtmlentities ( $_POST ['nom_intervenant'] );
$prenom = unhtmlentities ( $_POST ['prenom_intervenant'] );
$civilite = unhtmlentities ( $_POST ['civilite'] );
$sex = unhtmlentities ( $_POST ['sex'] );
$date_naissance = unhtmlentities ( $_POST ['date_naissance'] );
$nationalite = unhtmlentities ( $_POST ['nationalite'] );
$numero_sec_sc = unhtmlentities ( $_POST ['n_s_c'] );
$tel_fixe = unhtmlentities ( $_POST ['tel_domicile'] );
$tel_portable = unhtmlentities ( $_POST ['tel_portable'] );
$fax = unhtmlentities ( $_POST ['fax'] );
$adresse = unhtmlentities ( $_POST ['adresse'] );
$adresse_suite = unhtmlentities ( $_POST ['adresse_suite'] );
$code_postale = unhtmlentities ( $_POST ['cp'] );
$ville = unhtmlentities ( $_POST ['ville'] );
$pays = unhtmlentities ( $_POST ['pays'] );
$site_web = unhtmlentities ( $_POST ['site_web'] );
$banque = unhtmlentities ( $_POST ['code_banque'] );
$guichet = unhtmlentities ( $_POST ['code_guichet'] );
$n_compte = unhtmlentities ( $_POST ['n_compte'] );
$cle_rib = unhtmlentities ( $_POST ['cle_rib'] );
$email = unhtmlentities ( $_POST ['email'] );
$diplome = unhtmlentities ( $_POST ['id_niveau_diplome'] );
$statut = unhtmlentities ( $_POST ['statut'] );
$date_adhesion = unhtmlentities ( $_POST ['date_adhesion'] );
$infos_interne = unhtmlentities ( $_POST ['infos_interne'] );
$infos_familles = unhtmlentities ( $_POST ['infos_familles'] );
$date_creation = date ( "Y-m-d H:i:s" );

/**
 * ******************* Les controles *******************************
 */
if ($statut == '' || $nom == '' || $prenom == '' || $civilite == '' || $adresse == '' || $code_postale == '' || $ville == '' || $email == '' || $date_adhesion == '' || $sex == '' || $date_naissance == '' || $nationalite == '' || $numero_sec_sc == '' || $adresse == '' || $code_postale == '' || $ville == '' || $pays == '' || $banque == '' || $guichet == '' || $cle_rib == '' || $n_compte == '' || $diplome == '' || ! isset ( $_POST ['zone_intervention'] )) {
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
	if ($sex == '') {
		$objet ['message_erreur'] [] = 'Le champ sex ne doit pas etre vide';
	}
	if ($date_naissance == '') {
		$objet ['message_erreur'] [] = 'Le champ date naissance ne doit pas etre vide';
	}
	if ($nationalite == '') {
		$objet ['message_erreur'] [] = 'Le champ nationalite ne doit pas etre vide';
	}
	if ($numero_sec_sc == '') {
		$objet ['message_erreur'] [] = 'Le champ numero de securite sociale ne doit pas etre vide';
	}
	if ($adresse == '') {
		$objet ['message_erreur'] [] = 'Le champ adresse ne doit pas etre vide';
	}
	if ($code_postale == '') {
		$objet ['message_erreur'] [] = 'Le champ code postale ne doit pas etre vide';
	}
	if ($ville == '') {
		$objet ['message_erreur'] [] = 'Le champ ville ne doit pas etre vide';
	}
	if ($pays == '') {
		$objet ['message_erreur'] [] = 'Le champ pays ne doit pas etre vide';
	}
	if ($banque == '') {
		$objet ['message_erreur'] [] = 'Le champ code banque ne doit pas etre vide';
	}
	if ($n_compte == '') {
		$objet ['message_erreur'] [] = 'Le champ numero de compte ne doit pas etre vide';
	}
	if ($guichet == '') {
		$objet ['message_erreur'] [] = 'Le champ code guichet ne doit pas etre vide';
	}
	if ($cle_rib == '') {
		$objet ['message_erreur'] [] = 'Le champ cle de RIB ne doit pas etre vide';
	}
	if ($diplome == '') {
		$objet ['message_erreur'] [] = 'Le champ diplome ne doit pas etre vide';
	}
	if (sizeof ( $_POST ['zone_intervention'] )) {
		// $objet ['message_erreur'] [] = 'Le champ zone intervention ne doit pas etre vide'.sizeof ($_POST ['zone_intervention']);
	}
	$objet ['message_erreur'] [] = 'Le champ zone intervention  ne doit pas etre vide' . sizeof ( $_POST ['zone_intervention'] );
	$etat = FALSE;
	$objet ['message_debug'] [] = 'les champs ne devront pas etre vide';
}
if ($tel_fixe == '' && $tel_portable == '') {
	$etat = FALSE;
	$objet ['message_debug'] [] = 'les champs tel_fixe et tel tel_portable et tel travail ne devra pas etre vide les deux en meme temps';
}
/**
 * **************** verification adresse email ************
 */
if ($email != '') {
	$control_interne = true;
	if (! preg_match ( "$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $email )) {
		$etat = FALSE;
		$control_interne = false;
		$objet ['message_debug'] [] = 'Le format de adresse e-mail n\'pas valide';
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
			$objet ['message_debug'] [] = 'il existe une personne qui possede le meme mail';
			$objet ['message_erreur'] [] = 'il existe une personne qui possede le meme mail ';
		}
	}
}
/**
 * ******************** verification nom et prenom ***********************
 */
if ($nom != '' && $prenom != '') {
	try {
		$select = $cxn->query ( " SELECT nom,prenom  FROM membre_famille WHERE nom='" . $nom . "' AND  prenom='" . $prenom . "'  UNION  SELECT nom,prenom  FROM intervenants   WHERE nom='" . $nom . "' AND  prenom='" . $prenom . "'  UNION  SELECT nom,prenom  FROM eleve_famille WHERE nom='" . $nom . "' AND  prenom='" . $prenom . "' " );
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	$nb = $select->rowCount ();
	if ($nb > 0) {
		$etat = FALSE;
		$objet ['message_debug'] [] = 'il existe une personne qui possede le meme nom et prenom  ';
		$objet ['message_erreur'] [] = 'il existe une personne qui possede le meme nom et prenom ';
	}
}
/**
 * ***************** verification code postale *********************
 */
if (! preg_match ( '/^([0-9]{5})$/', $code_postale ) && $code_postale != '') {
	$etat = FALSE;
	$objet ['message_debug'] [] = 'le format de code postale est non valide  ';
	$objet ['message_erreur'] [] = 'le format de code postale est non valide ';
}
/**
 * *************** verification Numero tel portable ****************************
 */
if ($tel_portable != '') {
	$tel_portable = ereg_replace ( "[^0-9]", "", $tel_portable ); // formater le format de tel 01-52-54-52  =>  01525452
	if (!preg_match ( '/^0[6-7][0-9]{8}$/', $tel_portable )) {
		$etat = FALSE;
		$objet ['message_debug'] [] = 'le format de numero telephone portable est non valide  ';
		$objet ['message_erreur'] [] = 'le format de numero telephone portable est non valide ';
	}
}

/**
 * *************** verification Numero tel fixe ****************************
 */
if ($tel_fixe != '') {
	$tel_fixe = ereg_replace ( "[^0-9]", "", $tel_fixe ); // formater le format de tel 01-52-54-52  =>  01525452
	if (! preg_match ( '/^0[1-59][0-9]{8}$/', $tel_fixe )) {		
		$etat = FALSE;
		$objet ['message_debug'] [] = 'le format de numero telephone fixe est non valide  ';
		$objet ['message_erreur'] [] = 'le format de numero telephone fixe est non valide ';
	}
}

/**
 * ************** Insertion les informations de l'intervenant ************
 */
if ($etat) {
	try {
		$sql = " INSERT INTO intervenants (nom,prenom,civilite,sex,date_naissance,nationalite,numero_sec_sc,tel_fixe,tel_portable,fax,adresse,adresse_suite,CP,ville,pays,site_web,banque,guichet,n_compte,cle_rib,email,diplome,statut,Date_adhesion,infos_interne,infos_familles,date_creation) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11,:param12,:param13,:param14,:param15,:param16,:param17,:param18,:param19,:param20,:param21,:param22,:param23,:param24,:param25,:param26,:param27) ";
		$stmt = $cxn->prepare ( $sql );
		// insertion d'une ligne
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
		$stmt->bindParam ( ':param21', $param21 );
		$stmt->bindParam ( ':param22', $param22 );
		$stmt->bindParam ( ':param23', $param23 );
		$stmt->bindParam ( ':param24', $param24 );
		$stmt->bindParam ( ':param25', $param25 );
		$stmt->bindParam ( ':param26', $param26 );
		$stmt->bindParam ( ':param27', $param27 );
		$param1 = $nom;
		$param2 = $prenom;
		$param3 = $civilite;
		$param4 = $sex;
		$param5 = $date_naissance;
		$param6 = $nationalite;
		$param7 = $numero_sec_sc;
		$param8 = $tel_fixe;
		$param9 = $tel_portable;
		$param10 = $fax;
		$param11 = $adresse;
		$param12 = $adresse_suite;
		$param13 = $code_postale;
		$param14 = $ville;
		$param15 = $pays;
		$param16 = $site_web;
		$param17 = $banque;
		$param18 = $guichet;
		$param19 = $n_compte;
		$param20 = $cle_rib;
		$param21 = $email;
		$param22 = $diplome;
		$param23 = $statut;
		$param24 = $date_adhesion;
		$param25 = $infos_interne;
		$param26 = $infos_familles;
		$param27 = $date_creation;
		$stmt->execute ();
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'la requette INSERT  dans la table membre_famille a echoué';
	}
}

/**
 * ****************** Chercher la valeur de id_intervenant **************
 */
if ($etat) {
	try {
		$stmt = $cxn->prepare ( " SELECT id_intervenant FROM intervenants WHERE email=:param " );
		$stmt->bindParam ( ':param', $param );
		$param = $email;
		$stmt->execute ();
		$enregistrement = $stmt->fetch ();
		$id_intervenant = $enregistrement ['id_intervenant'];
	} catch ( Exception $e ) {
		$etat = FALSE;
		$objet ['message_debug'] [] = 'la requette SELECT  dans la table intervenant a echoué';
	}
}

/**
 * ********************** Mettre a jour le code intervenant*******************
 */
if ($etat) {
	$code = 'CI' . $id_intervenant;
	try {
		$sql = " UPDATE  intervenants SET code_intervenant='" . $code . "'  WHERE email='" . $email . "' ";
		$select = $cxn->query ( $sql );
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'la requette UPDATE  dans la table intervenants a echoué';
	}
}

/**
 * ******************** Insertion les matieres et les niveaux associe d'intervenant **************
 */
if ($etat) {
	try {
		$control = true;
		$i = 1;
		$matiere = 'matiere1';
		$niveau = 'niveau1';
		while ( $control ) {
			if (isset ( $_POST [$matiere] ) && isset ( $_POST [$niveau] ) && ! empty ( $_POST [$matiere] ) && ! empty ( $_POST [$niveau] )) {
				foreach ( $_POST [$niveau] as $value ) {
					$sql = "INSERT INTO intervenant_matiere(code_intervenant,matiere,niveau) VALUES (:param1,:param2,:param3)";
					$stmt = $cxn->prepare ( $sql );
					$stmt->bindParam ( ':param1', $param1 );
					$stmt->bindParam ( ':param2', $param2 );
					$stmt->bindParam ( ':param3', $param3 );
					$param1 = $code;
					$param2 = $_POST [$matiere];
					$param3 = $value;
					$stmt->execute ();
				}
				$i ++;
				$matiere = 'matiere' . $i;
				$niveau = 'niveau' . $i;
			} else {
				$control = false;
			}
		}
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'la requette INSERT  dans la table intervenant_matiere a echoué';
	}
}

/**
 * ********* creation mot de passe de client **********************
 */
if ($etat) {
	require './../../librairie/generer_code.php';
	$mot_passe = generer_code_intervenant ( random ( 6 ) );
	$mot_passe_crypte = md5 ( $mot_passe );
	try {
		$sql = " UPDATE  intervenants SET mot_passe='" . $mot_passe_crypte . "'  WHERE email='" . $email . "' ";
		$select = $cxn->query ( $sql );
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'la requette UPDATE  dans la table membre_famille a echoué';
	}
}

/**
 * ***************************** traitement les zones interventions ***********
 */

if ($etat) {
	try {
		foreach ( $_POST ['zone_intervention'] as $value ) {
			$sql = "INSERT INTO intervenant_zone(code_postale,code_intervenant) VALUES (:param1,:param2)";
			$stmt = $cxn->prepare ( $sql );
			$stmt->bindParam ( ':param1', $param1 );
			$stmt->bindParam ( ':param2', $param2 );
			$param1 = $value;
			$param2 = $code;
			$stmt->execute ();
		}
	} catch ( Exception $e ) {
		echo $e->getMessage ();
		$etat = FALSE;
		$objet ['message_debug'] [] = 'la requette INSERT  dans la table intervenant_zone a echoué';
	}
}

/**
 * ************* traitement les disponibilite de l'intervenant ********************
 */
/**
 * *********** 1.
 * preparation les requettes SQL ****************
 */
if ($etat) {
	foreach ( $periode_array as $key => $value ) {
		$req2 = "";
		$req1 = "INSERT  INTO dispo_hebdo_intervenant   ";
		$req1 .= "(periode,";
		$req2 .= "('" . $periode_array [$key] . "', ";
		if (isset ( $_POST [$key] )) {
			foreach ( $jour_array as $value ) {
				if (in_array ( $value, $_POST [$key] )) {
					$jour = array_search ( $value, $jour_array );
					$req1 .= $jour . ",";
					$req2 .= "'1',";
				} else {
					$jour = array_search ( $value, $jour_array );
					$req1 .= $jour . ",";
					$req2 .= "'0',";
				}
			}
		} else {
			foreach ( $jour_array as $value ) {
				$jour = array_search ( $value, $jour_array );
				$req1 .= $jour . ",";
				$req2 .= "'0',";
			}
		}
		$req1 .= "code_intervenant)";
		$req2 .= " :param )";
		$sql = $req1 . " VALUE " . $req2;
		$sql_array [] = $sql;
	}
}

/**
 * ************ 2.
 * Excution les requettes SQL *************
 */
if ($etat) {
	foreach ( $sql_array as $value ) {
		try {
			$stmt = $cxn->prepare ( $value );
			$stmt->bindParam ( ':param', $code_intervenant );
			$code_intervenant = $code;
			$stmt->execute ();
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la r�cup�ration des donn�es";
			$etat = FALSE;
		}
	}
}

/**
 * ************* envoi mail *********************
 */
if ($etat) {
	$entetedate = date ( "D, j M Y H:i:s -0600" ); // Offset horaire
	$headers = "From: \"espaceprof@mega-cours.fr\"<espaceprof@mega-cours.fr>\n";
	$headers .= "Reply-To: espaceprof@mega-cours.fr\n";
	$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
	$message = "<html>";
	$message .= "<titre>Votre identifiant de connexion &agrave;� l'espace professeur </titre>";
	$message .= "<head></head>";
	$message .= "<body>Bonjour,<br/>";
	$message .= "Voici les informations vous permettant de vous identifier sur votre Espace professeur de mega-cours,<br/>";
	$message .= "Votre e-mail : " . $email . " <br/>";
	$message .= "Votre mot de passe : " . $mot_passe . " <br/><br/>";
	$message .= "Pour vous connecter,<br/>";
	$message .= "veuillez utiliser le lien ci-dessous : <br/>";
	$message .= "<a href = 'http://www.espacefamille.mega-cours.fr/' >http://www.espacefamille.mega-cours.fr</a><br/><br/>";
	$message .= " Pour rappel dans cet espace qui vous est r&eacute;serv&eacute;, vous pourrez notamment :,<br/>";
	$message .= " - editer les comptes-rendus<br/>";
	$message .= " - valider vos coupons<br/>";
	$message .= " - acc&eacute;der &agrave;� une base de supports p&eacute;dagogiques.<br/>";
	$message .= "Bonne d&eacute;couverte et utilisation.<br/>";
	$message .= "Mega-cours.";
	if (! mail ( $email, "Votre identifiant de connexion � l'espace professeur", $message, $headers )) {
		$etat = FALSE;
		$objet ['message_debug'] [] = "desole l'inscrption a echou&agrave;.";
	}
}

/**
 * ********************************
 */
$objet ['message'] = array (
		'reponse' => $etat 
);
header ( 'Content-type: application/json' );
echo json_encode ( $objet );
?>
