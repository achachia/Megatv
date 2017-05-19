<?php

require 'modele.php';

function date_premier_cours($reference) {
		global $cxn;
		$infos = array ();
		try {
			$sql = "  SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille ";
                        $sql .= " FROM  interventions,eleve_intervenant,eleve_famille,membre_famille ";
                        $sql .= " WHERE interventions.reference=eleve_intervenant.reference ";
			$sql .= " AND   eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
			$sql .= " AND   eleve_famille.code_famille=membre_famille.code_famille ";
                        $sql .= " AND   eleve_intervenant.statut='attente' ";          
                        $sql .= " AND   interventions.reference='".$reference."' ";
                        $sql .= " AND   interventions.exigeance_date_cours='1' ";
                        $sql .= " AND   interventions.date_premier_cours=NULL ";
                        // echo $sql;
			$resultat = $cxn->query ( $sql );
			$nb = $resultat->rowCount ();
			if ($nb > 0) {
				$enregistrement = $resultat->fetch ();
				$infos ['reference_mission'] = $enregistrement ['reference'];
				$infos ['identite_famille'] = html_entity_decode ( $enregistrement ['nom_famille'] ) . "." . html_entity_decode ( $enregistrement ['prenom_famille'] );
			}			
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		return $infos;
	}
	function bilan_premier_cours($reference) {
		global $cxn;
		$infos = array ();
		try {
			$sql = "    SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille";
	        $sql .= "   FROM  interventions,eleve_intervenant,eleve_famille,membre_famille ";
            $sql .= "   WHERE interventions.reference=eleve_intervenant.reference ";
			$sql .= "   AND   eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
			$sql .= "   AND   eleve_famille.code_famille=membre_famille.code_famille ";
            $sql .= "   AND   eleve_intervenant.statut='attente' ";
            $sql .= "   AND   interventions.reference='".$reference."'  ";
			$sql .= "   AND   interventions.exigeance_bilan_cours='1'  ";
			$sql .= "   AND   NOT EXISTS ( SELECT id_bilan    FROM bilan_premier_cours  WHERE bilan_premier_cours.reference='".$reference."' ) ";
			$resultat = $cxn->query ( $sql );
			$nb = $resultat->rowCount ();
			if ($nb > 0) {
				$enregistrement = $resultat->fetch ();
				$infos ['reference_mission'] = $enregistrement ['reference'];
				$infos ['identite_famille'] = html_entity_decode ( $enregistrement ['nom_famille'] ) . "." . html_entity_decode ( $enregistrement ['prenom_famille'] );
			}
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		return $infos;
	}
	function liste_eleves($code_intervenant) {
		global $cxn;
		$liste = array ();
		try {
			$sql = "   SELECT  eleve_famille.code_eleve  AS code_eleve,eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve,liste_niveau_option.nom_option AS niveau_peda,";
			$sql .= "  membre_famille.code_postale  AS code_postale,membre_famille.ville  AS ville,liste_matiere.nom AS matiere,eleve_intervenant.statut AS statut,interventions.reference ";
			$sql .= "  FROM membre_famille,eleve_famille,eleve_intervenant,interventions,liste_niveau_option,liste_matiere  ";
			$sql .= "  WHERE eleve_intervenant.code_eleve=eleve_famille.code_eleve  ";
			$sql .= "  AND eleve_intervenant.matiere=liste_matiere.id  ";
			$sql .= "  AND eleve_famille.niveau_peda=liste_niveau_option.id_option  ";
			$sql .= "  AND eleve_famille.code_eleve=eleve_intervenant.code_eleve  ";
			$sql .= "  AND membre_famille.code_famille=eleve_famille.code_famille  ";
			$sql .= "  AND eleve_intervenant.code_intervenant=:param  GROUP BY code_eleve ";
			$resultat = $cxn->prepare ( $sql );
			$resultat->bindParam ( ':param', $param );
			$param = $code_intervenant;
			$resultat->execute ();
			$i = 0;
			while ( $enregistrement = $resultat->fetch () ) {
				$liste [$i] ['code_eleve'] = $enregistrement ['code_eleve'];
				$liste [$i] ['identite_eleve'] = html_entity_decode ( $enregistrement ['nom_eleve'] ) . "." . html_entity_decode ( $enregistrement ['prenom_eleve'] );
				$liste [$i] ['lieu'] = $enregistrement ['ville'] . " (" . $enregistrement ['code_postale'] . ")";
				$liste [$i] ['niveau'] = $enregistrement ['niveau_peda'];
				$liste [$i] ['matiere'] = $enregistrement ['matiere'];
				$liste [$i] ['etat_mission'] = $enregistrement ['statut'];
				// /////////// consulter la fiche de l'eleve////////////////
				$consulter_fiche_eleve = "<span class='glyphicon glyphicon-eye-open'> Consulter la fiche</span>";
				$lien1 = 'index.php?module=eleves&action=view_fiche_eleve&code_eleve=' . $enregistrement ['code_eleve'];
				// ///////// consulter le bilan des prestations /////////////////////
				$consulter_bilan_prestation = "<span class='glyphicon glyphicon-th-list'> Les prestations</span>";
				$lien2 = 'index.php?module=eleves&action=view_bilan_prestation_eleve&code_eleve=' . $enregistrement ['code_eleve'];
				// //////////// saisir le bilan de premier cours/////////////////////
				$saisir_bilan_premier_cours = "<span class='glyphicon glyphicon-edit'> Bilan 1er cours</span>";
				$lien4 = 'index.php?module=eleves&action=view_bilan_prestation_eleve&code_eleve=' . $enregistrement ['code_eleve'];
				// //////////// saisir le compte-rendu de cours/////////////////////
				$saisir_compte_rendu_cours = "<span class='glyphicon glyphicon-edit'> Saisir un compte-rendu</span>";
				$lien5 = 'index.php?module=compte_rendu&action=create_compte_rendu&code_eleve=' . $enregistrement ['code_eleve'];
				
				switch ($enregistrement ['statut']) {
					case 'attente' :
						
						// /////////// consulter la fiche de l'eleve //////////
						$liste [$i] ['action'] [$consulter_fiche_eleve] = $lien1;
						// //////////// saisir la date de premier cours/////////////////////////////
						$reference_intervention = $enregistrement ['reference'];
						$code_eleve = $enregistrement ['code_eleve'];
						$infos_date_premier_cours = date_premier_cours ($reference_intervention );
                                                var_dump($infos_date_premier_cours);
						if (sizeof ( $infos_date_premier_cours ) <= 0) {
							$saisir_date_premier_cours = "<span class='glyphicon glyphicon-edit'> Date 1er cours</span>";
							$lien3 = 'index.php?module=compte_rendu&action=saisir_date_premier_cours&reference_mission=' . $infos_date_premier_cours ['reference_mission'] . '&identite_famille=' . $infos_date_premier_cours ['identite_famille'];
							$liste [$i] ['action'] [$saisir_date_premier_cours] = $lien3;
						}
						// //////////// saisir le bilan de premier cours/////////////////////////////
						$infos_bilan_premier_cours = bilan_premier_cours ( $reference_intervention);
						if (sizeof ( $infos_bilan_premier_cours ) <= 0) {
							$saisir_bilan_premier_cours = "<span class='glyphicon glyphicon-edit'> Bilan 1er cours</span>";
							$lien4 = "index.php?module=compte_rendu&action=saisir_bilan_premier_cours&reference_mission=" . $infos_bilan_premier_cours ['reference_mission'] . "&identite_famille=" . $infos_bilan_premier_cours ['identite_famille'];
							$liste [$i] ['action'] [$saisir_bilan_premier_cours] = $lien4;
						}
						break;
					case 'confirme' :
						
						// /////////// consulter la fiche de l'eleve //////////
						$liste [$i] ['action'] [$consulter_fiche_eleve] = $lien1;
						// //////////////// consulter le bilan des prestations ////////////////
						$liste [$i] ['action'] [$consulter_bilan_prestation] = $lien2;
						// //////// saisir le compte-rendu /////////////////////////		
						$saisir_compte_rendu = "<span class='glyphicon glyphicon-edit'> saisir un coupon</span>";
						$liste [$i] ['action'] [$saisir_compte_rendu] = $lien5;
						break;
					case 'termine' :
						// //////////////// consulter le bilan des prestations ////////////////
						$liste [$i] ['action'] [$consulter_bilan_prestation] = $lien2;
						// //////// saisir le compte-rendu /////////////////////////
						$saisir_compte_rendu = "<span class='glyphicon glyphicon-edit'> saisir un coupon</span>";
						$liste [$i] ['action'] [$saisir_compte_rendu] = $lien5;
						break;
					case 'annule' :
						// //////////////// consulter le bilan des prestations ////////////////
						$liste [$i] ['action'] [$consulter_bilan_prestation] = $lien2;
						break;
				}
				$i ++;
			}
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		
		return $liste;
	}
        



function bilan_prestation_eleve($code_intervenant, $code_eleve) {
		global $cxn;
		$liste = array ();
		try {
			$sql = "  SELECT e_coupon.code_coupon AS E_code,DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute ";
			$sql .= " FROM e_coupon,eleve_intervenant,facture_famille,compte_rendu  WHERE ";
			$sql .= " eleve_intervenant.code_eleve=facture_famille.code_eleve ";
			$sql .= " AND e_coupon.N_facture=facture_famille.N_facture ";
			$sql .= " AND e_coupon.code_coupon=compte_rendu.e_coupon ";
			$sql .= " AND eleve_intervenant.code_intervenant=:param1  ";
			$sql .= " AND eleve_intervenant.code_eleve=:param2  ";
			$sql .= " AND e_coupon.check_coupon='1'  ";		
			$resultat = $cxn->prepare ( $sql );			
			$resultat->bindParam ( ':param1', $param1 );
			$param1 = $code_intervenant;
			$resultat->bindParam (':param2', $param2);
			$param2 = $code_eleve;
			$resultat->execute ();						
			$i = 0;
			while ( $enregistrement = $resultat->fetch () ) {
				$liste [$i] ['E_code'] = $enregistrement ['E_code'];
				$liste [$i] ['date_cours_effectute'] = $enregistrement ['date_cours_effectute'];
				$i ++;
			}
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
		
		return $liste;
	}
	function infos_eleve($code_intervenant, $code_eleve) {
		global $cxn;
		$infos = array ();
		try {
			$sql = "  SELECT eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve,eleve_famille.tel_portable  AS tel_portable,liste_niveau_option.nom_option AS niveau_peda, ";
			$sql .= " membre_famille.nom  AS nom_famille,membre_famille.prenom  AS prenom_famille,membre_famille.telephone_portable  AS tel_portable_famille,membre_famille.telephone_fixe AS tel_fixe_famille,membre_famille.telephone_travail AS tel_travail_famille,membre_famille.adresse AS adresse,";
			$sql .= " membre_famille.adresse_suite  AS adresse_suite,membre_famille.code_postale  AS code_postale";
			$sql .= " FROM membre_famille,eleve_famille,eleve_intervenant,liste_niveau_option WHERE ";
			$sql .= " eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
			$sql .= " AND eleve_famille.niveau_peda=liste_niveau_option.id_option ";
			$sql .= " AND membre_famille.code_famille=eleve_famille.code_famille ";
			$sql .= " AND eleve_intervenant.code_intervenant=:param1 AND  eleve_intervenant.statut IN('confirme','attente') AND eleve_intervenant.code_eleve=:param2 ";
			$resultat = $cxn->prepare ( $sql );
			$resultat->bindParam ( ':param1', $param1 );
			$param1 = $code_intervenant;
			$resultat->bindParam ( ':param2', $param2 );
			$param2 = $code_eleve;
			$resultat->execute ();
			$enregistrement = $resultat->fetch ();
			$infos ['nom_eleve'] = html_entity_decode ( $enregistrement ['nom_eleve'] );
			$infos ['prenom_eleve'] = html_entity_decode ( $enregistrement ['prenom_eleve'] );
			$infos ['tel_eleve'] = ($enregistrement ['tel_portable'] != '') ? $enregistrement ['tel_portable'] : '-----';
			$infos ['niveau_peda'] = $enregistrement ['niveau_peda'];
			$infos ['nom_famille'] = $enregistrement ['nom_famille'];
			$infos ['prenom_famille'] = $enregistrement ['prenom_famille'];
			$infos ['tel_fixe_famille'] = ($enregistrement ['tel_fixe_famille'] != '') ? $enregistrement ['tel_fixe_famille'] : '-----';
			$infos ['tel_portable_famille'] = ($enregistrement ['tel_portable_famille'] != '') ? $enregistrement ['tel_portable_famille'] : '-----';
			$infos ['tel_travail_famille'] = ($enregistrement ['tel_portable'] != '') ? $enregistrement ['tel_travail_famille'] : '-----';
			$infos ['adresse'] = $enregistrement ['adresse'];
			$infos ['adresse_suite'] = $enregistrement ['adresse_suite'];
			$infos ['code_postale'] = $enregistrement ['code_postale'];
			try {
				$sql1 = "SELECT * FROM dispo_hebdo_eleve WHERE code_eleve=:param3 ";
				$resultat1 = $cxn->prepare ( $sql1 );
				$resultat1->bindParam ( ':param3', $param3 );
				$param3 = $code_eleve;
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
			echo "Une erreur est survenue lors de la récupération des données2";
		}
	} catch ( Exception $e ) 
	{
		echo "Une erreur est survenue lors de la récupération des données1";
	}
	
	return $infos;
}
        
         	function identite_eleve($code_intervenant,$code_eleve) {
		global $cxn;		
		try {
			$sql  = " SELECT eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve";	
			$sql .= " FROM eleve_famille,eleve_intervenant WHERE ";
			$sql .= " eleve_intervenant.code_eleve=eleve_famille.code_eleve ";		
			$sql .= " AND eleve_intervenant.code_intervenant=:param1 AND   eleve_intervenant.code_eleve=:param2 ";
			$resultat = $cxn->prepare ( $sql );
			$resultat->bindParam ( ':param1', $param1 );
			$param1 = $code_intervenant;
			$resultat->bindParam ( ':param2', $param2 );
			$param2 = $code_eleve;
			$resultat->execute ();
			$enregistrement = $resultat->fetch ();
			$identite_eleve = html_entity_decode ( $enregistrement ['nom_eleve'] ).'.'.html_entity_decode ( $enregistrement ['prenom_eleve'] );
			
	
		} catch ( Exception $e ) {
			echo "Une erreur est survenue lors de la récupération des données";
		}
	
		return $identite_eleve;
	}
?>


