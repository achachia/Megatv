<?php

// modele
function liste_intervenants() {
	global $cxn;
	$liste = array ();
	try {		
		$sql = " SELECT intervenants.code_intervenant,intervenants.nom AS nom_intervenant,intervenants.prenom AS prenom_intervenant FROM intervenants   ORDER BY intervenants.Date_adhesion DESC ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['identite_intervenant'] = html_entity_decode ( $enregistrement ['nom_intervenant'] ) . "." . html_entity_decode ( $enregistrement ['prenom_intervenant'] );
			$liste [$i] ['code_intervenant'] = $enregistrement ['code_intervenant'];
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $liste;
}
function infos_intervention($reference_intervention) {
	global $cxn;
	$infos = array ();
	// informations eleve
	try {
		$sql =  " SELECT interventions.sex,interventions.statut,eleve_famille.code_eleve,liste_niveau_option.id_organisme,eleve_intervenant.matiere ";
		$sql.= "  ,villes_france.ville_latitude_deg AS interv_latitude,villes_france.ville_longitude_deg AS interv_longitude  ";
                $sql .= " FROM interventions,eleve_intervenant,eleve_famille,liste_niveau_option,membre_famille,villes_france ";
		$sql .= " WHERE eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
                $sql .= " AND membre_famille.code_famille=eleve_famille.code_famille ";
                $sql .= " AND membre_famille.code_postale=villes_france.ville_code_postal ";
		$sql .= " AND interventions.reference=eleve_intervenant.reference ";
		$sql .= " AND eleve_famille.niveau_peda=liste_niveau_option.id_option ";
		$sql .= " AND interventions.reference='" . $reference_intervention . "'  ";		
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['code_eleve'] = $enregistrement ['code_eleve'];
		$infos ['niveau_peda'] = $enregistrement ['id_organisme'];
		$infos ['matiere'] = $enregistrement ['matiere'];
		$infos ['sex'] = $enregistrement ['sex'];
		$infos ['statut'] = $enregistrement ['statut'];
                $infos ['interv_latitude'] = $enregistrement ['interv_latitude'];
                $infos ['interv_longitude'] = $enregistrement ['interv_longitude'];
               // var_dump($sql);
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	// disponibilite eleve
	try {
		$periode_array = [ 
				'matin',
				'13h-14h',
				'14h-15h',
				'15h-16h',
				'16h-17h',
				'17h-18h',
				'18h-19h',
				'19h-20h' 
		];
		$Nb_dipo = 0;
		foreach ( $periode_array as $value ) {
			$jours_semaine='';
			$sql = "SELECT lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche FROM dispo_hebdo_eleve WHERE code_eleve=:param1  AND periode=:param2";
			$resultat = $cxn->prepare ( $sql );
			$resultat->bindParam ( ':param1', $param1 );
			$resultat->bindParam ( ':param2', $param2 );
			$param1 = $infos ['code_eleve'];
			$param2 = $value;
			$resultat->execute ();
			$enregistrement = $resultat->fetch ();
			if ($enregistrement ['lundi'] == '1') {
				$jours_semaine.='lundi-' ;
				$Nb_dipo ++;
			}
			if ($enregistrement ['mardi'] == '1') {
				$jours_semaine.='mardi-' ;
				$Nb_dipo ++;
			}
			if ($enregistrement ['mercredi'] == '1') {
				$jours_semaine.='mercredi-' ;
				$Nb_dipo ++;
			}
			if ($enregistrement ['jeudi'] == '1') {
				$jours_semaine.='jeudi-' ;
				$Nb_dipo ++;
			}
			if ($enregistrement ['vendredi'] == '1') {
				$jours_semaine.='vendredi-' ;
				$Nb_dipo ++;
			}
			if ($enregistrement ['samedi'] == '1') {
				$jours_semaine.='samedi-' ;
				$Nb_dipo ++;
			}
			if ($enregistrement ['dimanche'] == '1') {
				$jours_semaine.='dimanche-' ;
				$Nb_dipo ++;
			}
			if($jours_semaine!=''){
				$jours_semaine = substr ( $jours_semaine, 0, - 1 );
				$infos ['diponibilite'] [$value] =$jours_semaine;
				//echo $value.":".$jours_semaine."<br/>";
			}
					
			
		}
		$infos ['diponibilite'] ['Nb_dipo'] = $Nb_dipo;
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	//var_dump($infos);
	return $infos;
}
function liste_intervenants_prive($infos_interv) {
	global $cxn;
	$liste = array ();
	try {
		$sql = "   SELECT intervenants.code_intervenant,intervenants.nom AS nom_intervenant,intervenants.prenom AS prenom_intervenant,villes_france.ville_latitude_deg AS latitude,villes_france.ville_longitude_deg AS longitude   ";
                $sql .= "  ,6378 * acos( cos(radians(:param5)) * cos(radians(villes_france.ville_latitude_deg)) * cos (radians(villes_france.ville_longitude_deg)-radians(:param6)) + sin(radians(:param5)) * sin(radians(villes_france.ville_latitude_deg))) AS intervenant_distance ";
	        $sql .= "  FROM intervenants,villes_france,intervenant_matiere ";
		$sql .= "  WHERE  intervenant_matiere.code_intervenant=intervenants.code_intervenant ";
                $sql .= "  AND  intervenants.CP=villes_france.ville_code_postal ";
		$sql .= "  AND intervenant_matiere.niveau=:param1  AND  intervenant_matiere.matiere=:param2  AND intervenants.sex=:param3 AND intervenants.statut=:param4 ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param1', $param1 );
		$resultat->bindParam ( ':param2', $param2 );
		$resultat->bindParam ( ':param3', $param3 );
		$resultat->bindParam ( ':param4', $param4 );
                $resultat->bindParam ( ':param5', $param5 );
                $resultat->bindParam ( ':param6', $param6 );
		$param1 = $infos_interv ['niveau_peda'];
		$param2 = $infos_interv ['matiere'];
		$param3 = $infos_interv ['sex'];
		$param4 = $infos_interv ['statut'];
                $param5 =$infos_interv ['interv_latitude'];
                $param6 =$infos_interv ['interv_longitude'];
		$resultat->execute ();
		$i = 0;
		while ( $enregistrement = $resultat->fetch () ) {
			$liste [$i] ['code_intervenant'] = $enregistrement ['code_intervenant'];
			$liste [$i] ['identite_intervenant'] = html_entity_decode ( $enregistrement ['nom_intervenant'] ) . "." . html_entity_decode ( $enregistrement ['prenom_intervenant'] );
                        $liste [$i] ['intervenant_latitude'] = $enregistrement ['latitude'];
                        $liste [$i] ['intervenant_longitude'] = $enregistrement ['longitude'];
                     	$liste [$i] ['intervenant_distance']=$enregistrement ['intervenant_distance'];
                        
                    
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
        //var_dump($liste);
	return $liste;
}
function liste_disponibilite($liste_intervenants, $disponibilite_eleve) {
	global $cxn;
	$liste = array ();
	$i = 0;
	try {
		foreach ( $liste_intervenants  as  $value ) {
			$Nb_dipo = 0;
			$message='';
			foreach (  $disponibilite_eleve as $key => $value1 ) {
				$tab_jours = explode("-", $value1);
				$sql = "SELECT lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche FROM dispo_hebdo_intervenant WHERE code_intervenant=:param1  AND periode=:param2";				
				$resultat = $cxn->prepare ( $sql );
				$resultat->bindParam ( ':param1', $param1 );
				$resultat->bindParam ( ':param2', $param2 );
				$param1 = $value ['code_intervenant'];
				$param2 = $key;
				$resultat->execute ();
				$enregistrement = $resultat->fetch ();				
				if ($enregistrement ['lundi'] == '1' && in_array ( 'lundi', $tab_jours)) {
					$message.="[".$key."/lundi]-";
					$Nb_dipo ++;
				}
				if ($enregistrement ['mardi'] == '1' && in_array ( 'mardi', $tab_jours)) {
					$message.="[".$key."/mardi]-";
					$Nb_dipo ++;
				}
				if ($enregistrement ['mercredi'] == '1' && in_array ( 'mercredi', $tab_jours)) {
					$message.="[".$key."/mercredi]-";
					$Nb_dipo ++;
				}
				if ($enregistrement ['jeudi'] == '1' && in_array ( 'jeudi', $tab_jours)) {
					$message.="[".$key."/jeudi]-";
					$Nb_dipo ++;
				}
				if ($enregistrement ['vendredi'] == '1' && in_array ( 'vendredi', $tab_jours)) {
					$message.="[".$key."/vendredi]-";
					$Nb_dipo ++;
				}
				if ($enregistrement ['samedi'] == '1' && in_array ( 'samedi', $tab_jours)) {
					$message.="[".$key."/samedi]-";
					$Nb_dipo ++;
				}
				if ($enregistrement ['dimanche'] == '1'  && in_array ( 'dimanche', $tab_jours)) {
					$message.="[".$key."/dimanche]-";
					$Nb_dipo ++;
				}
			}
			$nb_dispo_eleve=$disponibilite_eleve ['Nb_dipo'];
			$pourcentage=round($Nb_dipo/$nb_dispo_eleve*100,2);
			$liste [$i] ['identite_intervenant'] = $value ['identite_intervenant'];
			$liste [$i] ['code_intervenant'] = $value ['code_intervenant'];
                        $liste [$i] ['intervenant_latitude'] = $value ['intervenant_latitude'];
                        $liste [$i] ['intervenant_longitude'] = $value ['intervenant_longitude'];
			$liste [$i] ['pourcentage_dispo'] = $pourcentage; 
                        $liste [$i] ['intervenant_distance'] = round($value ['intervenant_distance'],2);
                       
		
			$i ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	//$liste_tri= tri_tabeau_asso($liste);	
	return $liste;
}
function tri_tabeau_asso($tableau) {
	$tab_tri = array ();
	$tab_temp = array ();
	foreach ( $tableau as $key => $value ) {
		$index = $value ['code_intervenant'];
		$valeur = $value ['pourcentage_dispo'];
		$tab_tri [$index] = $valeur;
	}
	arsort ( $tab_tri );	
	foreach ( $tab_tri as $key => $value ) {
		foreach ( $tableau as  $value1 ) {
			if ($value1 ['code_intervenant'] == $key) {
				$tab_temp [] = $value1;
			}
		}
	}
	return $tab_temp;
}
function infos_famille($reference_intervention) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "  SELECT membre_famille.nom,membre_famille.prenom,membre_famille.civilite,membre_famille.adresse,membre_famille.code_postale,membre_famille.ville,membre_famille.telephone_fixe,membre_famille.telephone_portable,membre_famille.telephone_travail ";
		$sql .= " FROM eleve_intervenant,membre_famille,eleve_famille";
		$sql .= " WHERE eleve_intervenant.code_eleve=eleve_famille.code_eleve  ";
		$sql .= " AND eleve_famille.code_famille=membre_famille.code_famille ";
		$sql .= " AND eleve_intervenant.reference='" . $reference_intervention . "' ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		while ( $enregistrement = $resultat->fetch () ) {
			$infos ['identite_famille'] = html_entity_decode ( $enregistrement ['nom'] ) . "." . html_entity_decode ( $enregistrement ['prenom'] );
			$infos ['civilite'] = $enregistrement ['civilite'];			
			$infos ['adresse'] = $enregistrement ['adresse'];
			$infos ['code_postale'] = $enregistrement ['code_postale'];
			$infos ['ville'] = $enregistrement ['ville'];
			$infos ['tel_fixe'] = $enregistrement ['telephone_fixe'];
			$infos ['tel_portable'] = $enregistrement ['telephone_portable'];
			$infos ['tel_travail'] = $enregistrement ['telephone_travail'];
		
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}
function fiche_eleve($code_eleve) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "SELECT eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve,eleve_famille.tel_portable  AS tel_portable,liste_niveau_option.nom_option AS niveau_peda";
		$sql .= " FROM eleve_famille,liste_niveau_option WHERE ";
		$sql .= "  eleve_famille.niveau_peda=liste_niveau_option.id_option ";
		$sql .= "AND  eleve_famille.code_eleve=:param1 ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->bindParam ( ':param1', $param1 );
		$param1 = $code_eleve;
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['nom_eleve'] = html_entity_decode ( $enregistrement ['nom_eleve'] );
		$infos ['prenom_eleve'] = html_entity_decode ( $enregistrement ['prenom_eleve'] );
		$infos ['tel_eleve'] = ($enregistrement ['tel_portable'] != '') ? $enregistrement ['tel_portable'] : '-----';
		$infos ['niveau_peda'] = $enregistrement ['niveau_peda'];
                // requete des disponibilite de l'eleve.
		$sql1 = "SELECT * FROM dispo_hebdo_eleve WHERE code_eleve=:param2 ";
		$resultat1 = $cxn->prepare ( $sql1 );
		$resultat1->bindParam ( ':param2', $param2 );
		$param2 = $code_eleve;
		$resultat1->execute ();
		$j = 0;
		while ( $enregistrement1 = $resultat1->fetch () ) {
			$periode = $enregistrement1 ['periode'];
			$infos ['diponibilite'] [$periode] ['lundi'] = $enregistrement1 ['lundi'];
			$infos ['diponibilite'] [$periode] ['mardi'] = $enregistrement1 ['mardi'];
			$infos ['diponibilite'] [$periode] ['mercredi'] = $enregistrement1 ['mercredi'];
			$infos ['diponibilite'] [$periode] ['jeudi'] = $enregistrement1 ['jeudi'];
			$infos ['diponibilite'] [$periode] ['vendredi'] = $enregistrement1 ['vendredi'];
			$infos ['diponibilite'] [$periode] ['samedi'] = $enregistrement1 ['samedi'];
			$infos ['diponibilite'] [$periode] ['dimanche'] = $enregistrement1 ['dimanche'];
			$j ++;
		}
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}

	return $infos;
}
function infos_eleve($reference_intervention) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "  SELECT eleve_intervenant.code_eleve ";
		$sql .= " FROM eleve_intervenant ";
		$sql .= " WHERE  eleve_intervenant.reference='" . $reference_intervention . "' ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos = fiche_eleve ( $enregistrement ['code_eleve'] );
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	return $infos;
}
function infos_utile_intervention($reference_intervention) {
	global $cxn;
	$infos = array ();
	try {
		$sql = "   SELECT interventions.reference,interventions.type_intervention,liste_matiere.nom AS matiere_choisi,interventions.date_debut_mission,interventions.date_fin_mission,interventions.frequence,interventions.duree,interventions.observation ";
		$sql .= "  FROM interventions,eleve_intervenant,liste_matiere ";
		$sql .= "  WHERE interventions.reference=eleve_intervenant.reference ";
		$sql .= "  AND  eleve_intervenant.matiere=liste_matiere.id ";
		$sql .= "  AND  interventions.reference='" . $reference_intervention . "' ";
		$resultat = $cxn->prepare ( $sql );
		$resultat->execute ();
		$enregistrement = $resultat->fetch ();
		$infos ['reference'] = $enregistrement ['reference'];
		$infos ['type_intervention'] = $enregistrement ['type_intervention'];
		$infos ['matiere'] = $enregistrement ['matiere_choisi'];
		$infos ['frequence'] = $enregistrement ['frequence'];
		$infos ['duree'] = $enregistrement ['duree'].'H';
		$infos ['date_debut_mission'] = $enregistrement ['date_debut_mission'];
		if ($enregistrement ['type_intervention'] == 'ponctuelle') {
			$infos ['date_fin_mission'] = $enregistrement ['date_fin_mission'];
		}
		$infos ['observation'] = ( $enregistrement ['observation']!= NULL ) ? $enregistrement ['observation'] : '---------------';		
	} catch ( Exception $e ) {
		echo "Une erreur est survenue lors de la récupération des données";
	}	
	return $infos;
}

?>
