<?php

//controleur secondaire

if ($action == 'add_commande') {    
    $infos_client = infos_client($_SESSION ['client'] ['code_user']);
    $infos_abonnement = infos_abonnement($id_abo);
    $token = generer_token_commande(random(30));    

}elseif($action == 'check_commande'){
  
   if (isset($_POST["code_user"]) && !empty($_POST["code_user"])) { 
       
        $reponse = check_commande($_POST);  
      
        if($reponse['etat']){            
             $objet['message'] = array('reponse' => $reponse['etat'],'lien_redirection' => $reponse['lien_redirection']); 
        }else{            
             $objet['message'] = array('reponse' =>  $reponse['etat'],'message_erreur' => $reponse['erreur']); 
        }
      
        header('Content-type: application/json');
        echo json_encode($objet);
    } 
}
elseif($action == 'confirmation_commande'){  
    $infos_commande = check_infos_commande($token);

}
elseif($action == 'all_view_commandes'){
    
   $liste_commandes=liste_commandes($_SESSION ['client'] ['code_user']);

}

?>