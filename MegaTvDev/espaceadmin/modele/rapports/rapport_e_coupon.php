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
            $liste [$i] ['code_famille'] = $enregistrement ['code_famille'];
            $liste [$i] ['identite_famille'] = html_entity_decode($enregistrement ['nom_famille']) . "." . html_entity_decode($enregistrement ['prenom_famille']);
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function formatage_nombre($nombre) {
    if ($nombre != NULL) {
        $tab_val = explode(".", $nombre);
        if ($tab_val ['1'] == '00') {
            $nbre_h = $tab_val ['0'];
        } else {
            $nbre_h = $tab_val ['0'] . '.30';
        }
    } else {
        $nbre_h = '0';
    }
    return $nbre_h;
}

function rapport_e_coupons($code_client = NULL, $month = NULL, $check = NULL, $from = NULL, $to = NULL) {
    global $cxn;
    $liste = array();
    // liste e-coupons valide - attente
    try {
        $sql = " SELECT  CONCAT(membre_famille.nom, '.',membre_famille.prenom) AS nom_client,membre_famille.code_famille AS code_client,e_coupon.code_coupon,e_coupon.check_coupon,e_coupon.N_facture ";
        $sql .= " FROM  e_coupon,membre_famille,facture_famille ";
        $sql .= " WHERE facture_famille.N_facture = e_coupon.N_facture ";
        $sql .= " AND membre_famille.code_famille = facture_famille.code_famille ";
        if (!is_null($code_client)) {
            $sql .= " AND membre_famille.code_famille =:code_client ";
        }
        if (!is_null($month)) {
            $sql .= " AND ";
            switch ($month) {
                case "tomonth" :
                    $sql .= " MONTH( compte_rendu.date_cours ) = MONTH( NOW( ) ) ";
                    break;
                case "last" :
                    $sql .= "MONTH( compte_rendu.date_cours ) = MONTH(ADDDATE(CURDATE(),INTERVAL -1 MONTH))";
                    break;
                case "month3" :
                    $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -3 MONTH))<= MONTH( compte_rendu.date_cours ) <= MONTH( NOW( ) )";
                    break;
                case "month6" :
                    $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -6 MONTH))<= MONTH( compte_rendu.date_cours ) <= MONTH( NOW( ) )";
                    break; 
                case "toyear" :
                    $sql .= " YEAR( compte_rendu.date_cours ) = YEAR( NOW( ) ) ";
                    break;
                case "lastyear" :
                    $sql .= " YEAR( compte_rendu.date_cours ) = YEAR( ADDDATE( CURDATE( ) , INTERVAL -1 YEAR ) ) ";
                    break;
                case "perso" :
                    $sql .= " compte_rendu.date_cours BETWEEN  :from  AND  :to  ";
                    break;
            }
        }
        $resultat = $cxn->prepare($sql);
        if (!is_null($code_client)) {
            $resultat->bindParam(':code_client', $code_client);
        }
        if (!is_null($month) && $month=='perso') {
               $resultat->bindParam(':from', $from); 
               $resultat->bindParam(':to', $to); 
         }
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste [$i] ['nom_client'] = $enregistrement ['nom_client'];
            $liste [$i] ['code_client'] = $enregistrement ['code_client'];
            $liste [$i] ['code_coupon'] = $enregistrement ['code_coupon'];
            $liste [$i] ['N_facture'] = $enregistrement ['N_facture'];
            if ($enregistrement ['check_coupon'] == '1') {
                $liste [$i] ['statut_coupon'] = '<button type="button" class="btn btn-success">valid&eacute;</button>';
            } elseif ($enregistrement ['check_coupon'] == '0') {
                $liste [$i] ['statut_coupon'] = '<button type="button" class="btn btn-warning">attente</button>';
            }
            // $liste [$i] ['dure_cours'] = ($enregistrement ['dure'] == '1.50') ? '1.30 H' : $enregistrement ['dure'] . 'H';
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    // liste e-coupons annule
    try {
        $sql = " SELECT  CONCAT(membre_famille.nom, '.',membre_famille.prenom) AS nom_client,membre_famille.code_famille AS code_client,e_coupon_annule.code_coupon,e_coupon_annule.N_facture ";
        $sql .= " FROM  e_coupon_annule,membre_famille,facture_famille ";
        $sql .= " WHERE facture_famille.N_facture = e_coupon_annule.N_facture ";
        $sql .= " AND membre_famille.code_famille = facture_famille.code_famille ";
             if (!is_null($code_client)) {
            $sql .= " AND membre_famille.code_famille =:code_client ";
        }
        if (!is_null($month)) {
            $sql .= " AND ";
            switch ($month) {
                case "tomonth" :
                    $sql .= " MONTH( compte_rendu.date_cours ) = MONTH( NOW( ) ) ";
                    break;
                case "last" :
                    $sql .= "MONTH( compte_rendu.date_cours ) = MONTH(ADDDATE(CURDATE(),INTERVAL -1 MONTH))";
                    break;
                case "month3" :
                    $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -3 MONTH))<= MONTH( compte_rendu.date_cours ) <= MONTH( NOW( ) )";
                    break;
                case "month6" :
                    $sql .= "MONTH(ADDDATE(CURDATE(),INTERVAL -6 MONTH))<= MONTH( compte_rendu.date_cours ) <= MONTH( NOW( ) )";
                    break;
                case "toyear" :
                    $sql .= " YEAR( compte_rendu.date_cours ) = YEAR( NOW( ) ) ";
                    break;
                case "lastyear" :
                    $sql .= " YEAR( compte_rendu.date_cours ) = YEAR( ADDDATE( CURDATE( ) , INTERVAL -1 YEAR ) ) ";
                    break;
                case "perso" :
                    $sql .= " compte_rendu.date_cours BETWEEN  :from  AND  :to  ";
                    break;
            }
        }
        $resultat = $cxn->prepare($sql);
        if (!is_null($code_client)) {
            $resultat->bindParam(':code_client', $code_client);
        }
        if (!is_null($month) && $month=='perso') {
               $resultat->bindParam(':from', $from); 
               $resultat->bindParam(':to', $to); 
         }
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste [$i] ['nom_client'] = $enregistrement ['nom_client'];
            $liste [$i] ['code_client'] = $enregistrement ['code_client'];
            $liste [$i] ['code_coupon'] = $enregistrement ['code_coupon'];
            $liste [$i] ['N_facture'] = $enregistrement ['N_facture'];
            $liste [$i] ['statut_coupon'] = '<button type="button" class="btn  btn-danger">annul&eacute;</button>';
            // $liste [$i] ['dure_cours'] = ($enregistrement ['dure'] == '1.50') ? '1.30 H' : $enregistrement ['dure'] . 'H';
            $i ++;
        }
         $rapport_e_coupon ['rapport_e_coupons'] = $liste;
          /*****************************************************/
          if ($code_client != NULL) {
             $identite_client= identite_client($code_client);
             $rapport_e_coupon['identite_client']['nom_client']=$identite_client['identite_client'];
             $rapport_e_coupon['identite_client']['nbre_coupon_valide']=$identite_client['nbre_coupon_valide'];
             $rapport_e_coupon['identite_client']['nbre_coupon_attente']=$identite_client['nbre_coupon_attente'];
             $rapport_e_coupon['identite_client']['nbre_coupon_annule']=$identite_client['nbre_coupon_annule'];
         }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $rapport_e_coupon;
}

