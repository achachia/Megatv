<?php

require 'modele.php';

function mes_compte_rendu($code_user) {
    global $cxn;
    $liste = array();
// Récupération des données
    try {
// requete prepare
        $sql = "SELECT DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute,DATE_FORMAT(compte_rendu.date_cours,'%k:%i' ) AS heure_cours,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve,id_compte ";
        $sql.=" FROM compte_rendu,eleve_famille WHERE ";
        $sql .= " compte_rendu.code_eleve=eleve_famille.code_eleve ";
        $sql .= " AND  code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_user;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_compte_rendu'] = $enregistrement['id_compte'];
            $liste[$i]['date_cours'] = $enregistrement['date_cours_effectute'];
            $heure_array = explode(':', $enregistrement['heure_cours']);
            if ($heure_array[0] < 10) {
                $liste[$i]['heure_cours'] = "0" . $heure_array[0] . ':' . $heure_array[1];
            } else {
                $liste[$i]['heure_cours'] = $enregistrement['heure_cours'];
            }
            $liste[$i]['eleve'] = html_entity_decode($enregistrement['nom_eleve']) . "." . html_entity_decode($enregistrement['prenom_eleve']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function autres_compte_rendu($code_user) {
    global $cxn;
    $liste = array();
    $liste_eleve = array();
// Récupération des données
    try {
// requete prepare
        $sql1 = "SELECT code_eleve FROM eleve_intervenant WHERE code_intervenant=:param1 ";
        $resultat1 = $cxn->prepare($sql1);
        $resultat1->bindParam(':param1', $param1);
        $param1 = $code_user;
        $resultat1->execute();
        while ($enregistrement1 = $resultat1->fetch()) {
            $liste_eleve[] = $enregistrement1['code_eleve'];
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    foreach ($liste_eleve as $value) {
        try {
// requete prepare
            $sql = "SELECT DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute,DATE_FORMAT(compte_rendu.date_cours,'%k:%i' ) AS heure_cours,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve,id_compte ";
            $sql.=" FROM compte_rendu,eleve_famille WHERE ";
            $sql .= " compte_rendu.code_eleve=eleve_famille.code_eleve ";
            $sql .= " AND compte_rendu.code_eleve=:param ";
            $sql .= " AND compte_rendu.code_intervenant!=:param2 ";
            $resultat = $cxn->prepare($sql);
            $resultat->bindParam(':param', $param);
            $resultat->bindParam(':param2', $param2);
            $param = $value;
            $param2 = $code_user;
            $resultat->execute();
            $i = 0;
            while ($enregistrement = $resultat->fetch()) {
                $liste[$i]['id_compte_rendu'] = $enregistrement['id_compte'];
                $liste[$i]['date_cours'] = $enregistrement['date_cours_effectute'];
                $heure_array = explode(':', $enregistrement['heure_cours']);
                if ($heure_array[0] < 10) {
                    $liste[$i]['heure_cours'] = "0" . $heure_array[0] . ':' . $heure_array[1];
                } else {
                    $liste[$i]['heure_cours'] = $enregistrement['heure_cours'];
                }
                $liste[$i]['eleve'] = html_entity_decode($enregistrement['nom_eleve']) . "." . html_entity_decode($enregistrement['prenom_eleve']);
                $i++;
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
    }

    return $liste;
}

function mes_bilan_prem_cours($code_user) {
    global $cxn;
    $liste = array();
    try {
        $sql = "    SELECT DATE_FORMAT(bilan_premier_cours.date_saisi,'%Y-%m-%d' ) AS date_bilan,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve,bilan_premier_cours.id_bilan ";
        $sql.= "    FROM  bilan_premier_cours,eleve_famille,eleve_intervenant  ";
        $sql .= "   WHERE bilan_premier_cours.reference=eleve_intervenant.reference ";
        $sql .= "   AND   eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
        $sql .= "   AND   eleve_intervenant.code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_user;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste[$i]['id_bilan'] = $enregistrement['id_bilan'];
            $liste[$i]['date_bilan'] = $enregistrement['date_bilan'];
            $liste[$i]['identite_eleve'] = html_entity_decode($enregistrement['nom_eleve']) . "." . html_entity_decode($enregistrement['prenom_eleve']);
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function infos_bilan_prem_cours($code_user, $id_bilan) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve ";
        $sql .= ",bilan_premier_cours.rythme_cours,bilan_premier_cours.last_note_controle,bilan_premier_cours.notions_travaille,bilan_premier_cours.objectifs_fixe";
        $sql .= " ,bilan_premier_cours.points_faibles,bilan_premier_cours.points_forts,bilan_premier_cours.objectifs_fixe,bilan_premier_cours.plan_progression";
        $sql .= "    FROM bilan_premier_cours,eleve_famille,interventions  ";
        $sql .= "  WHERE bilan_premier_cours.reference=interventions.reference ";
        $sql .= "  AND interventions.code_eleve=eleve_famille.code_eleve ";
        $sql .= "  AND  code_intervenant=:param1  AND bilan_premier_cours.id_bilan=:param2";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $resultat->bindParam(':param2', $param2);
        $param1 = $code_user;
        $param2 = $id_bilan;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos = array(
            'rythme_cours' => $enregistrement ['rythme_cours'],
            'dernier_note' => $enregistrement ['last_note_controle'],
            'notions_travaille' => $enregistrement ['notions_travaille'],
            'points_forts' => $enregistrement ['points_forts'],
            'points_faibles' => $enregistrement ['points_faibles'],
            'objectifs_fixe' => $enregistrement ['objectifs_fixe'],
            'plan_progression' => $enregistrement ['plan_progression'],
            'eleve' => html_entity_decode($enregistrement ['nom_eleve']) . "." . html_entity_decode($enregistrement ['prenom_eleve'])
        );
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function infos_compte_rendu($id_compte_rendu, $code_intervenant) {
    global $cxn;
    $liste = array();
    try {
        $sql = "SELECT DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute,DATE_FORMAT(compte_rendu.date_cours,'%k:%i' ) AS heure_cours,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve,compte_rendu.recap_cours AS resume_compte_rendu,id_compte,e_coupon,progression_cours ";
        $sql.=" FROM compte_rendu,eleve_famille WHERE ";
        $sql .= " compte_rendu.code_eleve=eleve_famille.code_eleve ";
        $sql .= " AND  code_intervenant=:param2 AND id_compte=:param1 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $resultat->bindParam(':param2', $param2);
        $param1 = $id_compte_rendu;
        $param2 = $code_intervenant;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['id_compte'] = $enregistrement['id_compte'];
        $infos['date_cours'] = $enregistrement['date_cours_effectute'];
        $heure_array = explode(':', $enregistrement['heure_cours']);
        if ($heure_array[0] < 10) {
            $infos['heure_cours'] = "0" . $heure_array[0] . ':' . $heure_array[1];
        } else {
            $infos['heure_cours'] = $enregistrement['heure_cours'];
        }

        $infos['e_coupon'] = $enregistrement['e_coupon'];
        $infos['progression_cours'] = $enregistrement['progression_cours'];
        $infos['eleve'] = html_entity_decode($enregistrement['nom_eleve']) . "." . html_entity_decode($enregistrement['prenom_eleve']);
        $infos['resume_compte_rendu'] = $enregistrement['resume_compte_rendu'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function list_alerte_bilan_trimestrielle($code_user) {
    global $cxn;
    $infos = array();
    /* 	try {
      $sql = " SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille
      FROM interventions,eleve_intervenant,membre_famille
      WHERE interventions.reference=eleve_intervenant.reference
      AND interventions.code_famille=membre_famille.code_famille
      AND  interventions.etat='traitement'
      AND eleve_intervenant.code_intervenant=:param
      AND  interventions.exigeance_bilan_trims='1' ";
      $resultat = $cxn->prepare ( $sql );
      $resultat->bindParam ( ':param', $param );
      $param = $code_user;
      $resultat->execute ();
      $i = 0;
      while ( $enregistrement = $resultat->fetch () ) {
      $infos [$i] ['reference_mission'] = $enregistrement ['reference'];
      $infos [$i] ['identite_famille'] = html_entity_decode($enregistrement['nom_famille']) . "." . html_entity_decode($enregistrement['prenom_famille']);
      $i ++;
      }
      } catch ( Exception $e ) {
      echo "Une erreur est survenue lors de la récupération des données";
      } */
    return $infos;
}

function infos_eleve($code_intervenant, $code_eleve) {
    global $cxn;
    try {
        $sql = "  SELECT eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve ";
        $sql .= "  FROM eleve_famille,eleve_intervenant WHERE ";
        $sql .= "  eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
        $sql .= "  AND eleve_intervenant.code_intervenant=:param1 ";
        $sql .= "  AND eleve_intervenant.code_eleve=:param2 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $resultat->bindParam(':param2', $param2);
        $param1 = $code_intervenant;
        $param2 = $code_eleve;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $identite_eleve = html_entity_decode($enregistrement ['nom_eleve']) . "." . html_entity_decode($enregistrement ['prenom_eleve']);
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $identite_eleve;
}

function list_alerte_date_premier_cours($code_user) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille 
                     FROM  interventions,eleve_intervenant,eleve_famille,membre_famille 
                     WHERE interventions.reference=eleve_intervenant.reference
					 AND   eleve_intervenant.code_eleve=eleve_famille.code_eleve  
					 AND   eleve_famille.code_famille=membre_famille.code_famille                   
                     AND   eleve_intervenant.statut='attente' 
                     AND   eleve_intervenant.code_intervenant=:param 
                     AND   interventions.exigeance_date_cours='1' 
                     AND   interventions.date_premier_cours=NULL ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_user;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $infos [$i] ['reference_mission'] = $enregistrement ['reference'];
            $infos [$i] ['identite_famille'] = html_entity_decode($enregistrement ['nom_famille']) . "." . html_entity_decode($enregistrement ['prenom_famille']);
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function list_alerte_bilan_premier_cours($code_user) {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille
                     FROM   interventions,eleve_intervenant,eleve_famille,membre_famille
                     WHERE  interventions.reference=eleve_intervenant.reference
                     AND    eleve_intervenant.code_eleve=eleve_famille.code_eleve  
					 AND    eleve_famille.code_famille=membre_famille.code_famille                   
                     AND    eleve_intervenant.statut='attente'
                     AND    eleve_intervenant.code_intervenant='" . $code_user . "'
                     AND    interventions.exigeance_bilan_cours='1'
                     AND    NOT EXISTS ( SELECT id_bilan    FROM  bilan_premier_cours  WHERE bilan_premier_cours.reference=interventions.reference  ) ";
        $select = $cxn->query($sql);
        $i = 0;
        while ($enregistrement = $select->fetch()) {
            $infos [$i] ['reference_mission'] = $enregistrement ['reference'];
            $infos [$i] ['identite_famille'] = html_entity_decode($enregistrement ['nom_famille']) . "." . html_entity_decode($enregistrement ['prenom_famille']);
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function liste_theme($code_intervenant, $code_eleve) {
    global $cxn;
    $liste = array();
    try {
        $sql = " SELECT id_theme,nom_theme  FROM liste_theme_intervenant  WHERE   code_intervenant=:param1  AND code_eleve=:param2  ORDER BY id_theme DESC";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $resultat->bindParam(':param2', $param2);
        $param1 = $code_intervenant;
        $param2 = $code_eleve;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste [$i] ['id_theme'] = $enregistrement ['id_theme'];
            $liste [$i] ['nom_theme'] = html_entity_decode($enregistrement ['nom_theme']);
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $liste;
}

function liste_progression() {
    global $cxn;
    $infos = array();
    try {
        $sql = " SELECT id_etat,nom_progression   FROM etat_progression_cours  ";
        $resultat = $cxn->prepare($sql);
        $resultat->execute();
        while ($enregistrement = $resultat->fetch()) {
            $key = $enregistrement ['id_etat'];
            $progression = $enregistrement ['nom_progression'];
            $infos [$key] = $progression;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

function detail_compte_rendu($post) {
    global $cxn;
    $objet = array();
    if (isset($post['id_compte_rendu']) && $post['mod'] == 'consultation_mes') {
        $sql = "  SELECT DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute,DATE_FORMAT(compte_rendu.date_cours,'%k:%i' ) AS heure_cours,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve,compte_rendu.recap_cours  AS resume_cours,compte_rendu.e_coupon AS e_coupon,etat_progression_cours.nom_progression AS nom_progression ";
        $sql .= " FROM compte_rendu,eleve_famille,etat_progression_cours  ";
        $sql .= "  WHERE compte_rendu.code_eleve=eleve_famille.code_eleve ";
        $sql .= " AND compte_rendu.progression_cours=etat_progression_cours.id_etat";
        $sql .= " AND compte_rendu.id_compte=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $post['id_compte_rendu'];
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $objet ['compte_rendu'] = array(
            'date_cours' => $enregistrement ['date_cours_effectute'],
            'heure_cours' => $enregistrement ['heure_cours'],
            'resume_cours' => html_entity_decode(stripslashes($enregistrement ['resume_cours'])),
            'e_coupon' => $enregistrement ['e_coupon'],
            'progression_cours' => $enregistrement ['nom_progression'],
            'eleve' => html_entity_decode($enregistrement ['nom_eleve']) . "." . html_entity_decode($enregistrement ['prenom_eleve'])
        );
    } elseif (isset($post['id_compte_rendu']) && $post['mod'] == 'consultation_autre') {
        $sql = "  SELECT DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve,compte_rendu.recap_cours  AS resume_cours,etat_progression_cours.nom_progression AS nom_progression ";
        $sql .= " FROM compte_rendu,eleve_famille,etat_progression_cours  ";
        $sql .= " WHERE compte_rendu.code_eleve=eleve_famille.code_eleve ";
        $sql .= " AND compte_rendu.progression_cours=etat_progression_cours.id_etat";
        $sql .= " AND compte_rendu.id_compte=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $post['id_compte_rendu'];
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $objet ['compte_rendu'] = array(
            'date_cours' => $enregistrement ['date_cours_effectute'],
            'resume_cours' => html_entity_decode(stripslashes($enregistrement ['resume_cours'])),
            'progression_cours' => $enregistrement ['nom_progression'],
            'eleve' => html_entity_decode($enregistrement ['nom_eleve']) . "." . html_entity_decode($enregistrement ['prenom_eleve'])
        );
    }
    return $objet;
}

function identite_eleve($code_intervenant, $code_eleve) {
    global $cxn;
    $identite_eleve = '';
    try {
        $sql = "  SELECT eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve ";
        $sql .= " FROM eleve_famille,eleve_intervenant WHERE ";
        $sql .= " eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
        $sql .= " AND eleve_intervenant.code_intervenant=:param1 AND  eleve_intervenant.code_eleve=:param2 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $param1 = $code_intervenant;
        $resultat->bindParam(':param2', $param2);
        $param2 = $code_eleve;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $identite_eleve = html_entity_decode($enregistrement ['nom_eleve']) . '.' . html_entity_decode($enregistrement ['prenom_eleve']);
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $identite_eleve;
}

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function check_compte_rendu($post) {
    $etat = TRUE;
    $objet = array();
    $date_actuel = date("Y-m-d");
    if (!isset($post['code_coupon']) || empty($post['code_coupon']) || strlen($post['code_coupon']) > 15) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur_code_coupon';
    }
    if (!isset($post['code_eleve']) || empty($post['code_eleve'])) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur_select_eleve';
    }
    if (!isset($post['theme_cours']) || empty($post['theme_cours'])) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur_theme_cours';
    }
    if (!isset($post['date_cours']) || empty($post['date_cours'])) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur_date_cours';
    }
    if (!preg_match('`(\d{4})-(\d{2})-(\d{2})`', $post['date_cours'])) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur_date_cours';
    }
    if ($post['date_cours'] > $date_actuel) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur_date_cours plus grand que la date actuel';
    }
    if (!isset($post['datetime_picker']) || empty($post['datetime_picker'])) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur1_datetime_picker';
    }
    if (!validateDate($post["datetime_picker"], 'H:i')) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur2_datetime_picker';
    }
    if (!isset($post['progression_cours']) || empty($post['progression_cours'])) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur1_progression_cours';
    } else {
        $prog_cours = array(
            "1",
            "2",
            "3"
        );
        if (!in_array($post['progression_cours'], $prog_cours)) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur2_progression_cours';
        }
    }

//    if (isset($post['compte_rendu']) && $post['compte_rendu'] == '&lt;div&gt;​&lt;/div&gt;') {
//        $etat = FALSE;
//        $objet ['message_debug'] [] = 'compte_rendu vide';
//    }
    if (!isset($post['compte_rendu']) || empty($post['compte_rendu'])) {
        $etat = FALSE;
        $objet ['message_debug'] [] = 'erreur1_compte_rendu';
    } else {
        if (strlen($post['compte_rendu']) > 300) {
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur2_compte_rendu';
        }
    }
    if ($etat) {
        $date_saisi = date("Y-m-d H:i:s");
        $date_cours = htmlentities(addslashes(trim($post['date_cours'])), ENT_QUOTES);
        $datetime_picker = htmlentities(addslashes(trim($post['datetime_picker'])), ENT_QUOTES);
        $date_cours = $date_cours . ' ' . $datetime_picker . ':00';
        $code_intervenant = $_SESSION ['membre'] ['code_intervenant'];
        $code_coupon = htmlentities(addslashes(trim($post['code_coupon'])), ENT_QUOTES);
        $code_eleve = htmlentities(addslashes(trim($post['code_eleve'])), ENT_QUOTES);
        $progression_cours = htmlentities(addslashes(trim($post['progression_cours'])), ENT_QUOTES);
        $compte_rendu = htmlentities(addslashes(trim($post['compte_rendu'])), ENT_QUOTES);
        $theme_cours = htmlentities(addslashes(trim($post['theme_cours'])), ENT_QUOTES);
        try {
            $sql = " SELECT e_coupon.id_coupon FROM e_coupon,facture_famille,eleve_intervenant WHERE e_coupon.N_facture=facture_famille.N_facture AND facture_famille.code_famille=eleve_intervenant.code_famille AND e_coupon.code_coupon='" . $code_coupon . "'  AND eleve_intervenant.code_eleve='" . $code_eleve . "'  AND  e_coupon.check_coupon='0' ";
            $select = $cxn->query($sql);
            $nb = $select->rowCount();
            if ($nb <= 0) {
                //$etat = FALSE;
                $objet ['message_debug'] [] = "erreur_id_coupon n'existe pas";
            }
        } catch (Exception $e) {
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es1';
            //echo "Une erreur est survenue lors de la rÃ©cupÃ©ration des donnÃ©es1";
        }
    }
    if ($etat) {
        /*         * ****************** verifier la date limite de code-coupon ***************** */

        try {
            $sql = " SELECT  date_limite FROM e_coupon   WHERE   code_coupon='" . $code_coupon . "' ";
            $resultat = $cxn->query($sql);
            $enregistrement = $resultat->fetch();
            if ($date_actuel > $enregistrement['date_limite']) {
               // $etat = FALSE;
                $objet ['message_debug'] [] = "la date limite de code coupon est depasse";
            }
        } catch (Exception $e) {
            $objet ['message_debug'] [] = 'erreur_identification des donnÃ©es1';
            //echo "Une erreur est survenue lors de la rÃ©cupÃ©ration des donnÃ©es1";
        }
    }
    if ($etat) {
        try {
            $stmt = $cxn->prepare("INSERT INTO compte_rendu (date_cours,date_saisi,recap_cours,e_coupon,code_intervenant,code_eleve,progression_cours,theme_cours) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8)");
            $stmt->bindParam(':param1', $datecours);
            $stmt->bindParam(':param2', $datesaisi);
            $stmt->bindParam(':param3', $compterendu);
            $stmt->bindParam(':param4', $codecoupon);
            $stmt->bindParam(':param5', $codeintervenant);
            $stmt->bindParam(':param6', $codeeleve);
            $stmt->bindParam(':param7', $progressioncours);
            $stmt->bindParam(':param8', $themecours);
            // insertion d'une ligne
            $datecours = $date_cours;
            $datesaisi = $date_saisi;
            $compterendu = $compte_rendu;
            $codecoupon = $code_coupon;
            $codeintervenant = $code_intervenant;
            $codeeleve = $code_eleve;
            $progressioncours = $progression_cours;
            $themecours = $theme_cours;
            $stmt->execute();
        } catch (Exception $e) {
            //echo "Une erreur est survenue lors de la rÃ©cupÃ©ration des donnÃ©es";
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_insertion des donnÃ©es2';
        }
    }
    if ($etat) {
        try {
            $stmt = $cxn->prepare("UPDATE  e_coupon SET check_coupon='1'  WHERE code_coupon=:param ");
            $stmt->bindParam(':param', $code);
            $code = $code_coupon;
            $stmt->execute();
        } catch (Exception $e) {
            //	echo "Une erreur est survenue lors de la exuction la requete";
            $etat = FALSE;
            $objet ['message_debug'] [] = 'erreur_UPDATE de donnee';
        }
    }


    return $etat;
}

?>    