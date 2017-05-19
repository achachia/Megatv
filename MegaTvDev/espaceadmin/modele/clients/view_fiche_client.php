<?php

// modele
function infos_client($code_client) {
	global $cxn;
	$infos = array ();
	try {
		$sql = " SELECT  ClientsMateriel.code_client,ClientsMateriel.civilite,ClientsMateriel.date_adhesion,ClientsMateriel.nom,ClientsMateriel.prenom,ClientsMateriel.adresse,ClientsMateriel.code_postale,ClientsMateriel.ville,ClientsMateriel.tel,ClientsMateriel.email,ListePays.nom AS nom_pays FROM ClientsMateriel,ListePays  WHERE ClientsMateriel.pays=ListePays.id_pays AND code_client=:param  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $code_client );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['code_client'] = $enregistrement ['code_client'];
                $infos ['civilite'] = $enregistrement ['civilite'];
                $infos ['date_adhesion'] = $enregistrement ['date_adhesion'];
		$infos ['nom_client'] = html_entity_decode ( $enregistrement ['nom'] );
		$infos ['prenom_client'] = html_entity_decode ( $enregistrement ['prenom'] );
		$infos ['adresse'] = html_entity_decode ( $enregistrement ['adresse'] );
		$infos ['code_postale'] = html_entity_decode ( $enregistrement ['code_postale'] );
		$infos ['ville'] = html_entity_decode ( $enregistrement ['ville'] );
                $infos ['pays'] = $enregistrement ['nom_pays'];
		$infos ['tel_portable'] = $enregistrement ['tel'];	
		$infos ['email'] = $enregistrement ['email'];	
		
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}


?>