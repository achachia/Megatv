<?php
session_start();
session_regenerate_id();
require_once './../../../global/config.php';
$etat = TRUE;
$objet = array();

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

if (!isset($_POST['code_distinataire']) || empty($_POST["code_distinataire"])) {
    $etat = FALSE;
    $objet['message_debug'][] = 'le champ code_distinataire n\'existe pas ou bien vide';
}
if (isset($_POST['code_distinataire']) && !empty($_POST["code_distinataire"])) {
    $code_distinataire = htmlentities(addslashes(trim($_POST['code_distinataire'])), ENT_QUOTES);
    try {
        // On envois la requète
        $sql = " SELECT id_conseiller FROM eleve_intervenant,conseiller_peda WHERE conseiller_peda.code_conseiller=eleve_intervenant.code_conseiller AND    code_intervenant='" . $_SESSION['membre']['code_intervenant'] . "'  ";
        $select = $cxn->query($sql);

        // On indique que nous utiliserons les résultats en tant qu'objet
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération des données";
    }
    $nb = $select->rowCount();
    if ($nb <= 0) {
        $etat = FALSE;
        $objet['message_debug'][] = 'le distinataire n\'existe pas dans la table conseiller_peda';
    }
}
if (!isset($_POST['objet_message']) || empty($_POST["objet_message"])) {
    $etat = FALSE;
    $objet['message_debug'][] = 'le champ objet_message n\'existe pas ou bien vide';
}
if (!isset($_POST['message']) || empty($_POST["message"])) {
    $etat = FALSE;
    $objet['message_debug'][] = 'le champ message n\'existe pas ou bien vide';
}
if ($etat) {
    $date = date("Y-m-d H:i:s");
    $objet_message = htmlentities(addslashes(trim($_POST['objet_message'])), ENT_QUOTES);
    $message = htmlentities(addslashes(trim($_POST['message'])), ENT_QUOTES);    
    //$code_distinataire = htmlentities(addslashes(trim($_POST['code_distinataire'])), ENT_QUOTES);
    $code_distinataire ='conseiller_peda';
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
        echo "Une erreur est survenue lors de la récupération des données";
        $etat = FALSE;
        $objet['message_debug'][] = 'la requette  INSERT a echoué pour la table message_envoye';
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
        echo "Une erreur est survenue lors de la récupération des données";
        $etat = FALSE;
        $objet['message_debug'][] = 'la requette  INSERT a echoué pour la table message_recus' ;
    }
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

