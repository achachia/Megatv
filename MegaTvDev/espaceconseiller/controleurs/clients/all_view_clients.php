<?php
// controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION['code_conseiller']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_clients=liste_clients();
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
//inclusion_level ('include', chemin_vue, $module, $action, 2 );
?>
