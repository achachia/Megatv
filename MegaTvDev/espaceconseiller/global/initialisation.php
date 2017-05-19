<?php
session_start ();
session_regenerate_id ();
require_once './../connection/config.php'; 
//require_once './config.php';
require './librairie/protection_contenu.php';


/////////////// inculude script config
if (isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['module']) && !empty($_GET['module'])) {
    $action = unhtmlentities($_GET['action']);
    $module = unhtmlentities($_GET['module']);
} else {
    $action = 'home'; 
    $module = 'home'; 
}
/////////////// les attributs de la page 
require  dirname(dirname(__FILE__)).chemin_modele .initialisation ;
$infos_page = infos_page($action);
$title_page = $infos_page['title_page'];
$breadcrumb = "<li>" . $infos_page['breadcrumb'] . "</li>";
?>