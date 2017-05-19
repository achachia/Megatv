<?php

function liste_chaines() {
	global $cxn;
	$liste = array ();
	$sql = "SELECT  id,nom FROM ChainesTv    WHERE active='1' ";
	$resultat = $cxn->prepare ( $sql );
	$resultat->execute ();
	$i = 0;
	while ( $enregistrement = $resultat->fetch () ) {
		$liste [$i]['nom'] = $enregistrement ['nom']; 
                $liste [$i]['id'] = $enregistrement ['id']; 
		$i ++;
	}
	return $liste;
}

?>

