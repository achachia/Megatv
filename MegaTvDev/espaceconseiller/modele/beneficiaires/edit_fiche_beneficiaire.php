<?php

function infos_beneficiaire($code_beneficiaire) {
    global $cxn;
    $infos = array();
    try {     
        $sql =  " SELECT eleve_famille.tel_portable,eleve_famille.email,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve  ";
        $sql .= " ,eleve_famille.date_naissance,eleve_famille.niveau_peda,eleve_famille.date_inscription";
        $sql .= " ,eleve_famille.adresse,eleve_famille.adresse_suite,eleve_famille.code_postale,eleve_famille.ville,eleve_famille.pays";
        $sql .= " ,eleve_famille.tel_fixe,eleve_famille.site_web,eleve_famille.infos_interne,eleve_famille.infos_intervenant ";
        $sql .= " FROM eleve_famille";    
        //$sql .= " WHERE liste_niveau_option.id_option=eleve_famille.niveau_peda ";
        //$sql .= " AND liste_niveau_option.id_organisme=liste_organisme_niveau.id_liste";
        $sql .= " WHERE eleve_famille.code_eleve=:param ";
        //echo $sql;
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $code_beneficiaire);
        $resultat->execute();
        $enregistrement = $resultat->fetch();        
        $infos['nom'] = html_entity_decode($enregistrement['nom_eleve']);
        $infos['prenom'] = html_entity_decode($enregistrement['prenom_eleve']);
        $infos['identite_beneficiaire'] = $infos['nom'].'.'.$infos['prenom'];
        $infos['date_naissance'] = html_entity_decode($enregistrement['date_naissance']);
        $infos['date_adhesion'] = html_entity_decode($enregistrement['date_inscription']);
        $infos['adresse'] = html_entity_decode($enregistrement['adresse']);
        $infos['adresse_suite'] = html_entity_decode($enregistrement['adresse_suite']);
        $infos['code_postale'] = html_entity_decode($enregistrement['code_postale']);
        $infos['ville'] = html_entity_decode($enregistrement['ville']);
        $infos['pays'] = html_entity_decode($enregistrement['pays']);
        $infos['tel_portable'] = html_entity_decode($enregistrement['tel_portable']) ;
        $infos['tel_fixe'] = html_entity_decode($enregistrement['tel_fixe']);
        $infos['email'] = html_entity_decode($enregistrement['email']);        
        $infos['site_web'] = html_entity_decode($enregistrement['site_web']);
        $infos['infos_interne'] = html_entity_decode($enregistrement['infos_interne']);
        $infos['infos_intervenant'] = html_entity_decode($enregistrement['infos_intervenant']);
        $infos['id_option'] = html_entity_decode($enregistrement['niveau_peda']);     
        try {
		        $sql = "SELECT * FROM dispo_hebdo_eleve WHERE code_eleve=:param ";
				$resultat = $cxn->prepare ( $sql );
				$resultat->bindParam ( ':param', $code_beneficiaire );		
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
        } catch (Exception $ex) {
             echo "Une erreur est survenue lors de la récupération des données";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données3";
        //echo $e->getMessage();
    }
    return $infos;
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