<?php
session_start ();
session_regenerate_id ();
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
ini_set('date.timezone', 'Europe/Paris'); 
$etat = TRUE;
$objet = array();
$etat_facture = unhtmlentities($_POST ['etat']);
$reference_facture = intval(unhtmlentities($_POST ['reference']));
// controle de donnee
if ($etat_facture == '' || $reference_facture == '') {
    if ($etat_facture == '') {
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
        echo "Une erreur est survenue lors de la récupération des données";
    }
}

// ////////////////////// verifier l'etat de l'intervention //////////////////////////////////
if ($etat) {
    try {
        $sql = " SELECT id_facture  FROM  facture_famille  WHERE  N_facture='" . $reference_facture . "'  AND  etat_facture='" . $etat_facture . "'  ";
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb > 0) {
            $etat = FALSE;
             $objet ['message_erreur'] []=$nb;
            $objet ['message_erreur'] []=$sql;
            $objet ['message_erreur'] [] = 'il existe  une facture qui possede deja cette etat ';
        }
    } catch (Exception $e) {
        $etat = FALSE;
        echo "Une erreur est survenue lors de la récupération des données";
    }
}
// ///////////////////// les etats possible de l'intervention
if ($etat) {
    try {
        $sql = "  SELECT etat_facture  FROM facture_famille  WHERE  N_facture=:param ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param', $param);
        $param = $reference_facture;
        $resultat->execute();
        $enregistrement = $resultat->fetch();
        $etat_recue = $enregistrement ['etat_facture'];
        $tab_valeurs_possible = array();
        if ($etat_recue == 'attente') {
            $tab_valeurs_possible = [
                'regl&eacute;',
                'non_regl&eacute;',
                'annule'
            ];
        }
        if (!in_array($etat_facture, $tab_valeurs_possible)) {
            $etat = FALSE;
            $objet ['message_erreur'] [] = 'Nous sommes desole,votre demande de changement etat est refuse';
        }
    } catch (Exception $e) {
        $etat = FALSE;
        echo "Une erreur est survenue lors de la récupération des données";
    }
}
$objet ['message_erreur'] []=$etat_facture;
// ///////////////////////Mise a jur etat de intervention ///////////////////////////
if ($etat) {
    try {
        $sql = " UPDATE  facture_famille  SET etat_facture=:param1  WHERE N_facture=:param2 ";
        $stmt = $cxn->prepare($sql);
        $stmt->bindParam(':param1', $param1);
        $stmt->bindParam(':param2', $param2);
        $param1 = $etat_facture;
        $param2 = $reference_facture;
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
