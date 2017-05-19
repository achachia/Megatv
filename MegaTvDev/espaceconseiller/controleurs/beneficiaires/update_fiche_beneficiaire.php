<?php

//require_once './../../config.php';
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
require './../../librairie/fonctions.php';
ini_set('date.timezone', 'Europe/Paris');
require dirname(dirname(dirname(__FILE__))) . '/modele/beneficiaires/edit_fiche_beneficiaire.php';
$control = true;
$objet = array();
$code_beneficiaire = unhtmlentities($_POST ['code_beneficiaire']);
$nom = unhtmlentities($_POST ['nom_beneficiaire']);
$prenom = unhtmlentities($_POST ['prenom_beneficiaire']);
$date_naissance = unhtmlentities($_POST ['date_naissance']);
$adresse = unhtmlentities($_POST ['adresse']);
$adresse_suite = unhtmlentities($_POST ['adresse_suite']);
$code_postale = unhtmlentities($_POST ['cp']);
$ville = unhtmlentities($_POST ['ville']);
$pays = unhtmlentities($_POST ['pays']);
$tel_fixe = unhtmlentities($_POST ['tel_fixe']);
$tel_portable = unhtmlentities($_POST ['tel_portable']);
$email = unhtmlentities($_POST ['email']);
$site_web = unhtmlentities($_POST ['site_web']);
$infos_intervenant = unhtmlentities($_POST ['infos_intervenant']);
$infos_interne = unhtmlentities($_POST ['infos_interne']);
$date_adhesion = unhtmlentities($_POST ['date_adhesion']);
$id_niveau = unhtmlentities($_POST ['niveau_peda']);


