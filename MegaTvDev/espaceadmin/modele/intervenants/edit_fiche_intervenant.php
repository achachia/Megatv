<?php

// modele
function infos_intervenant($code_intervenant) {
	global $cxn;
	$infos = array ();
	try {
		$sql =  "  SELECT intervenants.fax,intervenants.n_compte,intervenants.cle_rib,intervenants.guichet AS code_guichet,intervenants.banque AS code_banque,intervenants.numero_sec_sc,intervenants.nationalite,liste_sex.id_sex,intervenants.civilite,intervenants.nom,intervenants.prenom,CONCAT(intervenants.nom, '.',intervenants.prenom) AS identite_intervenant,intervenants.code_intervenant ";
		$sql .= " ,DATE_FORMAT(intervenants.date_naissance,'%d/%m/%Y') AS date_naissance,DATE_FORMAT(intervenants.Date_adhesion,'%d/%m/%Y') AS date_adhesion ";
		$sql .= " ,intervenants.adresse,intervenants.adresse_suite,intervenants.CP,intervenants.ville,intervenants.pays ";
		$sql .= "  ,intervenants.tel_fixe,intervenants.tel_portable,intervenants.email,intervenants.site_web,liste_statut_intervenant.id_statut,niveau_diplomes.diplome,niveau_diplomes.id_liaison  AS id_niveau_etude   ";
		$sql .= ",intervenants.infos_interne,intervenants.infos_familles";
		$sql .= " FROM intervenants,liste_statut_intervenant,niveau_diplomes,liste_sex ";
		$sql .= " WHERE intervenants.statut=liste_statut_intervenant.id_statut ";
                $sql .= " AND intervenants.diplome=niveau_diplomes.id_liaison ";
                $sql .= " AND intervenants.sex=liste_sex.id_sex ";
		$sql .= " AND code_intervenant=:param ";             
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $code_intervenant );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['code_intervenant'] = $enregistrement ['code_intervenant'];
		$infos ['identite_intervenant'] = html_entity_decode ( $enregistrement ['identite_intervenant'] );
                $infos ['civilite'] = html_entity_decode ( $enregistrement ['civilite'] );
                $infos ['nom'] = html_entity_decode ( $enregistrement ['nom'] );
		$infos ['prenom'] = html_entity_decode ( $enregistrement ['prenom'] );
                $infos ['id_sex'] = html_entity_decode ( $enregistrement ['id_sex'] );		
                $infos ['nationalite'] = html_entity_decode ( $enregistrement ['nationalite'] );
                $infos['id_statut'] = html_entity_decode($enregistrement['id_statut']);
                $infos ['adresse'] = html_entity_decode ( $enregistrement ['adresse'] );
		$infos ['adresse_suite'] = html_entity_decode ( $enregistrement ['adresse_suite'] );
                $infos ['code_postale'] = html_entity_decode ( $enregistrement ['CP'] );
                $infos ['ville'] = html_entity_decode ( $enregistrement ['ville'] );
		$infos ['pays'] = html_entity_decode ( $enregistrement ['pays'] );
                $infos ['date_naissance'] = html_entity_decode ( $enregistrement ['date_naissance'] );
                $infos['tel_fixe'] = html_entity_decode($enregistrement['tel_fixe']);
                $infos['tel_portable'] = html_entity_decode($enregistrement['tel_portable']);
                $infos['fax'] = html_entity_decode($enregistrement['fax']);
                $infos['email'] = html_entity_decode($enregistrement['email']);
		$infos['site_web'] = html_entity_decode($enregistrement['site_web']);
                $infos ['date_adhesion'] = html_entity_decode ( $enregistrement ['date_adhesion'] );
                $infos ['numero_sec_sc'] = html_entity_decode ( $enregistrement ['numero_sec_sc'] );
		$infos ['code_banque'] = html_entity_decode ( $enregistrement ['code_banque'] );
                $infos ['code_guichet'] = html_entity_decode ( $enregistrement ['code_guichet'] );
                $infos ['cle_rib'] = html_entity_decode ( $enregistrement ['cle_rib'] );
                $infos ['n_compte'] = html_entity_decode ( $enregistrement ['n_compte'] ); 
                $infos['id_niveau_etude'] = html_entity_decode($enregistrement['id_niveau_etude']);
                
                
                
                 
                

                
		
		
		
		
		
		
		
	        //$infos['infos_interne'] = ($enregistrement['infos_interne']!=NULL)? html_entity_decode($enregistrement['infos_interne']) : '-------------------------------';
	        //$infos['infos_famille'] = ($enregistrement['infos_familles']!=NULL)? html_entity_decode($enregistrement['infos_familles']) : '-------------------------------';
    	       
	       // $infos['diplome'] = ($enregistrement['diplome']!=NULL)? html_entity_decode($enregistrement['diplome']) : '-------------------------------';

                try {
			$sql = "SELECT * FROM dispo_hebdo_intervenant WHERE code_intervenant=:param ";
			$resultat = $cxn->prepare ( $sql );
			$resultat->bindParam ( ':param', $code_intervenant );
			$resultat->execute ();
			$j = 0;
			while ( $enregistrement = $resultat->fetch () ) {
				$periode = $enregistrement ['periode'];
				$infos ['diponibilite'] [$periode] ['lundi'] = $enregistrement ['lundi'];
				$infos ['diponibilite'] [$periode] ['mardi'] = $enregistrement ['mardi'];
				$infos ['diponibilite'] [$periode] ['mercredi'] = $enregistrement ['mercredi'];
				$infos ['diponibilite'] [$periode] ['jeudi'] = $enregistrement ['jeudi'];
				$infos ['diponibilite'] [$periode] ['vendredi'] = $enregistrement ['vendredi'];
				$infos ['diponibilite'] [$periode] ['samedi'] = $enregistrement ['samedi'];
				$infos ['diponibilite'] [$periode] ['dimanche'] = $enregistrement ['dimanche'];
				$j ++;
			}
		} catch ( Exception $ex ) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}
