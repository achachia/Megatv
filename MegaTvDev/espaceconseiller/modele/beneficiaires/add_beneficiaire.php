<?php

// modele

function liste_clients() {
	global $cxn;
	$liste = array();
	try {
		// requete prepare
		$sql = " SELECT  membre_famille.code_famille AS code_client,CONCAT(membre_famille.nom,'.',membre_famille.prenom) AS identite_client FROM membre_famille  ";
		$resultat = $cxn->prepare($sql);
		$resultat->execute();
		$i = 0;
		while ($enregistrement = $resultat->fetch()) {
			$liste[$i]['code_client'] = $enregistrement['code_client'];
			$liste[$i]['identite_client'] = html_entity_decode($enregistrement['identite_client']);
			$i++;
		}
	} catch (Exception $e) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}


function liste_niveau_peda() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT id_option,nom_option  FROM liste_niveau_option ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['id_option'] = $enregistrement ['id_option'];
			$liste [$i] ['nom_option'] = html_entity_decode ( $enregistrement ['nom_option'] );
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}

?>
