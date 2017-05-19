<?php
// controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION ['code_admin']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_commandes=liste_commandes();
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>