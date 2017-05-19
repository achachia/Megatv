<?php
require './librairie/redirection.php';
redirection_membre($_SESSION ['code_conseiller']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_niveau_peda = liste_niveau_peda();
$liste_clients=liste_clients();
//var_dump($liste_clients);
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>
