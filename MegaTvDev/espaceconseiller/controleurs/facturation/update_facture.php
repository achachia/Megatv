<?php

session_start();
session_regenerate_id();
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
require_once './../../librairie/generer_code.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$liste_erreurs = array();
$objet = array();
$N_facture = unhtmlentities($_POST ['N_facture']);
$date_facture = unhtmlentities($_POST ['date_facture']);
$date_excusion = unhtmlentities($_POST ['date_excusion']); //0000-00-00  2015-02-28
$application_remise = unhtmlentities($_POST ['application_remise']);
$prix_heure = unhtmlentities($_POST ['prix_heure_HT']);
$nb_heure = unhtmlentities($_POST ['nb_heure']);
$mode_paiement = unhtmlentities($_POST ['mod_paiement']);
$paiement_cpt_rec_facture = (isset($_POST ['paiement_cpt_rec_facture'])) ? '1' : '0';
$code_famille = unhtmlentities($_POST ['choix_famille']);
$code_eleve = unhtmlentities($_POST ['choix_eleve']);
$id_model_coupon = unhtmlentities($_POST ['modele_coupon']);
$designation_facture = unhtmlentities($_POST ['designation_facture']);
$objet_facture = unhtmlentities($_POST ['objet_facture']);
$type_prestation = unhtmlentities($_POST ['type_prestation']);
if (isset($_POST ['valeur_acompte']) && $_POST ['valeur_acompte'] != '0') {
    $acompte = array();
    $date_acompte = unhtmlentities($_POST ['date_acompte']);
    $objet_acompte = unhtmlentities($_POST ['objet_acompte']);
    $designation_acompte = unhtmlentities($_POST ['designation_acompte']);
    $mode_paiement = unhtmlentities($_POST ['mod_paiement_acompte']);
    $total_acompte = unhtmlentities($_POST ['valeur_acompte']);
}
$type_remise = NULL;
$valeur_remise = NULL;

// 1. controle de saisie

if ($date_excusion == '' || $date_facture == '' || $nb_heure == '0' || $application_remise == '' || $mode_paiement == '' || $code_famille == '' || $code_eleve == '' || $id_model_coupon == '' || $type_prestation == '' || $designation_facture == '' || $prix_heure == '0' || $objet_facture == '') {
    if ($date_facture == '') {
        $liste_erreurs [] = 'Le champ date facture  doit etre renseigne';
    }
    if ($date_excusion == '') {
        $liste_erreurs [] = 'Le champ date excusion doit etre renseigne';
    }
    if ($nb_heure == '0') {
        $liste_erreurs [] = 'Le champ Nombre heure  doit etre renseigne';
    }
    if ($mode_paiement == '') {
        $liste_erreurs [] = 'Le champ Mode de paiement  doit etre renseigne';
    }
    if ($code_famille == '') {
        $liste_erreurs [] = 'Le champ Identite famille  doit etre renseigne';
    }
    if ($code_eleve == '') {
        $liste_erreurs [] = 'Le champ Identite eleve  doit etre renseigne';
    }
    if ($id_model_coupon == '') {
        $liste_erreurs [] = 'Le champ Modele de coupon  doit etre renseigne';
    }
    if ($type_prestation == '') {
        $liste_erreurs [] = 'Le champ Type prestation  doit etre renseigne';
    }
    if ($objet_facture == '') {
        $liste_erreurs [] = 'Le champ Objet facture  doit etre renseigne';
    }
    if ($designation_facture == '') {
        $liste_erreurs [] = 'Le champ Designation facture  doit etre renseigne';
    }
    if ($prix_heure == '') {
        $liste_erreurs [] = 'Le champ Total facture  doit etre renseigne';
    }
    $etat = FALSE;
}
if ($etat) {
    if ($date_excusion < $date_facture) {
        $liste_erreurs [] = 'Le champ date facture  doit etre inferieur ou egale au date excution';
    }
}
if ($application_remise == '1') {
    $type_remise = unhtmlentities($_POST ['type_remise']);
    if ($type_remise == '') {
        $liste_erreurs [] = 'Le champ Genre de remise  doit etre renseigne';
        $etat = FALSE;
    } else {
        $valeur_remise = unhtmlentities($_POST ['valeur_remise']);
        if ($valeur_remise == '0') {
            $liste_erreurs [] = 'Le champ Valeur de remise  doit etre renseigne';
            $etat = FALSE;
        }
    }
}
if ($etat) {
    /*     * ******************Duree de coupon pour calculer le nombre de cours *************************** */
    try {
        $sql = " SELECT dure FROM model_coupon WHERE id_model=:param ";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param', $param);
        $param = $id_model_coupon;
        $stmt->execute();
        $enregistrement = $stmt->fetch();
        $nb_cours = $nb_heure / $enregistrement ['dure'];
        $nb_cours = intval($nb_cours);
        if (!is_int($nb_cours)) {
            $etat = FALSE;
            $liste_erreurs [] = 'Le nombre de cours n\est pas un entier';
            $liste_erreurs [] = $nb_cours;
        }
    } catch (Exception $ex) {
        $etat = FALSE;
        $liste_erreurs [] = 'requette4';
    }
}

