<?php

session_start();
session_regenerate_id();
require_once './../../../global/config.php';
$objet = array();

function identite($code) {
    global $cxn;
    $sql = " SELECT nom,prenom FROM ";
    if (strpos($code, 'CF') !== FALSE) {
        $sql.=" membre_famille  WHERE code_famille=:param";
    } elseif (strpos($code, 'CP') !== FALSE) {
        $sql.=" conseiller_peda  WHERE code_conseiller=:param ";
    } elseif (strpos($code, 'CI') !== FALSE) {
        $sql.=" intervenants  WHERE code_intervenant=:param ";
    }
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param', $param);
    $param = $code;
    $identite = $sql;
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $identite = html_entity_decode($enregistrement['nom']) . "." . html_entity_decode($enregistrement['prenom']);
    return $identite;
}

if (isset($_POST['id_message']) && $_POST['mod'] == 'consultation_message_recu') {
    $id_message = htmlentities(addslashes(trim($_POST['id_message'])), ENT_QUOTES);
    $sql = "SELECT DATE_FORMAT(date_envoi,'%Y-%m-%d' ) AS date_message,DATE_FORMAT(date_envoi,'%k:%i' ) AS heure_message,message,expediteur,objet ";
    $sql.=" FROM message_recus WHERE  id_message=:param1 AND destinataire=:param2";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $param1);
    $resultat->bindParam(':param2', $param2);
    $param1 = $id_message;
    $param2 = $_SESSION['membre']['code_intervenant'];
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $expediteur = identite($enregistrement['expediteur']);
    $objet['message'] = array(
        'date_message' => $enregistrement['date_message'],
        'heure_message' => $enregistrement['heure_message'],
        'expediteur' => $expediteur,
        'objet_message' => $enregistrement['objet'],
        'message' => $enregistrement['message']
    );
    if (isset($objet['message'])) {
        $date = date("Y-m-d H:i:s");
        $sql = " UPDATE message_recus  SET etat='1',date_consultation=:param1 WHERE id_message=:param2 AND destinataire=:param3  ";
        $resultat = $cxn->prepare($sql);
        $resultat->bindParam(':param1', $param1);
        $resultat->bindParam(':param2', $param2);
        $resultat->bindParam(':param3', $param3);
        $param1 = $date;
        $param2 = $id_message;
        $param3 = $_SESSION['membre']['code_intervenant'];
        $resultat->execute();
    }
}
if (isset($_POST['id_message']) && $_POST['mod'] == 'consultation_message_envoye') {
    $id_message = htmlentities(addslashes(trim($_POST['id_message'])), ENT_QUOTES);
    $sql = "SELECT DATE_FORMAT(date,'%Y-%m-%d' ) AS date_message,DATE_FORMAT(date,'%k:%i' ) AS heure_message,message,destinataire,objet ";
    $sql.=" FROM message_envoye WHERE  id_message=:param1 AND expediteur=:param2";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param1', $param1);
    $resultat->bindParam(':param2', $param2);
    $param1 = $id_message;
    $param2 = $_SESSION['membre']['code_intervenant'];
    $resultat->execute();
    $enregistrement = $resultat->fetch();
    $destinataire = identite($enregistrement['destinataire']);
    $objet['message'] = array(
        'date_message' => $enregistrement['date_message'],
        'heure_message' => $enregistrement['heure_message'],
        'destinataire' => $destinataire,
        'objet_message' => $enregistrement['objet'],
        'message' => $enregistrement['message']
    );
}
header('Content-type: application/json');
echo json_encode($objet);
?>
