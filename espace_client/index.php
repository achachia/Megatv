<?php



// version v1-24-04-2015

ini_set("display_errors", 0);
error_reporting(0);

session_start();
session_regenerate_id();

require_once './../connection/config.php';

ini_set('date.timezone', 'Europe/Paris');

/*********************************************************/
$url_absolu='http://megatv.fr/espace_client/';
$current_page_uri = $_SERVER['REQUEST_URI'];
$part_url = explode("/", $current_page_uri);

if(count($part_url)==3){
   $page_name = $part_url['2'];  
}elseif(count($part_url)==4){
    $page_name = $part_url['3'];     
    $param=$part_url['2'];
} 
 

//$email_admin = "megatv69@gmail.com";



if ($page_name=='') {
      
}elseif($page_name=='commandes.html'){
    $module='commandes';
    $action='all_view_commandes';
}elseif($page_name=='contact.html'){   
    $module='membre';
    $action='nous_contacter';
}elseif($page_name=='profil.html'){   
    $module='membre';
    $action='mon_compte';
}elseif($page_name=='messages-recus.html'){   
    $module='membre';
    $action='my_messages_recus';
}elseif($page_name=='messages-envoyes.html'){   
    $module='membre';
    $action='my_messages_envoye';
}elseif($page_name=='deconnection.html'){   
    $module='membre';
    $action='deconnection';
}elseif($page_name=='repondre-message.html'){ 
    $module='membre';
    $action='rep_message_recu';
    $token_message=$param;
}elseif($page_name=='nous-contacter.html'){   
    $module='membre';
    $action='check_formule_contact';
}elseif($page_name=='consulter-message-recu.html'){   
    $module='membre';
    $action='view_message_recu';   
}elseif($page_name=='consulter-message-envoye.html'){   
    $module='membre';
    $action='view_message_envoye';  
}elseif($page_name=='commander-abonnement-iptv-12-mois.html'){   
    $module='commandes';
    $action='add_commande';
    $id_abo=$param;
}elseif($page_name=='commander-abonnement-iptv-6-mois.html'){   
    $module='commandes';
    $action='add_commande';
    $id_abo=$param;
}elseif($page_name=='commander-abonnement-iptv-3-mois.html'){   
    $module='commandes';
    $action='add_commande';
    $id_abo=$param;
}elseif($page_name=='commander-abonnement-cccam-12-mois.html'){   
    $module='commandes';
    $action='add_commande';
    $id_abo=$param;
}elseif($page_name=='commander-abonnement-cccam-6-mois.html'){   
    $module='commandes';
    $action='add_commande';
    $id_abo=$param;
}elseif($page_name=='commander-abonnement-vod-12-mois.html'){   
    $module='commandes';
    $action='add_commande';
    $id_abo=$param;
}elseif($page_name=='commander-abonnement-smart-tv-12-mois.html'){   
    $module='commandes';
    $action='add_commande';
    $id_abo=$param;
}elseif($page_name=='ajouter-commande.html'){   
    $module='commandes';
    $action='check_commande';   
}elseif($page_name=='confirmation-commande.html'){ 
    $module='commandes';
    $action='confirmation_commande';
    $token=$param;
}






/*********************************************************/


$drapeau = TRUE;
$route = TRUE;


if (!isset($_SESSION ['client'] ['code_user'])) {
    
    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/login.php";

    $drapeau = FALSE;
    
} else {
    if ($action == 'deconnection') {
        
        $_SESSION ['client'] ['code_user'] = '';
        
        session_destroy();
        
        $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/login.php?message_deconnection=deconnection_intervenant";

        $drapeau = FALSE;
    }
}

if (!$drapeau) {  
    
    header("Location: $lien");
    
    exit();
    
}


require "./../librairie/fonctions_global/fonctions_global.php";

require_once './module/param_module.php';



require_once './module/routes.php';


require dirname(__FILE__) . dir_controleur . "controleur.php";

?>