if ($etat) {
    $facture = array();
    $facture [':N_facture'] = $N_facture;
    $facture [':date_facture'] = $date_facture;
    $facture [':date_excusion'] = $date_excusion;
    $facture [':PrixHT'] = $prix_heure;
    $facture [':Qte'] = $nb_heure;
    $facture [':genre_remise'] = $type_remise;
    $facture [':remise'] = $valeur_remise;
    $facture [':mode_paiement'] = $mode_paiement;
    $facture [':paie_cpt_recp_facture'] = $paiement_cpt_rec_facture;
    $facture [':code_famille'] = $code_famille;
    $facture [':code_eleve'] = $code_eleve;
    $facture [':objet_facture'] = $objet_facture;
    $facture [':id_model'] = $id_model_coupon;

    /**
     * **** Total paye HT apres la remise [espece ou pourcentage ***
     */
    $facture [':total_paye'] = $prix_heure * $nb_heure;
    if ($type_remise == 'espece') {
        $prix_heure_reduit = $prix_heure - $valeur_remise;
        $facture [':total_paye'] = $prix_heure_reduit * $nb_heure;
    }
    if ($type_remise == 'pourcentage') {
        $facture [':total_paye'] = $prix_heure * $nb_heure * (1 - $valeur_remise / 100);
    }

    /**
     * *****************************
     */
    $facture [':designation'] = $designation_facture;


    try {
        $cxn->beginTransaction();

        /*         * ********************Intersion les informations de la facture dans la base de donne ************************** */
//        $sql = "INSERT INTO facture_famille (N_facture,date_facture,date_excution,PrixHT,Qte,genre_remise,remise,mode_paiement,paie_cpt_recp_facture,code_famille,code_eleve,objet_facture,id_model,total_paye,designation) VALUES ('". $facture [':N_facture']."','". $facture [':date_facture']."','". $facture [':date_excusion']."','". $facture [':PrixHT']."','". $facture [':Qte']."','". $facture [':genre_remise']."','". $facture [':remise']."','". $facture [':mode_paiement']."','". $facture [':paie_cpt_recp_facture']."','". $facture [':code_famille']."','". $facture [':code_eleve']."','". $facture [':objet_facture']."','". $facture [':id_model']."','". $facture [':total_paye']."','". $facture [':designation']."')";           
//        $select = $cxn->query ( $sql);
        //$etat = FALSE;




        $sql = "INSERT INTO facture_famille (N_facture,date_facture,date_excution,PrixHT,Qte,genre_remise,remise,mode_paiement,paie_cpt_recp_facture,code_famille,code_eleve,objet_facture,id_model,total_paye,designation) VALUES (:N_facture,:date_facture,:date_excusion,:PrixHT,:Qte,:genre_remise,:remise,:mode_paiement,:paie_cpt_recp_facture,:code_famille,:code_eleve,:objet_facture,:id_model,:total_paye,:designation)";
        $stmt = $cxn->prepare($sql);
        $text = '';
        foreach ($facture as $key => $value) {
        /*    if (is_null($value)) { */
                switch (true) {
                    case is_bool($value) :
                        $var_type = PDO::PARAM_BOOL;
                        break;
                    case is_int($value) :
                        $var_type = PDO::PARAM_INT;
                        break;
                    case is_null($value) :
                        $var_type = PDO::PARAM_NULL;
                        break;
                    default :
                        $var_type = PDO::PARAM_STR;
                }
        /*    } */
            $stmt->bindValue($key, $value, $var_type);
        }
        $stmt->execute();
        /* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
        if (isset($_POST ['valeur_acompte']) && $_POST ['valeur_acompte'] != '0') {
            $acompte [':N_acompte'] = generer_code_acompte(random1(6));
            $acompte [':N_facture'] = $facture [':N_facture'];
            $acompte [':date_acompte'] = $date_acompte;
            $acompte [':objet_acompte'] = $objet_acompte;
            $acompte [':designation'] = $designation_acompte;
            $acompte [':mode_paiement'] = $mode_paiement;
            $acompte [':total_acompte'] = $total_acompte;
            $sql = "INSERT INTO acompte (N_acompte,N_facture,date_acompte,objet_acompte,designation,mode_paiement,total_acompte) VALUES (:N_acompte,:N_facture,:date_acompte,:objet_acompte,:designation,:mode_paiement,:total_acompte)";
            $stmt = $cxn->prepare($sql);
            foreach ($acompte as $key => $value) {
                if (is_null($value)) {
                    switch (true) {
                        case is_bool($value) :
                            $var_type = PDO::PARAM_BOOL;
                            break;
                        case is_int($value) :
                            $var_type = PDO::PARAM_INT;
                            break;
                        case is_null($value) :
                            $var_type = PDO::PARAM_NULL;
                            break;
                        default :
                            $var_type = PDO::PARAM_STR;
                    }
                }
                $stmt->bindValue($key, $value, $var_type);
            }
            $stmt->execute();
            /*             * ******************* Mise a jour la facture avec numero acompte dans la base de donnee ******************* */

            $sql = " UPDATE  facture_famille  SET numero_acompte=:param1 WHERE  N_facture=:param2";
            $stmt = $cxn->prepare($sql);
            $stmt->bindParam(':param1', $param1);
            $stmt->bindParam(':param2', $param2);
            $param1 = $code_acompte;
            $param2 = $facture [':N_facture'];
            $stmt->execute();
        }

        /*         * ******************* generer les codes coupons ******************* */
//        $date_limite = add_year_date($date_facture);
//        for ($i = 1; $i <= $nb_cours; $i ++) {
//            $code = verification_code(random2(10));
//            $sql = "INSERT INTO e_coupon (code_coupon,N_facture,id_model,date_limite) VALUES (:param1,:param2,:param3,:param4)";
//            $stmt = $cxn->prepare($sql);
//            $stmt->bindParam(':param1', $param1);
//            $stmt->bindParam(':param2', $param2);
//            $stmt->bindParam(':param3', $param3);
//            $stmt->bindParam(':param4', $param4);
//            $param1 = $code;
//            $param2 = $facture [':N_facture'];
//            $param3 = $facture [':id_model'];
//            $param4 = $date_limite;
//            $stmt->execute();
//        }
//
//        $cxn->commit();
//    } catch (Exception $e) {
//        $cxn->rollback();
//        $liste_erreurs [] = $sql;
//        $etat = FALSE;
//    }
//}
/**
 * ****************************************************
 */
// 9. lien de redirection
if ($etat) {
    $lien = "http://" . $_SERVER ['HTTP_HOST'] . rtrim(dirname(dirname(dirname($_SERVER ['PHP_SELF']))), '/\\') . "/index.php?module=facturation&action=generer_facture&N_facture=" . $facture [':N_facture'] . "&code_famille=" . $facture [':code_famille'] . "&nb_cours=" . $nb_cours;
    $objet ['message'] ['lien_generer_facture'] = $lien;
}
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
$objet ['message'] ['reponse'] = $etat;
$objet ['message_erreur'] = $liste_erreurs;
header('Content-type: application/json');
echo json_encode($objet);
?>