function liste_zone() {
	global $cxn;
	$liste = array ();
	try {
		// requete prepare
		$sql = " SELECT  id_intercommunalite,nom FROM  liste_intercommunalités ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$nom_intercommunalite = $enregistrement ['nom'];
			$id_intercommunalite = $enregistrement ['id_intercommunalite'];
			$sql1 = " SELECT nom AS nom_commune,code_postale  FROM liste_commune WHERE id_intercommunalite='" . $id_intercommunalite . "' ";
			$resultat1 = $cxn->query ( $sql1 );
			while ( $enregistrement1 = $resultat1->fetch () ) {
				$liste [$nom_intercommunalite] ['code_postale'] = $enregistrement1 ['code_postale'];
				$liste [$nom_intercommunalite] ['nom_commune'] = $enregistrement1 ['nom_commune'];
			}
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_niveau() {
	global $cxn;
	$liste = array ();
	try {
		// requete prepare
		$sql = " SELECT   id_liste,organisme,niveau FROM  liste_organisme_niveau ORDER BY ordre_affichage ASC ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id_liste'];
			$value = $enregistrement ['niveau'] . "[" . $enregistrement ['organisme'] . "]";
			$liste [$key] = $value;
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_matiere() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT  id,nom FROM  liste_matiere ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id'];
			$value = $enregistrement ['nom'];
			$liste [$key] = $value;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_sex() {
	global $cxn;
	$liste = array ();
	try {
		// requete prepare
		$sql = " SELECT   id_sex,nom_sex  FROM  liste_sex  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id_sex'];
			$value = $enregistrement ['nom_sex'];
			$liste [$key] = $value;
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_statut() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT   id_statut,nom_statut  FROM  liste_statut_intervenant  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id_statut'];
			$value = $enregistrement ['nom_statut'];
			$liste [$key] = $value;
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_diplomes() {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT   id_liaison,diplome  FROM  niveau_diplomes  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$key = $enregistrement ['id_liaison'];
			$value = $enregistrement ['diplome'];
			$liste [$key] = $value;
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_interv_matiere($code_intervenant) {
	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT DISTINCT (matiere) AS id_matiere FROM  intervenant_matiere WHERE code_intervenant=:param  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param', $code_intervenant );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {			
			$liste [$i] = $enregistrement ['id_matiere'];
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function liste_niveau_matiere_intervenant($code_intervenant,$id_matiere){
    	global $cxn;
	$liste = array ();
	try {
		$sql = " SELECT DISTINCT (niveau) AS id_niveau FROM  intervenant_matiere WHERE code_intervenant=:param1 AND matiere=:param2  ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param1', $code_intervenant );
                $resultat->bindParam ( ':param2', $id_matiere );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {			
			$liste [$i] = $enregistrement ['id_niveau'];
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}

?>
