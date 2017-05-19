<?php

session_start();
session_regenerate_id();
require_once './../../../global/config.php';
require './../../modele/membre/traitement_rep_message.php';
$etat = TRUE;
$objet = array();
if (!isset($_POST['code_distinataire']) || empty($_POST["code_distinataire"])) {
    $etat = FALSE;
    $objet['message_debug'][] = 'le champ code_distinataire n\'existe pas ou bien vide';
}
if (isset($_POST['code_distinataire']) && !empty($_POST["code_distinataire"])) {
    $code_distinataire = htmlentities(addslashes(trim($_POST['code_distinataire'])), ENT_QUOTES);
    try {
        $sql = " SELECT id_liaison ";
        if (strpos($code_distinataire, 'CF') !== FALSE) {
            $sql.="FROM eleve_intervenant  WHERE  code_famille='" . $code_distinataire . "'  AND  code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "' ";
        } elseif (strpos($code_distinataire, 'CP') !== FALSE) {
            $sql.="FROM eleve_intervenant  WHERE  code_conseiller='" . $code_distinataire . "'  AND  code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "' ";
        } elseif (strpos($code_distinataire, 'CI') !== FALSE) {
            $sql.="FROM  eleve_intervenant  WHERE  code_intervenant='" . $code_distinataire . "'  AND  code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "' ";
        }
        $select = $cxn->query($sql);
        $nb = $select->rowCount();
        if ($nb <= 0) {
            $etat = FALSE;
            $objet['message_debug'][] = 'le code distinataire n\'existe pas';
        }
        // On indique que nous utiliserons les résultats en tant qu'objet
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
}
if ($etat) {
    $date = date("Y-m-d H:i:s");
    $objet_message = htmlentities(addslashes(trim($_POST['objet_message'])), ENT_QUOTES);
    $message = htmlentities(addslashes(trim($_POST['message'])), ENT_QUOTES);
    $code_distinataire = htmlentities(addslashes(trim($_POST['code_distinataire'])), ENT_QUOTES);
    $code_expediteur = $_SESSION['membre']['code_intervenant'];
    try {
        // table message envoyé
        $stmt = $cxn->prepare(" INSERT INTO  message_envoye (objet,message,date,expediteur,destinataire,token) VALUES (:param1,:param2,:param3,:param4,:param5,:param6) ");
        $stmt->bindParam(':param1', $objet_message);
        $stmt->bindParam(':param2', $message_text);
        $stmt->bindParam(':param3', $date_message);
        $stmt->bindParam(':param4', $expediteur);
        $stmt->bindParam(':param5', $destinataire);
        $stmt->bindParam(':param6', $token);
        // insertion d'une ligne          
        $objet_message = $objet_message;
        $message_text = $message;
        $date_message = $date;
        $expediteur = $code_expediteur;
        $destinataire = $code_distinataire;
        $token = generer_token();
        $stmt->execute();
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de l'insertion  des données dans la table message_envoye  ";
        $etat = FALSE;
        $objet['message_debug'][] = "Une erreur est survenue lors de l'insertion des données dans la table message_envoye";
    }
    try {
        // table message recus
        $stmt = $cxn->prepare(" INSERT INTO  message_recus (objet,message,date_envoi,expediteur,destinataire,token) VALUES (:param1,:param2,:param3,:param4,:param5,:param6)  ");
        $stmt->bindParam(':param1', $objet_message);
        $stmt->bindParam(':param2', $message_text);
        $stmt->bindParam(':param3', $date_message);
        $stmt->bindParam(':param4', $expediteur);
        $stmt->bindParam(':param5', $destinataire);
        $stmt->bindParam(':param6', $token);
        // insertion d'une ligne          
        $objet_message = $objet_message;
        $message_text = $message;
        $date_message = $date;
        $expediteur = $code_expediteur;
        $destinataire = $code_distinataire;
        $token = generer_token();
        $stmt->execute();
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de l'insertion des données dans la table message_recus ";
        $etat = FALSE;
        $objet['message_debug'][] = "Une erreur est survenue lors de l'insertion des données dans la table message_recus";
    }
}
$id_message_post = recuperation_id_message_post($token);
$suivi_reponse = suivi_reponse($_POST['id_message']);
try {
    // table message recus
    $stmt = $cxn->prepare(" UPDATE  message_recus  SET suivi_reponse=:param1  WHERE id_message=:param2  ");
    $stmt->bindParam(':param1', $suivi);
    $stmt->bindParam(':param2', $id_message);
    // insertion d'une ligne  
    $suivi = $suivi_reponse;
    $id_message = $id_message_post;
    $stmt->execute();
} catch (Exception $e) {
    echo "Une erreur est survenue lors de l'insertion des données dans la table message_recus ";
    $etat = FALSE;
    $objet['message_debug'][] = "Une erreur est survenue lors de la mise a jour des données dans la table message_recus";
}

if ($etat) {
    $reponse = 'oui';
} else {
    $reponse = 'non';
}
$objet['message'] = array('reponse' => $reponse);
header('Content-type: application/json');
echo json_encode($objet);
?>


