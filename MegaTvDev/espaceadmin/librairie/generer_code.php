<?php

function random($car) {
	$string = "";
	$chaine = "0123456789";
	srand((double) microtime() * 1000000);
	for ($i = 0; $i < $car; $i++) {
		$string .= $chaine[rand() % strlen($chaine)];
	}
	return $string;
}
function random1($car) {
	$string = "";
	$chaine = "123456789";
	srand((double) microtime() * 1000000);
	for ($i = 0; $i < $car; $i++) {
		$string .= $chaine[rand() % strlen($chaine)];
	}
	return $string;
}
function random2($car) {
	$string = "";
	$chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	srand ( ( double ) microtime () * 1000000 );
	for($i = 0; $i < $car; $i ++) {
		$string .= $chaine [rand () % strlen ( $chaine )];
	}
	return $string;
}

function generer_code_client_passe($chaine) {
	global $cxn;
	$agent = '';
	$chaine_crypte = md5($chaine);
	while ($agent == '') {
		try {
			// On envois la requète
			$select = $cxn->query(" SELECT id_famille FROM membre_famille  WHERE mot_passe='" . $chaine_crypte . "'  ");
		} catch (Exception $e) {
			echo "Une erreur est survenue lors de la récupération des données";
			$objet['message_debug'][] = 'la requette N°1 SELECT  dans la table membre_famille a echoué';
		}
		$nb = $select->rowCount();
		if ($nb > 0) {
			$chaine = random(6);
		} else {
			$agent = 'true';
		}
	}
	return $chaine;
}
function generer_code_user($chaine) {
	global $cxn;
	$agent = '';
	while ($agent == '') {
		try {	
		       $select = $cxn->query(" SELECT *  FROM ClientsMateriel  WHERE code_client='" . $chaine . "'  ");
		} catch (Exception $e) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		$nb = $select->rowCount();
		if ($nb > 0) {
			$chaine = random2(6);
		} else {
			$agent = 'true';
		}
	}
	return $chaine;
}

function generer_code_intervention($chaine) {
	global $cxn;
	$agent = '';
	while ($agent == '') {
		try {
			// On envois la requète
			$select = $cxn->query(" SELECT reference FROM interventions  WHERE reference='" . $chaine . "'  ");
		} catch (Exception $e) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		$nb = $select->rowCount();
		if ($nb > 0) {
			$chaine = random(6);
		} else {
			$agent = 'true';
		}
	}
	return $chaine;
}
function generer_code_facture($chaine) {
	global $cxn;
	$agent = '';
	while ($agent == '') {
		try {
			// On envois la requète
			$select = $cxn->query(" SELECT id_facture FROM facture_famille  WHERE N_facture='" . $chaine . "'  ");
		} catch (Exception $e) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		$nb = $select->rowCount();
		if ($nb > 0) {
			$chaine = random(6);
		} else {
			$agent = 'true';
		}
	}
	return $chaine;
}
function generer_code_acompte($chaine) {
	global $cxn;
	$agent = '';
	while ($agent == '') {
		try {	
			$select = $cxn->query(" SELECT id_acompte FROM acompte  WHERE N_acompte='" . $chaine . "'  ");
		} catch (Exception $e) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		$nb = $select->rowCount();
		if ($nb > 0) {
			$chaine = random(6);
		} else {
			$agent = 'true';
		}
	}
	return $chaine;
}
function generer_code_encaissement($chaine) {
	global $cxn;
	$agent = '';
	while ($agent == '') {
		try {
			$select = $cxn->query(" SELECT 	id_encaissement FROM liste_encaissements  WHERE code_encaissement='" . $chaine . "'  ");
			$nb = $select->rowCount();
			if ($nb > 0) {
				$chaine = random(6);
			} else {
				$agent = 'true';
			}
		} catch (Exception $e) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
	
	}
	return $chaine;
}
function verification_code($chaine) {
	global $cxn;
	$agent = '';
	while ( $agent == '' ) {
		try {
			// On envois la requète
			$select = $cxn->query ( "SELECT id_coupon FROM e_coupon  WHERE code_coupon='" . $chaine . "' " );
				
			// On indique que nous utiliserons les résultats en tant qu'objet
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la récupération des données";
			$objet ['message_debug'] [] = 'la requette N°6  SELECT   dans la table e_coupon  a echoué';
		}
		$nb = $select->rowCount ();
		if ($nb > 0) {
			$chaine = random1 ( 10 );
		} else {
			$agent = 'true';
		}
	}
	return $chaine;
}


?>
