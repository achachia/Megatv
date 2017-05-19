<?php

session_start();
session_regenerate_id();
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
require './../../librairie/generer_code.php'; 
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();
$civilite = unhtmlentities($_POST ['civilite']);
$nom = unhtmlentities($_POST ['nom_client']);
$prenom = unhtmlentities($_POST ['prenom_client']);
$adresse = unhtmlentities($_POST ['adresse']);
$code_postale = unhtmlentities($_POST ['cp']);
$ville = unhtmlentities($_POST ['ville']);
$pays = unhtmlentities($_POST ['pays']);
$tel_portable = unhtmlentities($_POST ['tel_portable']);
$email = unhtmlentities($_POST ['email']);
$agent_commercial = unhtmlentities($_POST ['agent_commercial']);
$devise = unhtmlentities($_POST ['devise']);
$date_adhesion = unhtmlentities($_POST ['date_adhesion']);
$code_parrain = unhtmlentities($_POST ['code_parrain']);
$infos_interne = unhtmlentities($_POST ['infos_interne']);
$date_saisi = date("Y-m-d H:i:s");


// ///////////// controle les saisies//////////////////////////////////////////////
if ($nom == '' || $prenom == '' || $civilite == '' ||  $code_postale == '' || $ville == '' || $email == '' || $date_adhesion == '' || $tel_portable == '') {
  
    if ($nom == '') {
        
        $objet ['message_erreur'] [] = 'Le champ nom ne doit pas etre vide';
    }
    if ($prenom == '') {
            
        $objet ['message_erreur'] [] = 'Le champ prenom ne doit pas etre vide';
    }
    if ($civilite == '') { 
        $objet ['message_erreur'] [] = 'Le champ civilite ne doit pas etre vide';
    }
    if ($date_adhesion == '') {
        
        $objet ['message_erreur'] [] = 'Le champ date adhesion ne doit pas etre vide';
    }
    if ($email == '') {
        
        $objet ['message_erreur'] [] = 'Le champ email ne doit pas etre vide';
    }
    if ($tel_portable == '') {
        
        $objet ['message_erreur'] [] = 'Le champ telephone ne doit pas etre vide';
    }
    $etat = FALSE;
}

/* * **************** verification code postale ********************* */
if (!preg_match('/^([0-9]{5})$/', $code_postale) && $code_postale != '') {
    $etat = FALSE;
    $objet ['message_erreur'] [] = 'le format de code postale est non valide ';
}
/**
 * *************** verification Numero tel portable ****************************
 */
if ($tel_portable != '') {
    $tel_portable = ereg_replace("[^0-9]", "", $tel_portable); // formater le format de tel 01-52-54-52 => 01525452
    if (!preg_match('/^0[6-7][0-9]{8}$/', $tel_portable)) {
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'le format de numero telephone portable est non valide ';
    }
}
/**

  /**
 * **************** verification le format de Email ************************
 */

if ($email != '') {
    $control_interne = true;
    if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $email)) {
        $etat = FALSE;
        $control_interne = false;
        $objet ['message_erreur'] [] = 'Le format de adresse e-mail n\'pas valide';
    }
    if ($control_interne && empty($_POST['code_client'])) {
        try {
            $sql = " SELECT email  FROM ClientsMateriel WHERE email='" . $email . "' ";
            $select = $cxn->query($sql);
        } catch (Exception $e) {
            $objet ['message_erreur'] [] = 'il ya une erreur dans le traitement SQL de la requette :' . $sql;
        }
        $nb = $select->rowCount();
        if ($nb > 0) {
            $etat = FALSE;
            $objet ['message_erreur'] [] = 'il existe une personne qui possede le meme mail ';
        }
    }
}

// //////////////////// verification le nom et le prenom de client /////////////////////////////
if ($nom != '' && $prenom != '' && empty($_POST['code_client'])) {
    
    try {
        $sql = " SELECT nom,prenom  FROM ClientsMateriel WHERE nom='" . $nom . "' AND  prenom='" . $prenom . "' ";
        $select = $cxn->query($sql);
    } catch (Exception $e) {
        $objet ['message_erreur'] [] = 'il ya une erreur dans le traitement SQL de la requette :' . $sql;
    }
    $nb = $select->rowCount();
    if ($nb > 0) {
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'il existe une personne qui possede le meme nom et prenom ';
    }
}

if ($etat) {
     
    try {
        if (!isset($_POST['code_client'])) {
         
            $random = random2('6');
            $code_client = generer_code_user($random);
            $sql = " INSERT INTO ClientsMateriel  (nom,prenom,civilite,adresse,code_postale,ville,pays,tel,email,suivi_commercial,devise,code_client,date_adhesion";
            if (!empty($code_parrain)) {
                $sql .= ",code_parrain";
            }
            $sql .= " ) VALUES ('" . $nom . "','" . $prenom . "','" . $civilite . "','" . $adresse . "','" . $code_postale . "','" . $ville . "','" . $pays . "','" . $tel_portable . "','" . $email . "','" . $agent_commercial . "','" . $devise . "','" . $code_client . "','" . $date_adhesion . "' ";

            if (!empty($code_parrain)) {
                $sql .= ",'" . $code_parrain . "' ";
            }
            $sql .=" )";
        } else {     
            $code_client = $_POST['code_client'];
            $sql = " UPDATE ClientsMateriel  SET  civilite='" . $civilite . "',date_adhesion='" . $date_adhesion . "',nom='" . $nom . "',prenom='" . $prenom . "',email='" . $email . "',tel='" . $tel_portable . "',adresse='" . $adresse . "',code_postale='" . $code_postale . "',ville='" . $ville . "',pays='" . $pays . "',suivi_commercial='" . $agent_commercial . "',devise='" . $devise . "',code_parrain='" . $code_parrain . "'  WHERE code_client='" . $code_client . "' ";
        }
     
        $select = $cxn->query($sql);
    } catch (Exception $e) {
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'il ya une erreur dans le traitement SQL de la requette :' . $sql;
    }
}

/* * *************************************************** */
if ($etat) {
    $lien = url_absolu_admin . 'index.php?module=clients&action=view_fiche_client&code_client=' . $code_client;
    header("Location:  $lien");
} else {
    $list_erreur = serialize($objet ['message_erreur']);
    $liste_saisi ['civilite'] = $civilite;
    $liste_saisi ['nom_client'] = $nom;
    $liste_saisi ['prenom_client'] = $prenom;
    $liste_saisi ['adresse'] = $adresse;
    $liste_saisi ['cp'] = $code_postale;
    $liste_saisi ['ville'] = $ville;
    $liste_saisi ['pays'] = $pays;
    $liste_saisi ['tel_portable'] = $tel_portable;
    $liste_saisi ['email'] = $email;
    $liste_saisi ['date_adhesion'] = $date_adhesion;
    $liste_saisi ['infos_interne'] = $infos_interne;
    $liste_saisi ['code_commercial'] = $agent_commercial;
    $liste_saisi ['code_devise'] = $devise;
    $liste_saisi ['code_parrain'] = $code_parrain;
    $liste_valeur_saisi = serialize($liste_saisi);
    $lien = url_absolu_admin . 'index.php?module=clients&action=add_client&message_erreur=' . $list_erreur . '&liste_valeur_saisi=' . $liste_valeur_saisi;
    header("Location:  $lien");
}
exit();
?>