if ($code_beneficiaire == '') {
    $control = false;
    $objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande1 ';
} else {
    try {
        $select = $cxn->query(" SELECT id_eleve  FROM eleve_famille WHERE code_eleve='" . $code_beneficiaire . "' ");
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $control = FALSE;
            $objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande2 ';
        }
    } catch (Exception $e) {
        $control = FALSE;
        $objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande3 ';
    }
}
if ($control) {
    $req2 = '';
    $infos_beneficiaire = infos_beneficiaire($code_beneficiaire);
    if (!isset($nom) || empty($nom)) {
        $control = false;
        $objet ['message_erreur'] [] = 'Le champ nom est vide  ';
    } else {
        if ($nom != $infos_beneficiaire ['nom']) {
            $req2 .= "nom='" . $nom . "',";
        }
    }
    if (!isset($prenom) || empty($prenom)) {
        $control = false;
        $objet ['message_erreur'] [] = 'Le champ prenom est vide  ';
    } else {
        if ($prenom != $infos_beneficiaire ['prenom']) {
            $req2 .= "prenom='" . $prenom . "',";
        }
    }
    if ($date_naissance!='0000-00-00') {
        if (!validateDate($date_naissance, 'Y-m-d')) {
            $control = false;
            $objet ['message_erreur'] [] = 'Le champ date de naissance n\'est pas valide  ';
        } else {
            if ($date_naissance != $infos_beneficiaire ['date_naissance']) {
                $req2 .= "date_naissance='" . $date_naissance . "',";
            }
        }
    }
    if (!isset($adresse) || empty($adresse)) {
        $control = false;
        $objet ['message_erreur'] [] = 'Le champ adresse est vide';
    } else {
        if (isset($adresse) && !empty($adresse) && $adresse != $infos_beneficiaire ['adresse']) {

            $req2 .= "adresse='" . $adresse . "',";
        }
        if (isset($adresse_suite) && !empty($adresse_suite) && $adresse_suite != $infos_beneficiaire ['adresse_suite']) {

            $req2 .= "adresse_suite='" . $adresse_suite . "',";
        }
    }
    if (!isset($code_postale) || empty($code_postale)) {
        $control = false;
        $objet ['message_erreur'] [] = 'Le champ code-postale  est vide  ';
    } else {
        if ($code_postale != $infos_beneficiaire ['code_postale']) {
            if (!preg_match('/^([0-9]{5})$/', $code_postale)) {
                $control = false;
                $objet ['message_erreur'] [] = 'Le format  code-postale n\'est pas valide ';
            } else {
                $req2 .= "code_postale='" . $code_postale . "',";
            }
        }
    }

    if (!isset($ville) || empty($ville)) {
        $control = false;
        $objet ['message_erreur'] [] = 'Le champ ville est vide  ';
    } else {
        if ($ville != $infos_beneficiaire ['ville']) {
            $req2 .= "ville='" . $ville . "',";
        }
    }
    if (!isset($pays) || empty($pays)) {
        $control = false;
        $objet ['message_erreur'] [] = 'Le champ pays est vide  ';
    } else {
        if ($pays != $infos_beneficiaire ['pays']) {
            $req2 .= "pays='" . $pays . "',";
        }
    }
    if (isset($tel_portable) && !empty($tel_portable) && $tel_portable != $infos_beneficiaire ['tel_portable']) {

        if (!preg_match("#^0[6-7]([-]?[0-9]{2}){4}$#", $tel_portable)) {
            $control = false;
            $objet ['message_erreur'] [] = 'Le format telephone portable  n\'est pas valide ';
        } else {
            $req2 .= "tel_portable='" . $tel_portable . "',";
        }
    }
    if (isset($tel_fixe) && !empty($tel_fixe) && $tel_fixe != $infos_beneficiaire ['tel_fixe']) {
        if (!preg_match("#^0[1-59]([-]?[0-9]{2}){4}$#", $tel_fixe)) {
            $control = false;
            $objet ['message_erreur'] [] = 'Le format telephone fixe  n\'est pas valide ';
        } else {
            $req2 .= "tel_fixe='" . $tel_fixe . "',";
        }
    }
    if (isset($email) && !empty($email) && $email != $infos_beneficiaire ['email']) {
        if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $email)) {
            $control = false;
            $objet ['message_erreur'] [] = 'Le format de adresse e-mail n\'pas valide';
        } else {
            try {
                $select = $cxn->query(" SELECT email  FROM membre_famille WHERE email='" . $email . "'   UNION  SELECT email  FROM intervenants   WHERE email='" . $email . "'   UNION  SELECT email  FROM eleve_famille WHERE email='" . $email . "'  ");
                $nb = $select->rowCount();
                if ($nb > 0) {
                    $control = FALSE;
                    $objet ['message_erreur'] [] = 'il existe une personne qui possede le meme mail ';
                } else {
                    $req2 .= "email='" . $email . "',";
                }
            } catch (Exception $e) {
                $control = FALSE;
                $objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande ';
            }
        }
    }
    if (isset($site_web) && !empty($site_web) && $site_web != $infos_beneficiaire ['site_web']) {
        if (!preg_match('#^http://[w-]+[w.-]+.[a-zA-Z]{2,6}#i', $site_web)) {
            $control = false;
            $objet ['message_erreur'] [] = 'Le format Site web  n\'est pas valide ';
        } else {
            $req2 .= "site_web='" . $site_web . "',";
        }
    }
    if (isset($infos_interne) && !empty($infos_interne) && $infos_interne != $infos_beneficiaire ['infos_interne']) {
        $req2 .= "infos_interne='" . $infos_interne . "',";
    }
    if (isset($infos_intervenant) && !empty($infos_intervenant) && $infos_intervenant != $infos_beneficiaire ['infos_intervenant']) {
        $req2 .= "infos_intervenant='" . $infos_intervenant . "',";
    }
    if ($date_adhesion == '') {
        $objet ['message_erreur'] [] = 'Le champ date adhesion ne doit pas etre vide';
    } else {
        if (!validateDate($date_adhesion, 'Y-m-d')) {
            $control = false;
            $objet ['message_erreur'] [] = 'Le champ date adhesion n\'est pas valide  ';
        } else {
            if ($date_adhesion != $infos_beneficiaire ['date_adhesion']) {
                $req2 .= "date_adhesion='" . $date_adhesion . "',";
            }
        }
    }
    if ($id_niveau == '') {
        $objet ['message_erreur'] [] = 'Le champ niveau pedagogique ne doit pas etre vide';
    } else {
        if ($id_niveau != $infos_beneficiaire ['niveau_peda']) {
            $req2 .= "niveau_peda='" . $id_niveau . "',";
        }
    }
    /*     * ********************************************* */




    if ($control && $req2 != '') {


        try {
            /* enregistrer les informations de beneficiaire */
            $req2 = substr($req2, 0, - 1);
            $sql = " UPDATE eleve_famille SET " . $req2 . " WHERE code_eleve=:param ";
            $stmt = $cxn->prepare($sql);
            $stmt->bindParam(':param', $code_beneficiaire);
            $stmt->execute();
        } catch (Exception $e) {
            $control = FALSE;
            $objet ['message_erreur'] [] = 'il ya une erreur interne dans le traitement de votre demande 2 ';
        }
    }
    /*     * ************ traitement les disponibilite de beneficiaire ********************
     * 
     */
    if ($control) {
        $sql_array = array();
        $jour_array = ['lundi' => '1', 'mardi' => '2', 'mercredi' => '3', 'jeudi' => '4', 'vendredi' => '5', 'samedi' => '6', 'dimanche' => '7'];
        $periode_array = ['periode1' => 'matin', 'periode2' => '13h-14h', 'periode3' => '14h-15h', 'periode4' => '15h-16h', 'periode5' => '16h-17h', 'periode6' => '17h-18h', 'periode7' => '18h-19h', 'periode8' => '19h-20h'];
        try {
            // On envois la requète
            $sql = " SELECT id_dispo FROM dispo_hebdo_eleve WHERE code_eleve='" . $code_beneficiaire . "' ";
            $select = $cxn->query($sql);
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
        $nb = $select->rowCount();

        if ($nb <= 0) {
            foreach ($periode_array as $key => $value) {
                $req2 = "";
                $req1 = "INSERT  INTO dispo_hebdo_eleve   ";
                $req1.="(periode,";
                $req2.="('" . $periode_array[$key] . "', ";
                if (isset($_POST[$key])) {
                    foreach ($jour_array as $value) {
                        if (in_array($value, $_POST[$key])) {
                            $jour = array_search($value, $jour_array);
                            $req1.=$jour . ",";
                            $req2.="'1',";
                        } else {
                            $jour = array_search($value, $jour_array);
                            $req1.=$jour . ",";
                            $req2.="'0',";
                        }
                    }
                } else {
                    foreach ($jour_array as $value) {
                        $jour = array_search($value, $jour_array);
                        $req1.=$jour . ",";
                        $req2.="'0',";
                    }
                }
                $req1.="code_eleve)";
                $req2.=" :param )";
                $sql = $req1 . " VALUE " . $req2;
                $sql_array[] = $sql;
            }
        }
        if ($nb > 0) {
            foreach ($periode_array as $key => $value) {
                $req1 = "UPDATE dispo_hebdo_eleve  SET ";
                $req2 = '';
                if (isset($_POST[$key])) {
                    foreach ($jour_array as $value) {
                        if (in_array($value, $_POST[$key])) {
                            $jour = array_search($value, $jour_array);
                            $req2.=$jour . "='1',";
                        } else {
                            $jour = array_search($value, $jour_array);
                            $req2.=$jour . "='0',";
                        }
                    }
                } else {
                    foreach ($jour_array as $value) {
                        $jour = array_search($value, $jour_array);
                        $req2.=$jour . "='0',";
                    }
                }
                $req2 = substr($req2, 0, -1);
                $sql = $req1 . $req2 . " WHERE code_eleve=:param   AND   periode='" . $periode_array[$key] . "' ";
                $sql_array[] = $sql;
            }
        }
        foreach ($sql_array as $value) {
            try {
                $stmt = $cxn->prepare($value);
                $stmt->bindParam(':param', $code_beneficiaire);
                $stmt->execute();
            } catch (Exception $e) {
                echo "Une erreur est survenue lors de la récupération des données";
                $control = FALSE;
            }
        }
    }

    /*     * ************************************** */
}
$objet ['message'] = array(
    'reponse' => $control
);
header('Content-type: application/json');
echo json_encode($objet);
?>
