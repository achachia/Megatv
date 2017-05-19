<?php

// modele
function infos_client($code_client) {
	global $cxn;
	$infos = array ();
	try {
		$sql = " SELECT  membre_famille.code_parrain,membre_famille.site_web,membre_famille.infos_interne,membre_famille.infos_intervenants,membre_famille.email,membre_famille.telephone_fixe,membre_famille.telephone_portable,membre_famille.telephone_travail,membre_famille.fax,membre_famille.code_postale,membre_famille.ville,membre_famille.statut,membre_famille.civilite,membre_famille.code_famille AS code_famille,membre_famille.adresse,membre_famille.adresse_suite,membre_famille.Date_adhesion AS Date_adhesion,membre_famille.code_famille,membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille,conseiller_peda.nom AS nom_conseiller,conseiller_peda.prenom AS prenom_conseiller FROM membre_famille,famille_conseiller,conseiller_peda WHERE membre_famille.code_famille=famille_conseiller.code_famille AND famille_conseiller.code_conseiller=conseiller_peda.code_conseiller  AND membre_famille.code_famille=:param ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $code_client );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['civilite'] = $enregistrement ['civilite'];
		$infos ['statut'] = $enregistrement ['statut'];
		$infos ['code_famille'] = $enregistrement ['code_famille'];
		$infos ['nom_famille'] = html_entity_decode ( $enregistrement ['nom_famille'] );
		$infos ['prenom_famille'] = html_entity_decode ( $enregistrement ['prenom_famille'] );
		$infos ['adresse'] = html_entity_decode ( $enregistrement ['adresse'] );
		$infos ['code_postale'] = html_entity_decode ( $enregistrement ['code_postale'] );
		$infos ['ville'] = html_entity_decode ( $enregistrement ['ville'] );
		$infos ['adresse_suite'] = html_entity_decode ( $enregistrement ['adresse_suite'] );
		$infos ['fax'] = $enregistrement ['fax'];
		$infos ['tel_fixe'] = $enregistrement ['telephone_fixe'];
		$infos ['tel_portable'] = $enregistrement ['telephone_portable'];
		$infos ['tel_travail'] = $enregistrement ['telephone_travail'];
		$infos ['email'] = $enregistrement ['email'];
		$infos ['site_web'] = $enregistrement ['site_web'];
		$infos ['date_adhesion'] = $enregistrement ['Date_adhesion'];
		$infos ['infos_interne'] = html_entity_decode ( $enregistrement ['infos_interne'] );
		$infos ['infos_intervenants'] = html_entity_decode ( $enregistrement ['infos_intervenants'] );
				
		// recherche identite le parrain
		if ($enregistrement ['code_parrain'] != 'aucun') {
			$sql1 = 'SELECT nom AS nom_parrain,prenom AS prenom_parrain FROM membre_famille WHERE code_famille=:param1 ';
			$resultat1 = $cxn->prepare ( $sql1 );
			$resultat1->bindParam ( ':param1', $enregistrement ['code_parrain'] );
			$resultat1->execute ();
			$enregistrement1 = $resultat1->fetch ();
			$infos ['code_parrain'] = $enregistrement ['code_parrain'];
			$infos ['identite_parrain'] = html_entity_decode ( $enregistrement1 ['prenom_parrain'] ) . '.' . html_entity_decode ( $enregistrement1 ['prenom_parrain'] );
		} else {
			$infos ['identite_parrain'] = '-------------------';
		}
		
		// //////////////////////////
		$infos ['conseiller_attache'] = html_entity_decode ( $enregistrement ['nom_conseiller'] ) . "." . html_entity_decode ( $enregistrement ['prenom_conseiller'] );
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}
function liste_beneficiaires($code_client) {
	global $cxn;
	$liste = array ();
	try {
		
		$sql = " SELECT  eleve_famille.code_eleve AS code_benef,eleve_famille.date_inscription AS date_adhesion,eleve_famille.nom AS nom_benef,eleve_famille.prenom AS prenom_benef FROM eleve_famille WHERE eleve_famille.code_famille=:param  ORDER BY eleve_famille.date_inscription DESC ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $code_client );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['date_adhesion'] = $enregistrement ['date_adhesion'];
			$liste [$i] ['identite_benef'] = html_entity_decode ( $enregistrement ['nom_benef'] ) . "." . html_entity_decode ( $enregistrement ['prenom_benef'] );
			$liste [$i] ['code_benef'] = $enregistrement ['code_benef'];
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}

?>