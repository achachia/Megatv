<?php

function liste_famille() {
    global $cxn;
    $liste = array();
    try {
        // requete prepare
        $sql = " SELECT  membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille,membre_famille.code_famille AS code_famille  FROM membre_famille ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['code_famille'] = $enregistrement['code_famille'];
            $liste[$i]['identite_famille'] = html_entity_decode($enregistrement['nom_famille']) . "." . html_entity_decode($enregistrement['prenom_famille']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function formatage_nombre($nombre) {
    if ($nombre != NULL) {
        $tab_val = explode(".", $nombre);
        if ($tab_val ['1'] == '00' || !isset($tab_val ['1'])) {
            $nbre_h = $tab_val ['0'];
        } else {
            $nbre_h = $tab_val ['0'] . '.30';
        }
    } else {
        $nbre_h = '0';
    }
    return $nbre_h;
}
function identite_client($code_client) {
    global $cxn;
    $rapport_client = array();
    try {
        $sql = " SELECT CONCAT(nom, '.',prenom) AS identite_client ";
        $sql .=" FROM membre_famille ";
        $sql .=" WHERE code_famille =  '" . $code_client . "' ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $rapport_client['identite_client'] = $enregistrement['identite_client'];
        try {
            $sql = " SELECT SUM( model_coupon.dure ) AS NB_H ";
            $sql .=" FROM e_coupon, facture_famille, model_coupon";
            $sql .=" WHERE e_coupon.id_model = model_coupon.id_model ";
            $sql .=" AND facture_famille.N_facture = e_coupon.N_facture";
            $sql .=" AND e_coupon.check_coupon =  '0' ";
            $sql .=" AND facture_famille.code_famille =  '" . $code_client . "'";
            $resultat = $cxn->prepare($sql);
            $resultat->execute();
            $enregistrement = $resultat->fetch();
            $rapport_client['Nbre_H_restant'] = formatage_nombre($enregistrement['NB_H']) . 'H';
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $rapport_client;
}
function Nbre_heure($N_facture, $check_coupon = NULL, $etat_facture = NULL) {
    global $cxn;
    $nbre_h = 0;
    try {
        $sql = " SELECT SUM( model_coupon.dure ) AS NB_H ";
        $sql .= " FROM e_coupon, facture_famille, model_coupon";
        $sql .= " WHERE e_coupon.id_model = model_coupon.id_model ";
        $sql .= " AND facture_famille.N_facture = e_coupon.N_facture";
        $sql .= " AND facture_famille.N_facture = '" . $N_facture . "'";
        if ($check_coupon != NULL) {
            $sql .= " AND e_coupon.check_coupon =  '" . $check_coupon . "' ";
        }
        if ($etat_facture != NULL) {
            $sql .= " AND facture_famille.etat_facture =  '" . $etat_facture . "' ";             
        }
        $resultat = $cxn->prepare($sql);
       
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $nbre_h = $enregistrement ['NB_H'];
        // var_dump($nbre_h);
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $nbre_h;
}

function rapport_heures($code_famille,$month,$from,$to) {
    global $cxn;
    $liste = array();
    $total_h_vendu = 0;
    $total_h_effectue = 0;
    $total_h_restant = 0;
    $nbre_h_restant_valide = 0;
    $nbre_h_restant_attente = 0;
    try {
        $sql = " SELECT CONCAT(membre_famille.nom, '.', membre_famille.prenom) AS nom_client,facture_famille.date_facture,facture_famille.N_facture, facture_famille.Qte FROM facture_famille,membre_famille    ";
        $sql .= " WHERE facture_famille.code_famille=membre_famille.code_famille ";
        if ($month != NULL) {
            $sql .= " AND ";
            switch ($month) {
                case "tomonth" :
                    $sql .= " MONTH( facture_famille.date_facture ) = MONTH( NOW( ) ) ";
                    break;
                case "last" :
                    $sql .= "MONTH( facture_famille.date_facture ) = MONTH(ADDDATE(CURDATE(),INTERVAL -1 MONTH))";
                    break;
                case "month3" :
                    $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -3 MONTH))<= MONTH( facture_famille.date_facture ) <= MONTH( NOW( ) )";
                    break;
                case "month6" :
                    $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -6 MONTH))<= MONTH( facture_famille.date_facture ) <= MONTH( NOW( ) )";
                    break;
                case "toyear" :
                    $sql .= " YEAR( facture_famille.date_facture ) = YEAR( NOW( ) ) ";
                    break;
                case "lastyear" :
                    $sql .= " YEAR( facture_famille.date_facture ) = YEAR( ADDDATE( CURDATE( ) , INTERVAL -1 YEAR ) ) ";
                    break;
                case "perso" :
                    $sql .= " facture_famille.date_facture BETWEEN  '" . $from . "'  AND  '" . $to . "' ";
                    break;
            }
        }
        if ($code_famille != NULL) {
            $sql .= " AND facture_famille.code_famille='" . $code_famille . "'";
        }
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste [$i] ['nom_client'] = $enregistrement ['nom_client'];
            $liste [$i] ['N_facture'] = $enregistrement ['N_facture'];
            $liste [$i] ['date_facture'] = $enregistrement ['date_facture'];
            $liste [$i] ['nbre_h_vendue'] = formatage_nombre($enregistrement ['Qte']) . 'H';
            $liste [$i] ['nbre_h_effec'] = formatage_nombre(Nbre_heure($enregistrement ['N_facture'], '1')) . 'H';
            $liste [$i] ['nbre_h_restant'] = formatage_nombre(Nbre_heure($enregistrement ['N_facture'], '0')) . 'H';
            /*             * ********************************************* */
            $total_h_vendu += $enregistrement ['Qte'];
            $total_h_effectue += Nbre_heure($enregistrement ['N_facture'], '1');
            $total_h_restant += Nbre_heure($enregistrement ['N_facture'], '0');
            /*             * ************************************************ */
            $nbre_h_restant_valide += Nbre_heure($enregistrement ['N_facture'],NULL,'regl&eacute;');
            $nbre_h_restant_attente += Nbre_heure($enregistrement ['N_facture'],NULL,'attente');
            /*             * ************************************************ */
            $i ++;
        }
        // var_dump( $liste);
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    /*     * ************************************************ */
    // $rapport_heure ['sql']=$sql;
    $rapport_heure ['rapport_heures'] = $liste;
    /*     * ************************************************ */
    if ($code_famille != NULL) {
     $identite_client= identite_client($code_famille);
     $rapport_heure['identite_client']['nom_client']=$identite_client['identite_client'];
     $rapport_heure['identite_client']['Nbre_H_restant']=$identite_client['Nbre_H_restant'];
     }
    /*     * ************************************************ */
    $rapport_heure ['nbre_h_vendue'] = formatage_nombre($total_h_vendu) . 'H';
    $rapport_heure ['nbre_h_effec'] = formatage_nombre($total_h_effectue) . 'H';
    $rapport_heure ['nbre_h_restant'] = formatage_nombre($total_h_restant) . 'H';
    /*     * ************************************************ */
    $rapport_heure ['nbre_h_restant_valide'] = formatage_nombre($nbre_h_restant_valide) . 'H';
    $rapport_heure ['nbre_h_restant_attente'] = formatage_nombre($nbre_h_restant_attente) . 'H';
    $rapport_heure ['nbre_h_restant_non_regle'] = 'fonction indisponible';
    $rapport_heure ['nbre_h_restant_annule'] = 'fonction indisponible';
    /*     * ************************************************ */

    return $rapport_heure;
}
                   /***********************************/
function rapport_test($code_famille,$month,$from,$to) {
	global $cxn;
	$liste = array();
	$total_h_vendu = 0;
	$total_h_effectue = 0;
	$total_h_restant = 0;
	$nbre_h_restant_valide = 0;
	$nbre_h_restant_attente = 0;
	try {
		$sql = " SELECT CONCAT(membre_famille.nom, '.', membre_famille.prenom) AS nom_client,facture_famille.date_facture,facture_famille.N_facture, facture_famille.Qte FROM facture_famille,membre_famille    ";
		$sql .= " WHERE facture_famille.code_famille=membre_famille.code_famille ";
		if ($month != NULL) {
			$sql .= " AND ";
			switch ($month) {
				case "tomonth" :
					$sql .= " MONTH( facture_famille.date_facture ) = MONTH( NOW( ) ) ";
					break;
				case "last" :
					$sql .= "MONTH( facture_famille.date_facture ) = MONTH(ADDDATE(CURDATE(),INTERVAL -1 MONTH))";
					break;
				case "month3" :
					$sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -3 MONTH))<= MONTH( facture_famille.date_facture ) <= MONTH( NOW( ) )";
					break;
				case "month6" :
					$sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -6 MONTH))<= MONTH( facture_famille.date_facture ) <= MONTH( NOW( ) )";
					break;
				case "toyear" :
					$sql .= " YEAR( facture_famille.date_facture ) = YEAR( NOW( ) ) ";
					break;
				case "lastyear" :
					$sql .= " YEAR( facture_famille.date_facture ) = YEAR( ADDDATE( CURDATE( ) , INTERVAL -1 YEAR ) ) ";
					break;
				case "perso" :
					$sql .= " facture_famille.date_facture BETWEEN  '" . $from . "'  AND  '" . $to . "' ";
					break;
			}
		}
		if ($code_famille != NULL) {
			$sql .= " AND facture_famille.code_famille='" . $code_famille . "'";
		}
		$resultat = $cxn->prepare($sql);
		$resultat->execute();
		$i = 0;
		while ($enregistrement = $resultat->fetch()) {
			$liste [$i] ['nom_client'] = $enregistrement ['nom_client'];
			$liste [$i] ['N_facture'] = $enregistrement ['N_facture'];
			$liste [$i] ['date_facture'] = $enregistrement ['date_facture'];
			$liste [$i] ['nbre_h_vendue'] = formatage_nombre($enregistrement ['Qte']) . 'H';
			$liste [$i] ['nbre_h_effec'] = formatage_nombre(Nbre_heure($enregistrement ['N_facture'], '1')) . 'H';
			$liste [$i] ['nbre_h_restant'] = formatage_nombre(Nbre_heure($enregistrement ['N_facture'], '0')) . 'H';
			/*             * ********************************************* */
			$total_h_vendu += $enregistrement ['Qte'];
			$total_h_effectue += Nbre_heure($enregistrement ['N_facture'], '1');
			$total_h_restant += Nbre_heure($enregistrement ['N_facture'], '0');
			/*             * ************************************************ */
			$nbre_h_restant_valide += Nbre_heure($enregistrement ['N_facture'],NULL,'regl&eacute;');
			$nbre_h_restant_attente += Nbre_heure($enregistrement ['N_facture'],NULL,'attente');
			/*             * ************************************************ */
			$i ++;
		}
		// var_dump( $liste);
	} catch (Exception $e) {
		echo "Une erreur est survenue lors de la récupération des données";
	}
	/*     * ************************************************ */
	// $rapport_heure ['sql']=$sql;
	$rapport_heure ['rapport_heures'] = $liste;
	/*     * ************************************************ */
	if ($code_famille != NULL) {
		$identite_client= identite_client($code_famille);
		$rapport_heure['identite_client']['nom_client']=$identite_client['identite_client'];
		$rapport_heure['identite_client']['Nbre_H_restant']=$identite_client['Nbre_H_restant'];
	}
	/*     * ************************************************ */
	$rapport_heure ['nbre_h_vendue'] = formatage_nombre($total_h_vendu) . 'H';
	$rapport_heure ['nbre_h_effec'] = formatage_nombre($total_h_effectue) . 'H';
	$rapport_heure ['nbre_h_restant'] = formatage_nombre($total_h_restant) . 'H';
	/*     * ************************************************ */
	$rapport_heure ['nbre_h_restant_valide'] = formatage_nombre($nbre_h_restant_valide) . 'H';
	$rapport_heure ['nbre_h_restant_attente'] = formatage_nombre($nbre_h_restant_attente) . 'H';
	$rapport_heure ['nbre_h_restant_non_regle'] = 'fonction indisponible';
	$rapport_heure ['nbre_h_restant_annule'] = 'fonction indisponible';
	/*     * ************************************************ */

	return $liste;
}

?>