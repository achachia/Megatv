<?php

/* * *************************** */

function chargement_module($module) {
    echo $module;
    //require $module.".php";
    //include root_web."/vues/template.php";
}

/* * *************************** */

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

/* * *************************** */

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

/* * *************************** */

function list_alerte_bilan_trimestrielle($code_user) {
    global $cxn;
    $infos = array();
    /*
     * try {
     * $sql = " SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom AS prenom_famille
     * FROM interventions,eleve_intervenant,membre_famille
     * WHERE interventions.reference=eleve_intervenant.reference
     * AND interventions.code_famille=membre_famille.code_famille
     * AND interventions.etat='traitement'
     * AND eleve_intervenant.code_intervenant=:param
     * AND interventions.exigeance_bilan_trims='1' ";
     * $resultat = $cxn->prepare ( $sql );
     * $resultat->bindParam ( ':param', $param );
     * $param = $code_user;
     * $resultat->execute ();
     * $i = 0;
     * while ( $enregistrement = $resultat->fetch () ) {
     * $infos [$i] ['reference_mission'] = $enregistrement ['reference'];
     * $infos [$i] ['identite_famille'] = html_entity_decode($enregistrement['nom_famille']) . "." . html_entity_decode($enregistrement['prenom_famille']);
     * $i ++;
     * }
     * } catch ( Exception $e ) {
     * echo "Une erreur est survenue lors de la récupération des données";
     * }
     */
    return $infos;
}

/* * *************************** */

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

/* * *************************** */

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

/* * **************************************************** */

