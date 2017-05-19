<?php
//// Les constantes 
// define('root_dir_prof', 'http://localhost/Mega-cous-ligne/debug_test/espaceprof');
// // Les routes a definir
// $routes = array(
//    "home" => "home",
//    "facture" => array("all_view_facture", "view_facture", "liste_facture_demande"),
//    "prestation" => array("all_view_prestation", "liste_prestation_demande"),
//    "compte_rendu" => array("all_view_compte_rendu", "view_compte_rendu", "liste_compte_rendu_demande"),
//    "membre" => array("mon_compte", "modif_profil", "disponibilite", "view_calendrier", "contact_intervenant", "contact_conseiller"),
//);

 // des variables a definir 
 $root_dir = getcwd();
 $module = unhtmlentities($_GET['module']);
 $action = unhtmlentities($_GET['action']);
 
?>


