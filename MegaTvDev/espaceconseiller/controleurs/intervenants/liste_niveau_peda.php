<?php
require_once './../../../connection/config.php';
$liste_niveau=array();
$liste_matiere=array();
if (isset($_POST['liste'])) {
	try {
		// requete prepare
		$sql = " SELECT   id_liste,organisme,niveau FROM  liste_organisme_niveau ORDER BY ordre_affichage ASC";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {		
			$liste_niveau[$i] ['id'] =  $enregistrement ['id_liste'];
			$liste_niveau [$i] ['nom'] = $enregistrement ['niveau'] . "[" . $enregistrement ['organisme'] . "]";
			$i++;		
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	///////////////// liste matiere ///////////////////////
	try {
		$sql = " SELECT  id,nom  FROM  liste_matiere ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i=0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste_matiere[$i] ['id'] = $enregistrement ['id'];
			$liste_matiere [$i] ['nom'] = $enregistrement ['nom'];
			$i++;		
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	
}
$objet['liste_niveau'] = $liste_niveau;
$objet['liste_matiere'] = $liste_matiere;
header('Content-type: application/json');
echo json_encode($objet);
?>