function date_premier_cours($reference) {
    global $cxn;
    $infos = array();
    try {
        $sql = "  SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille ";
        $sql .= " FROM  interventions,eleve_intervenant,eleve_famille,membre_famille ";
        $sql .= " WHERE interventions.reference=eleve_intervenant.reference ";
        $sql .= " AND   eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
        $sql .= " AND   eleve_famille.code_famille=membre_famille.code_famille ";
        $sql .= " AND   eleve_intervenant.statut='attente' ";
        $sql .= " AND   interventions.reference='" . $reference . "' ";
        $sql .= " AND   interventions.exigeance_date_cours='1' ";
        $sql .= " AND   interventions.date_premier_cours=NULL ";
        $resultat = $cxn->query($sql);
        $nb = $resultat->rowCount();
        if ($nb > 0) {
            $enregistrement = $resultat->fetch();
            $infos ['reference_mission'] = $enregistrement ['reference'];
            $infos ['identite_famille'] = html_entity_decode($enregistrement ['nom_famille']) . "." . html_entity_decode($enregistrement ['prenom_famille']);
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

/* * **************************************************** */

function bilan_premier_cours($reference) {
    global $cxn;
    $infos = array();
    try {
        $sql = "    SELECT interventions.reference,membre_famille.nom AS nom_famille,membre_famille.prenom  AS prenom_famille";
        $sql .= "   FROM  interventions,eleve_intervenant,eleve_famille,membre_famille ";
        $sql .= "   WHERE interventions.reference=eleve_intervenant.reference ";
        $sql .= "   AND   eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
        $sql .= "   AND   eleve_famille.code_famille=membre_famille.code_famille ";
        $sql .= "   AND   eleve_intervenant.statut='attente' ";
        $sql .= "   AND   interventions.reference='" . $reference . "'  ";
        $sql .= "   AND   interventions.exigeance_bilan_cours='1'  ";
        $sql .= "   AND   NOT EXISTS ( SELECT id_bilan    FROM bilan_premier_cours  WHERE bilan_premier_cours.reference='" . $reference . "' ) ";
        $resultat = $cxn->query($sql);
        $nb = $resultat->rowCount();
        if ($nb > 0) {
            $enregistrement = $resultat->fetch();
            $infos ['reference_mission'] = $enregistrement ['reference'];
            $infos ['identite_famille'] = html_entity_decode($enregistrement ['nom_famille']) . "." . html_entity_decode($enregistrement ['prenom_famille']);
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

/* * **************************************************** */

function liste_eleves($code_intervenant) {
    global $cxn;
    $liste = array();
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
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_intervenant;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste [$i] ['code_eleve'] = $enregistrement ['code_eleve'];
            $liste [$i] ['identite_eleve'] = html_entity_decode($enregistrement ['nom_eleve']) . "." . html_entity_decode($enregistrement ['prenom_eleve']);
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
                    $infos_date_premier_cours = date_premier_cours($reference_intervention);
                    if (sizeof($infos_date_premier_cours) > 0) {
                        $saisir_date_premier_cours = "<span class='glyphicon glyphicon-edit'> Date 1er cours</span>";
                        $lien3 = 'index.php?module=action_membre&action=saisir_date_premier_cours&reference_mission=' . $infos_date_premier_cours ['reference_mission'] . '&identite_famille=' . $infos_date_premier_cours ['identite_famille'];
                        $liste [$i] ['action'] [$saisir_date_premier_cours] = $lien3;
                    }
                    // //////////// saisir le bilan de premier cours/////////////////////////////
                    $infos_bilan_premier_cours = bilan_premier_cours($reference_intervention);
                    if (sizeof($infos_bilan_premier_cours) > 0) {
                        $saisir_bilan_premier_cours = "<span class='glyphicon glyphicon-edit'> Bilan 1er cours</span>";
                        $lien4 = "index.php?module=action_membre&action=saisir_bilan_premier_cours&reference_mission=" . $infos_bilan_premier_cours ['reference_mission'] . "&identite_famille=" . $infos_bilan_premier_cours ['identite_famille'];
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
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $liste;
}

/* * ******************************************* */

function infos_eleve($code_intervenant, $code_eleve) {
    global $cxn;
    $infos = array();
    try {
        $sql = "SELECT eleve_famille.nom  AS nom_eleve,eleve_famille.prenom  AS prenom_eleve,eleve_famille.tel_portable  AS tel_portable,liste_niveau_option.nom_option AS niveau_peda, ";
        $sql .= " membre_famille.nom  AS nom_famille,membre_famille.prenom  AS prenom_famille,membre_famille.telephone_portable  AS tel_portable_famille,membre_famille.telephone_fixe AS tel_fixe_famille,membre_famille.telephone_travail AS tel_travail_famille,membre_famille.adresse AS adresse,";
        $sql .= " membre_famille.adresse_suite  AS adresse_suite,membre_famille.code_postale  AS code_postale";
        $sql .= " FROM membre_famille,eleve_famille,eleve_intervenant,liste_niveau_option WHERE ";
        $sql .= " eleve_intervenant.code_eleve=eleve_famille.code_eleve ";
        $sql .= "  AND eleve_famille.niveau_peda=liste_niveau_option.id_option ";
        $sql .= " AND membre_famille.code_famille=eleve_famille.code_famille ";
        $sql .= "AND eleve_intervenant.code_intervenant=:param1 AND  eleve_intervenant.statut IN('confirme','attente') AND eleve_intervenant.code_eleve=:param2 ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $param1 = $code_intervenant;
        $resultat->bindParam(':param2', $param2);
        $param2 = $code_eleve;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos ['nom_eleve'] = html_entity_decode($enregistrement ['nom_eleve']);
        $infos ['prenom_eleve'] = html_entity_decode($enregistrement ['prenom_eleve']);
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
        $sql1 = "SELECT * FROM dispo_hebdo_eleve WHERE code_eleve=:param3 ";
        $resultat1 = $cxn->prepare($sql1);
        $resultat1->bindParam(':param3', $param3);
        $param3 = $code_eleve;
        $resultat1->execute();
        $j = 0;
        while ($enregistrement1 = $resultat1->fetch()) {
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
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $infos;
}

/* * ************** identite eleve ************************ */

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

/* * ************************************************** */

function bilan_prestation_eleve($code_intervenant, $code_eleve) {
    global $cxn;
    $liste = array();
    try {
        $sql = "  SELECT e_coupon.code_coupon AS E_code,DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute ";
        $sql .= " FROM e_coupon,eleve_intervenant,facture_famille,compte_rendu  WHERE ";
        $sql .= " eleve_intervenant.code_eleve=facture_famille.code_eleve ";
        $sql .= " AND e_coupon.N_facture=facture_famille.N_facture ";
        $sql .= " AND e_coupon.code_coupon=compte_rendu.e_coupon ";
        $sql .= " AND eleve_intervenant.code_intervenant=:param1  ";
        $sql .= " AND eleve_intervenant.code_eleve=:param2  ";
        $sql .= " AND e_coupon.check_coupon='1'  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $param1 = $code_intervenant;
        $resultat->bindParam(':param2', $param2);
        $param2 = $code_eleve;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $liste [$i] ['E_code'] = $enregistrement ['E_code'];
            $liste [$i] ['date_cours_effectute'] = $enregistrement ['date_cours_effectute'];
            $i ++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $liste;
}

/* * *************************************** */

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

/* * *********************************************** */

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

/* * ***************** */

function infos_intervenant($code_intervenant) {

    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT civilite,nom,prenom,date_naissance,tel_fixe,tel_portable,email,fax,adresse,adresse_suite,site_web,CP,ville,pays,numero_sec_sc,banque,cle_rib,n_compte,guichet FROM intervenants WHERE code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_intervenant;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['civilité'] = $enregistrement['civilite'];
        $infos['nom'] = $enregistrement['nom'];
        $infos['prenom'] = $enregistrement['prenom'];
        $infos['date_naissance'] = $enregistrement['date_naissance'];
        $infos['tel_fixe'] = $enregistrement['tel_fixe'];
        $infos['tel_portable'] = $enregistrement['tel_portable'];
        $infos['fax'] = $enregistrement['fax'];
        $infos['email'] = $enregistrement['email'];
        $infos['site_web'] = $enregistrement['site_web'];
        $infos['adresse'] = $enregistrement['adresse'];
        $infos['adresse_suite'] = $enregistrement['adresse_suite'];
        $infos['code_postale'] = $enregistrement['CP'];
        $infos['ville'] = $enregistrement['ville'];
        $infos['pays'] = $enregistrement['pays'];
        $infos['numero_sec_sc'] = $enregistrement['numero_sec_sc'];
        $infos['banque'] = $enregistrement['banque'];
        $infos['cle_rib'] = $enregistrement['cle_rib'];
        $infos['guichet'] = $enregistrement['guichet'];
        $infos['n_compte'] = $enregistrement['n_compte'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

/* * *********************************************** */

function liste_plannig_intervenant($code_intervenant) {
    global $cxn;
    try {
        $sql = " SELECT * FROM dispo_hebdo_intervenant WHERE code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {

            while ($enregistrement = $select->fetch()) {
                $periode = $enregistrement['periode'];
                $diponibilite[$periode]['lundi'] = $enregistrement['lundi'];
                $diponibilite[$periode]['mardi'] = $enregistrement['mardi'];
                $diponibilite[$periode]['mercredi'] = $enregistrement['mercredi'];
                $diponibilite[$periode]['jeudi'] = $enregistrement['jeudi'];
                $diponibilite[$periode]['vendredi'] = $enregistrement['vendredi'];
                $diponibilite[$periode]['samedi'] = $enregistrement['samedi'];
                $diponibilite[$periode]['dimanche'] = $enregistrement['dimanche'];
            }
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }

    return $diponibilite;
}

/* * *************** infos contact famille*********************** */

function infos_famille_contact($code_intervenant) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT DISTINCT membre_famille.nom AS nom,membre_famille.prenom AS prenom,membre_famille.code_famille  AS code_famille FROM eleve_intervenant,membre_famille,eleve_famille WHERE eleve_famille.code_eleve=eleve_intervenant.code_eleve AND  eleve_intervenant.code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_intervenant;
        $resultat->execute();
        $i = 0;
        while ($enregistrement = $resultat->fetch()) {
            $infos[$i]['famille'] = html_entity_decode($enregistrement['nom']) . "." . html_entity_decode($enregistrement['prenom']);
            $infos[$i]['code_famille'] = $enregistrement['code_famille'];
            $i++;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

/* * ******************* infos conseiller contact ***************** */

function infos_conseiller_contact($code_intervenant) {
    global $cxn;
    $infos = array();
    // Récupération des données
    try {
        // requete prepare
        $sql = " SELECT nom,prenom,conseiller_peda.code_conseiller  AS code FROM eleve_intervenant,conseiller_peda WHERE conseiller_peda.code_conseiller=eleve_intervenant.code_conseiller AND    code_intervenant=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_intervenant;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $infos['conseiller_peda'] = html_entity_decode($enregistrement['nom']) . "." . html_entity_decode($enregistrement['prenom']);
        $infos['code_conseiller'] = $enregistrement['code_conseiller'];
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

/* * *********** infos compte rendu ************************** */

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
        $infos['resume_compte_rendu'] = html_entity_decode(stripslashes($enregistrement['resume_compte_rendu']));
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $infos;
}

/* * ******************************* */

function validateDate_time($date, $format = 'H:i') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

/* * ************************************ */

function update_compte_rendu($var) {
    global $cxn;
    $etat = TRUE;
    $objet = array();
    if (empty($var["code_coupon"]) || strlen($var["code_coupon"]) > 15) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le code coupon soit vide ou il depasse 15 caractere';
    } else {
        $code_coupon = htmlentities(addslashes(trim($var['code_coupon'])), ENT_QUOTES);
        try {
            // On envois la requète
            $sql = " SELECT id_coupon FROM e_coupon WHERE  code_coupon='" . $code_coupon . "' AND  check_coupon='1' ";
            $select = $cxn->query($sql);

            // On indique que nous utiliserons les résultats en tant qu'objet
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $etat = FALSE;
            $objet['message_debug'][] = 'le code coupon nexiste pas dans la table e_coupon avec check_coupon=1';
        }
    }
    if (!isset($var['id_compte_rendu']) || empty($var["id_compte_rendu"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le id_compte_rendu n\'existe pas ou bien il est vide';
    } else {
        $id_compte_rendu = htmlentities(addslashes(trim($var['id_compte_rendu'])), ENT_QUOTES);
        try {
            // On envois la requète
            $sql = " SELECT id_compte FROM compte_rendu WHERE  id_compte='" . $id_compte_rendu . "'  AND code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "'  ";
            $select = $cxn->query($sql);

            // On indique que nous utiliserons les résultats en tant qu'objet
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $etat = FALSE;
            $objet['message_debug'][] = 'le id_compte n\'existe pas dans la table compte rendu';
        }
    }
    if (!isset($var['date_cours']) || empty($var["date_cours"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ date_cours n\'existe pas ou bien vide';
    }
    if (!preg_match('`(\d{4})-(\d{2})-(\d{2})`', $var["date_cours"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ date_cours est non valide';
    }
    if (!isset($var['datetime_picker']) || empty($var["datetime_picker"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ datetimepicker n\'existe pas ou bien vide';
    }
    if (!validateDate_time($var["datetime_picker"], 'H:i')) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ datetimepicker non valide';
    }
    if (!isset($var['progression_cours']) || empty($var["progression_cours"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ progression_cours n\'existe pas ou bien vide';
    } else {
        $prog_cours = array("1", "2", "3");
        if (!in_array($var["progression_cours"], $prog_cours)) {
            $etat = FALSE;
            $objet['message_debug'][] = 'le champ progression_cours ne vaut pas ni 1 ni 2 ni 3';
        }
    }
    if (!isset($var['compte_rendu']) || empty($var["compte_rendu"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ compte_rendu n\'existe pas ou bien vide';
    } else {
        if (strlen($var["compte_rendu"]) > 300) {
            $etat = FALSE;
            $objet['message_debug'][] = 'le champ compte_rendu depasse 300 caracteres';
        }
    }
    if ($etat) {
        $date_modification = date("Y-m-d H:i:s");
        $date_cours = htmlentities(addslashes(trim($var['date_cours'])), ENT_QUOTES);
        $datetime_picker = htmlentities(addslashes(trim($var['datetime_picker'])), ENT_QUOTES);
        $date_cours = $date_cours . ' ' . $datetime_picker . ':00';
        $progression_cours = htmlentities(addslashes(trim($var['progression_cours'])), ENT_QUOTES);
        $compte_rendu = htmlentities(addslashes(trim($var['compte_rendu'])), ENT_QUOTES);
        $id_compte_rendu = htmlentities(addslashes(trim($var['id_compte_rendu'])), ENT_QUOTES);
        try {
            $stmt = $cxn->prepare(" UPDATE  compte_rendu SET date_cours=:param1 ,date_modification=:param2,recap_cours=:param3,progression_cours=:param4 WHERE id_compte=:param5 ");
            $stmt->bindParam(':param1', $datecours);
            $stmt->bindParam(':param2', $datesaisi);
            $stmt->bindParam(':param3', $compterendu);
            $stmt->bindParam(':param4', $progressioncours);
            $stmt->bindParam(':param5', $id_compte);
            // insertion d'une ligne          
            $datecours = $date_cours;
            $datesaisi = $date_modification;
            $compterendu = $compte_rendu;
            $progressioncours = $progression_cours;
            $id_compte = $id_compte_rendu;
            $stmt->execute();
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
            $etat = FALSE;
            $objet['message_debug'][] = 'la requette  UPDATE a echoué';
        }
    }
    return $etat;
}

/* * ************************************************* */

function generer_token() {
    global $cxn;
    $token = uniqid(md5(rand()), true);
    $agent = TRUE;
    while ($agent) {
        $sql = "SELECT token FROM message_recus  WHERE token='" . $token . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $token = uniqid(md5(rand()), true);
        } else {
            $agent = FALSE;
        }
    }
    return $token;
}

/* * ******************************* */

function post_msg_famille($var) {
    global $cxn;
    $etat = TRUE;
    $objet = array();
    if (!isset($var['code_distinataire']) || empty($var["code_distinataire"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ code_distinataire n\'existe pas ou bien vide';
    }
    if (isset($var['code_distinataire']) && !empty($var["code_distinataire"])) {
        $code_distinataire = htmlentities(addslashes(trim($var['code_distinataire'])), ENT_QUOTES);
        try {
            // On envois la requète
            $sql = " SELECT DISTINCT eleve_famille.code_famille  AS code_famille FROM eleve_intervenant,eleve_famille WHERE eleve_famille.code_eleve=eleve_intervenant.code_eleve AND  eleve_intervenant.code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "'  AND eleve_famille.code_famille='" . $code_distinataire . "' ";
            $select = $cxn->query($sql);
            $nb = $select->rowCount();
            if ($nb <= 0) {
                $etat = FALSE;
                $objet['message_debug'][] = 'le distinataire n\'existe pas dans la table conseiller_peda';
            }
            // On indique que nous utiliserons les résultats en tant qu'objet
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données1";
        }
    }
    if (!isset($var['objet_message']) || empty($var["objet_message"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ objet_message n\'existe pas ou bien vide';
    }
    if (!isset($var['message']) || empty($var["message"])) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le champ message n\'existe pas ou bien vide';
    }
    if ($etat) {
        $date = date("Y-m-d H:i:s");
        $objet_message = htmlentities(addslashes(trim($var['objet_message'])), ENT_QUOTES);

        $message = htmlentities(addslashes(trim($var['message'])), ENT_QUOTES);

        $code_distinataire = htmlentities(addslashes(trim($var['code_distinataire'])), ENT_QUOTES);

        $code_expediteur = $_SESSION['membre']['code_intervenant'];
        $token = generer_token();
        try {
            $cxn->beginTransaction();
            // table message envoyé
            $sql = " INSERT INTO  message_envoye (objet,message,date,expediteur,destinataire,token) VALUES ('" . $objet_message . "','" . $message . "','" . $date . "','" . $code_expediteur . "','" . $code_destinataire . "','" . $token . "') ";
            $cxn->query($sql);
            // table message recus
            $sql = " INSERT INTO  message_recus (objet,message,date_envoi,expediteur,destinataire,token) VALUES ('" . $objet_message . "','" . $message . "','" . $date . "','" . $code_expediteur . "','" . $code_destinataire . "','" . $token . "') ";
            //$cxn->query($sql);
            $cxn->commit();
        } catch (Exception $e) {
            $cxn->rollback();
            echo "Une erreur est survenue lors de la récupération des données";
            $etat = FALSE;
            $objet['message_debug'][] = 'la requette  INSERT a echoué pour la table message_envoye';
        }
    }
    return $etat;
}

/* * ******************nombre message lus ******************** */

function nombre_messages_non_lus($code_user) {
    global $cxn;
    try {
        $sql = " SELECT id_message FROM message_recus WHERE etat='0' AND destinataire='" . $code_user . "' ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $nombre_message = $nb;
        } else {
            $nombre_message = 0;
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    return $nombre_message;
}

/* * ******* check date *************** */

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

/* * ************ check compte rendu ********************** */

function check_compte_rendu($post) {
    global $cxn;
    $etat = TRUE;
    $reponse = FALSE;
    $objet = array();
    $date_actuel = date("Y-m-d");
    if (isset($post ['code_coupon'])) {
        if (!isset($post ['code_coupon']) || empty($post ["code_coupon"]) || strlen($post ["code_coupon"]) > 15) {
            $etat = FALSE;
        }
        if (!isset($post ['code_eleve']) || empty($post ["code_eleve"])) {
            $etat = FALSE;
        }
        if (!isset($post ['theme_cours']) || empty($post ["theme_cours"])) {
            $etat = FALSE;
        }
        if (!isset($post ['date_cours']) || empty($post ["date_cours"])) {
            $etat = FALSE;
        }
        if (!preg_match('`(\d{4})-(\d{2})-(\d{2})`', $post ["date_cours"])) {
            $etat = FALSE;
        }
        if ($post ["date_cours"] > $date_actuel) {
            $etat = FALSE;
        }
        if (!isset($post ['datetime_picker']) || empty($post ["datetime_picker"])) {
            $etat = FALSE;
        }
        if (!validateDate($post ["datetime_picker"], 'H:i')) {
            $etat = FALSE;
        }
        if (!isset($post ['progression_cours']) || empty($post ["progression_cours"])) {
            $etat = FALSE;
        } else {
            $prog_cours = array(
                "1",
                "2",
                "3"
            );
            if (!in_array($post ["progression_cours"], $prog_cours)) {
                $etat = FALSE;
            }
        }
        if (!isset($post ['compte_rendu']) || empty($post ["compte_rendu"])) {
            $etat = FALSE;
        } else {
            if (strlen($post ["compte_rendu"]) > 300) {
                $etat = FALSE;
            }
        }
        if ($etat) {
            $date_saisi = date("Y-m-d H:i:s");
            $date_cours = htmlentities(addslashes(trim($post ['date_cours'])), ENT_QUOTES);
            $datetime_picker = htmlentities(addslashes(trim($post ['datetime_picker'])), ENT_QUOTES);
            $date_cours = $date_cours . ' ' . $datetime_picker . ':00';
            $code_intervenant = $_SESSION ['membre'] ['code_intervenant'];
            $code_coupon = htmlentities(addslashes(trim($post ['code_coupon'])), ENT_QUOTES);
            $code_eleve = htmlentities(addslashes(trim($post ['code_eleve'])), ENT_QUOTES);
            $progression_cours = htmlentities(addslashes(trim($post ['progression_cours'])), ENT_QUOTES);
            $compte_rendu = htmlentities(addslashes(trim($post ['compte_rendu'])), ENT_QUOTES);
            $theme_cours = htmlentities(addslashes(trim($post ['theme_cours'])), ENT_QUOTES);
            try {
                // On envois la requète
                $sql = " SELECT e_coupon.id_coupon FROM e_coupon,facture_famille,eleve_intervenant WHERE e_coupon.N_facture=facture_famille.N_facture AND facture_famille.code_famille=eleve_intervenant.code_famille AND e_coupon.code_coupon='" . $code_coupon . "'  AND eleve_intervenant.code_eleve='" . $code_eleve . "'  AND  e_coupon.check_coupon='0' ";
                $select = $cxn->query($sql);
                $nb = $select->rowCount();
                if ($nb <= 0) {
                    $etat = FALSE;
                }
            } catch (Exception $e) {
                $etat = FALSE;
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
                //  $stmt->execute();
            } catch (Exception $e) {
                $etat = FALSE;
            }
        }
        if ($etat) {
            try {
                $stmt = $cxn->prepare("UPDATE  e_coupon SET check_coupon='1'  WHERE code_coupon=:param ");
                $stmt->bindParam(':param', $code);
                $code = $code_coupon;
                //$stmt->execute();
            } catch (Exception $e) {
                $etat = FALSE;
            }
        }
        if ($etat) {
            $reponse = TRUE;
        }
    }
    return $reponse;
}

/* * ************************************************* */

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

/* * *****  infos mes comptes-rendus****************** */

function detail_compte_rendu($post) {
    global $cxn;
    $objet = array();
    if (isset($post ['id_compte_rendu']) && $post ['mod'] == 'consultation_mes') {
        $sql = "  SELECT DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute,DATE_FORMAT(compte_rendu.date_cours,'%k:%i' ) AS heure_cours,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve,compte_rendu.recap_cours  AS resume_cours,compte_rendu.e_coupon AS e_coupon,etat_progression_cours.nom_progression AS nom_progression ";
        $sql .= " FROM compte_rendu,eleve_famille,etat_progression_cours  ";
        $sql .= "  WHERE compte_rendu.code_eleve=eleve_famille.code_eleve ";
        $sql .= " AND compte_rendu.progression_cours=etat_progression_cours.id_etat";
        $sql .= " AND compte_rendu.id_compte=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $post ['id_compte_rendu'];
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
    } elseif (isset($post ['id_compte_rendu']) && $post ['mod'] == 'consultation_autre') {
        $sql = "  SELECT DATE_FORMAT(compte_rendu.date_cours,'%Y-%m-%d' ) AS date_cours_effectute,eleve_famille.nom AS nom_eleve,eleve_famille.prenom AS prenom_eleve,compte_rendu.recap_cours  AS resume_cours,etat_progression_cours.nom_progression AS nom_progression ";
        $sql .= " FROM compte_rendu,eleve_famille,etat_progression_cours  ";
        $sql .= " WHERE compte_rendu.code_eleve=eleve_famille.code_eleve ";
        $sql .= " AND compte_rendu.progression_cours=etat_progression_cours.id_etat";
        $sql .= " AND compte_rendu.id_compte=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $post ['id_compte_rendu'];
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


?>