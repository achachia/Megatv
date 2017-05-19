<?php

session_start();
session_regenerate_id();
require_once './../../../connection/config.php';
//require_once './../../config.php';
require './../../librairie/protection_contenu.php';
require './../../librairie/generer_code.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$objet = array();
$code_famille = unhtmlentities($_POST ['choix_famille']);
$nom = unhtmlentities($_POST ['nom_beneficiaire']);
$prenom = unhtmlentities($_POST ['prenom_beneficiaire']);
$id_niveau = unhtmlentities($_POST ['niveau_peda']);
$tel_portable = unhtmlentities($_POST ['tel_portable']);
$tel_fixe = unhtmlentities($_POST ['tel_fixe']);
$infos_interne = unhtmlentities($_POST ['infos_interne']);
$infos_intervenants = unhtmlentities($_POST ['infos_intervenants']);
$date_naissance = unhtmlentities($_POST ['date_naissance']);
$date_adhesion = unhtmlentities($_POST ['date_adhesion']);
$url_site = unhtmlentities($_POST ['site_web']);
$adresse = unhtmlentities($_POST ['adresse']);
$adresse_suite = unhtmlentities($_POST ['adresse_suite']);
$code_postale = unhtmlentities($_POST ['cp']);
$ville = unhtmlentities($_POST ['ville']);
$pays = unhtmlentities($_POST ['pays']);
if (isset($_POST ['email'])) {
    $email = unhtmlentities($_POST ['email']);
} else {
    $email = NULL;
}

// ///////////// controle les saisies//////////////////////////////////////////////
if ($code_famille == '' || $nom == '' || $prenom == '' || $date_adhesion == '' || $id_niveau == '') {
    if ($code_famille == '') {
        $objet ['message_erreur'] [] = 'Le champ choix famille ne doit pas etre vide';
    }
    if ($nom == '') {
        $objet ['message_erreur'] [] = 'Le champ nom ne doit pas etre vide';
    }
    if ($prenom == '') {
        $objet ['message_erreur'] [] = 'Le champ prenom ne doit pas etre vide';
    }
    if ($date_adhesion == '') {
        $objet ['message_erreur'] [] = 'Le champ date adhesion ne doit pas etre vide';
    }
    if ($id_niveau == '') {
        $objet ['message_erreur'] [] = 'Le champ niveau pedagogique ne doit pas etre vide';
    }
    $etat = FALSE;
}
/**
 * *************** verification Numero tel portable ****************************
 */
