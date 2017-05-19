<?php



if ($action == 'mon_compte') {
    $infos_client = infos_client($_SESSION ['client'] ['code_user']);
}elseif ($action == 'check_formule_contact') {
    if (isset($_POST["code_user"]) && !empty($_POST["code_user"])) {

        $reponse = check_message_contact($_POST);
        $reponse['etat'] = TRUE;
        if ($reponse['etat']) {
            $objet['message'] = array('reponse' => $reponse['etat']);
        } else {
            $objet['message'] = array('reponse' => $reponse['etat'], 'message_erreur' => $reponse['erreur']);
        }

        header('Content-type: application/json');
        echo json_encode($objet);
    }
}elseif ($action == 'my_messages_recus') {
    $my_messages_recus = my_messages_recus($_SESSION ['client'] ['code_user']);    
}elseif ($action == 'my_messages_envoye') {
    $my_messages_envoye = my_messages_envoye($_SESSION ['client'] ['code_user']);
}elseif ($action == 'view_message_envoye') {
    if (isset($_POST["code_message"]) && !empty($_POST["code_message"])) {

        $objet = infos_message_envoye($_SESSION ['client'] ['code_user'], $_POST["code_message"]);

        header('Content-type: application/json');
        
        echo json_encode($objet);
    }
}elseif ($action == 'view_message_recu') {
    
    if (isset($_POST["code_message"]) && !empty($_POST["code_message"])) {

        $objet = infos_message_recu($_SESSION ['client'] ['code_user'], $_POST["code_message"]);

        header('Content-type: application/json');
        
        echo json_encode($objet);
    }
    
}elseif ($action == 'rep_message_recu') {
    
     $infos_message_recu = detail_message_recu($_SESSION ['client'] ['code_user'], $token_message);
     
}elseif ($action == 'check_rep_message') {    
        if (isset($_POST["code_user"]) && !empty($_POST["code_user"])) {

        $reponse = check_rep_message($_POST);
        $reponse['etat'] = TRUE;
        if ($reponse['etat']) {
            $objet['message'] = array('reponse' => $reponse['etat']);
        } else {
            $objet['message'] = array('reponse' => $reponse['etat'], 'message_erreur' => $reponse['erreur']);
        }

        header('Content-type: application/json');
        echo json_encode($objet);
    }     
  
}

?>