function identite_client($code_client) {
    global $cxn;
    $rapport_client = array();
    try {
        $sql = " SELECT CONCAT(nom, '.',prenom) AS identite_client ";
        $sql .= " FROM membre_famille ";
        $sql .= " WHERE code_famille =  '" . $code_client . "' ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $rapport_client ['identite_client'] = $enregistrement ['identite_client'];
        //compter le nombre de coupon valide 
        try {
        	$sql = " SELECT  COUNT(e_coupon.code_coupon) AS nbre_coupon_valide ";
        	$sql .= " FROM  e_coupon,membre_famille,facture_famille ";
        	$sql .= " WHERE facture_famille.N_facture = e_coupon.N_facture ";
        	$sql .= " AND membre_famille.code_famille = facture_famille.code_famille ";
            $sql .= " AND membre_famille.code_famille =:code_client "; 
            $sql .= " AND e_coupon.check_coupon ='1' ";
        	$resultat = $cxn->prepare($sql);
        	$resultat->bindParam(':code_client', $code_client);        
        	$resultat->execute();
        	$enregistrement = $resultat->fetch();
        	$rapport_client ['nbre_coupon_valide'] = $enregistrement ['nbre_coupon_valide'];
        } catch (Exception $e) {
        	echo "Une erreur est survenue lors de la récupération des données";
        }
        //compter le nombre de coupon attente
        try {
        	$sql = " SELECT  COUNT(e_coupon.code_coupon) AS nbre_coupon_attente ";
        	$sql .= " FROM  e_coupon,membre_famille,facture_famille ";
        	$sql .= " WHERE facture_famille.N_facture = e_coupon.N_facture ";
        	$sql .= " AND membre_famille.code_famille = facture_famille.code_famille ";
        	$sql .= " AND membre_famille.code_famille =:code_client ";
        	$sql .= " AND e_coupon.check_coupon ='0' ";
        	$resultat = $cxn->prepare($sql);
        	$resultat->bindParam(':code_client', $code_client);
        	$resultat->execute();
        	$enregistrement = $resultat->fetch();
        	$rapport_client ['nbre_coupon_attente'] = $enregistrement ['nbre_coupon_attente'];
        } catch (Exception $e) {
        	echo "Une erreur est survenue lors de la récupération des données";
        }
        //compter le nombre de coupon annule
        try {
        	$sql = " SELECT  COUNT(e_coupon_annule.code_coupon) AS nbre_coupon_annule ";
        	$sql .= " FROM  e_coupon_annule,membre_famille,facture_famille ";
        	$sql .= " WHERE facture_famille.N_facture = e_coupon_annule.N_facture ";
        	$sql .= " AND membre_famille.code_famille = facture_famille.code_famille ";
        	$sql .= " AND membre_famille.code_famille =:code_client ";        
        	$resultat = $cxn->prepare($sql);
        	$resultat->bindParam(':code_client', $code_client);
        	$resultat->execute();
        	$enregistrement = $resultat->fetch();
        	$rapport_client ['nbre_coupon_annule'] = $enregistrement ['nbre_coupon_annule'];
        } catch (Exception $e) {
        	echo "Une erreur est survenue lors de la récupération des données";
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $rapport_client;
}
?>
