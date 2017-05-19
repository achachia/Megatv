<?php

// version v1-24-04-2015

ini_set("display_errors", 0);
error_reporting(0);

session_start();
session_regenerate_id();



$drapeau = TRUE;
$route = TRUE;
$module = $_GET['module'];
$action = $_GET['action'];


if (!isset($_SESSION ['user_admin'] ['code_user'])) {
    
    $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/login.php";

    $drapeau = FALSE;
    
} else {
    if ($action == 'deconnection') {
        
        $_SESSION ['user_admin'] ['code_user'] = '';
        
        session_destroy();
        
        $lien = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/login.php?message_deconnection=deconnection_intervenant";

        $drapeau = FALSE;
    }
}

if (!$drapeau) {  
    
    header("Location: $lien");
    
    exit();
    
}

require_once './../connection/config.php';

require "./../librairie/fonctions_global/fonctions_global.php";

//require './module/fonctions_module.php';

require_once './module/param_module.php';








require_once './module/routes.php';

require dirname(__FILE__) . dir_controleur . "controleur.php";
?>