if ($code_famille != '') {
    // //////////////////// verification le  client /////////////////////////////
    try {
        $select = $cxn->query(" SELECT nom  FROM membre_famille WHERE code_famille='" . $code_famille . "'  ");
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $etat = FALSE;
            $objet ['message_erreur'] [] = 'il n\'existe pas un client dans votre base de donnee ';
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
}
if ($tel_fixe != '') {
    $tel_fixe = ereg_replace("[^0-9]", "", $tel_fixe); // formater le format de tel 01-52-54-52 => 01525452
    if (!preg_match('/^0[1-59][0-9]{8}$/', $tel_fixe)) {
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'le format de numero telephone fixe est non valide ';
    }
}
if ($tel_portable != '') {
    $tel_portable = ereg_replace("[^0-9]", "", $tel_portable); // formater le format de tel 01-52-54-52 => 01525452
    if (!preg_match('/^0[6-7][0-9]{8}$/', $tel_portable)) {
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'le format de numero telephone portable est non valide ';
    }
}

/* * *************** verification le format de Email ************************ */
if (!empty($email)) {
    $control_interne = true;
    if (!preg_match("$[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,4}$", $email)) {
        $etat = FALSE;
        $control_interne = false;
        $objet ['message_erreur'] [] = 'Le format de adresse e-mail n\'pas valide';
    }
    if ($control_interne) {
        try {
            $select = $cxn->query(" SELECT email  FROM eleve_famille WHERE email='" . $email . "' ");
            $nb = $select->rowCount();
            if ($nb > 0) {
                $etat = FALSE;
                $objet ['message_erreur'] [] = 'il existe un beneficiare qui possede le meme mail ';
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue lors de la récupération des données";
        }
    }
}

// /////////// intertion les informations de client//////////////////////////////////
if ($etat) {
    $date_saisi = date("Y-m-d H:i:s");
    try {
        $cxn->beginTransaction();
        // intertion les infos de beneficiaires
        $sql = " INSERT INTO eleve_famille (nom,prenom,code_famille,niveau_peda,date_inscription,email,tel_portable,date_naissance,tel_fixe,site_web,adresse,adresse_suite,ville,pays,code_postale,date_saisi) VALUES (:param1,:param2,:param3,:param4,:param5,:param6,:param7,:param8,:param9,:param10,:param11,:param12,:param13,:param14,:param15,:param16)";
        $stmt = $cxn->prepare($sql);
        $param1 = $nom;
        $param2 = $prenom;
        $param3 = $code_famille;
        $param4 = $id_niveau;
        $param5 = $date_adhesion;
        $param6 = $email;
        $param7 = $tel_portable;
        $param8 = $date_naissance;
        $param9 = $tel_fixe;
        $param10 = $url_site;
        $param11 = $adresse;
        $param12 = $adresse_suite;
        $param13 = $ville;
        $param14 = $pays;
        $param15 = $code_postale;
        $param16 = $date_saisi;
        $stmt->bindParam(':param1', $param1);
        $stmt->bindParam(':param2', $param2);
        $stmt->bindParam(':param3', $param3);
        $stmt->bindParam(':param4', $param4);
        $stmt->bindParam(':param5', $param5);
        $stmt->bindParam(':param6', $param6);
        $stmt->bindParam(':param7', $param7);
        $stmt->bindParam(':param8', $param8);
        $stmt->bindParam(':param9', $param9);
        $stmt->bindParam(':param10', $param10);
        $stmt->bindParam(':param11', $param11);
        $stmt->bindParam(':param12', $param12);
        $stmt->bindParam(':param13', $param13);
        $stmt->bindParam(':param14', $param14);
        $stmt->bindParam(':param15', $param15);
        $stmt->bindParam(':param16', $param16);
        $stmt->execute();
        // chercher le Id-eleve
        $stmt = $cxn->prepare(" SELECT id_eleve FROM eleve_famille WHERE nom=:param1 AND prenom=:param2 ");
        $param1 = $nom;
        $param2 = $prenom;
        $stmt->bindParam(':param1', $param1);
        $stmt->bindParam(':param2', $param2);
        $stmt->execute();
        $enregistrement = $stmt->fetch();
        $id_eleve = $enregistrement ['id_eleve'];
        // Mettre a jour le code de eleve
        $code_eleve = 'CE' . $id_eleve;
        $sql = " UPDATE  eleve_famille  SET code_eleve='" . $code_eleve . "'  WHERE nom='" . $nom . "'  AND prenom='" . $prenom . "' ";
        $select = $cxn->query($sql);
        $cxn->commit();
    } catch (Exception $e) {
        $cxn->rollback();
        $etat = FALSE;
        $objet ['message_debug'] [] = 'la requette N°7 INSERT  dans la table eleve_famille a echoué';
    }
}

/* * ************ traitement les disponibilite de beneficiaire ********************
 */
/**
 * *********** 1.
 * preparation les requettes SQL ****************
 */
if ($etat) {
    $sql_array = array();
    $jour_array = [
        'lundi' => '1',
        'mardi' => '2',
        'mercredi' => '3',
        'jeudi' => '4',
        'vendredi' => '5',
        'samedi' => '6',
        'dimanche' => '7'
    ];
    $periode_array = [
        'periode1' => 'matin',
        'periode2' => '13h-14h',
        'periode3' => '14h-15h',
        'periode4' => '15h-16h',
        'periode5' => '16h-17h',
        'periode6' => '17h-18h',
        'periode7' => '18h-19h',
        'periode8' => '19h-20h'
    ];
    foreach ($periode_array as $key => $value) {
        $req2 = "";
        $req1 = "INSERT  INTO dispo_hebdo_eleve   ";
        $req1 .= "(periode,";
        $req2 .= "('" . $periode_array [$key] . "', ";
        if (isset($_POST [$key])) {
            foreach ($jour_array as $value) {
                if (in_array($value, $_POST [$key])) {
                    $jour = array_search($value, $jour_array);
                    $req1 .= $jour . ",";
                    $req2 .= "'1',";
                } else {
                    $jour = array_search($value, $jour_array);
                    $req1 .= $jour . ",";
                    $req2 .= "'0',";
                }
            }
        } else {
            foreach ($jour_array as $value) {
                $jour = array_search($value, $jour_array);
                $req1 .= $jour . ",";
                $req2 .= "'0',";
            }
        }
        $req1 .= "code_eleve)";
        $req2 .= " :param )";
        $sql = $req1 . " VALUE " . $req2;
        $sql_array [] = $sql;
    }
}

/**
 * ************ 2.
 * Excution les requettes SQL *************
 */
if ($etat) {
    try {
        foreach ($sql_array as $value) {
            $stmt = $cxn->prepare($value);
            $stmt->bindParam(':param', $code_eleve);
            $stmt->execute();
        }
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la r�cup�ration des donn�es3";
        $etat = FALSE;
    }
}
/* * ************************************** */
$objet ['message'] = array(
    'reponse' => $etat
);
header('Content-type: application/json');
echo json_encode($objet);
?>
