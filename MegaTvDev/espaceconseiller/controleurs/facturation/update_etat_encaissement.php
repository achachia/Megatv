<?php
session_start ();
session_regenerate_id ();
require_once './../../../connection/config.php';
//require_once './../../config.php';
require './../../librairie/protection_contenu.php';
ini_set('date.timezone', 'Europe/Paris'); 
$etat = TRUE;
$objet = array();
$tab_encaissement = explode("-", unhtmlentities($_POST ['etat']));
$code_encaissement=$tab_encaissement[0];
$etat_encaissement = $tab_encaissement[1];
$reference_facture = intval(unhtmlentities($_POST ['reference']));
// controle de donnee
if ($etat_encaissement == '' || $reference_facture == '') {
    if ($etat_encaissement == '') {
        $objet ['message_erreur'] [] = 'Le champ etat facture ne doit pas etre vide';
    }
    if ($reference_facture == '') {
        $objet ['message_erreur'] [] = 'la facture n\'est pas defini';
    }
    $etat = FALSE;
}
if (!is_int($reference_facture) && $reference_facture > 0) {
    $etat = FALSE;
    $objet ['message_erreur'] [] = 'le champ  reference facture n\'est pas entier';
}
// ////////// controle la reference de l'intervention ////////////////////////////
if ($etat) {
    try {
        $select = $cxn->query(" SELECT id_facture  FROM facture_famille  WHERE N_facture='" . $reference_facture . "'  ");
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $etat = FALSE;
            $objet ['message_erreur'] [] = 'il n\'existe pas une facture qui possede cette reference ';
        }
    } catch (Exception $e) {
        $etat = FALSE;
        echo "Une erreur est survenue lors de la récupération des données1";
    }
}

// ////////////////////// verifier l'etat de la facture //////////////////////////////////
if ($etat) {
    try {
        $sql = " SELECT id_encaissement  FROM  liste_encaissements  WHERE  N_facture='" . $reference_facture . "'  AND  etat='" . $etat_encaissement . "'  ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $etat = FALSE;
            $objet ['message_erreur'] []=$nb;
            $objet ['message_erreur'] []=$sql;
            $objet ['message_erreur'] [] = 'il existe  un encaissement qui possede deja cette etat ';
        }
    } catch (Exception $e) {
        $etat = FALSE;
        echo "Une erreur est survenue lors de la récupération des données2";
    }
}
// ///////////////////// les etats possible de l'intervention
if ($etat) {
    try {
        $sql = "  SELECT etat  FROM liste_encaissements  WHERE  code_encaissement=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $code_encaissement;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $etat_recu = $enregistrement ['etat'];
        $tab_valeurs_possible = array();
        if ($etat_recu == 'attente') {
            $tab_valeurs_possible = [
                'regl&eacute;',
                'non_ regl&eacute;',
                'annule'
            ];
        }
        if (!in_array($etat_encaissement, $tab_valeurs_possible)) {
            $etat = FALSE;
            $objet ['message_erreur'] [] = 'Nous sommes desole,votre demande de changement etat est refuse';
        }
    } catch (Exception $e) {
        $etat = FALSE;
        echo "Une erreur est survenue lors de la récupération des données3";
    }
}

// ///////////////////////Mise a jur etat de intervention ///////////////////////////
if ($etat) {
    try {
        $sql = " UPDATE  liste_encaissements  SET etat=:param1  WHERE N_facture=:param2  AND code_encaissement=:param3 ";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $param1);
        $stmt->bindParam(':param2', $param2);
        $stmt->bindParam(':param3', $param3);
        $param1 = $etat_encaissement;
        $param2 = $reference_facture;
        $param3 = $code_encaissement;
        $stmt->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
        $etat = FALSE;
        $objet ['message_erreur'] [] = 'Nous somme desole ,votre demande a echoue.contacter adminstrateur de site';
    }
}

/**
 * *****************************
 */
$objet ['message'] ['reponse'] = $etat;
header('Content-type: application/json');
echo json_encode($objet);
?>


