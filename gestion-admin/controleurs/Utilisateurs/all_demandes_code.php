<?php

require './librairie/redirection.php';

redirection_membre($_SESSION ['user_admin'] ['code_user']);

require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";

$liste_demandes_attente=liste_demandes_attente();

$liste_codes_test_valides=liste_codes_test_valides();

$liste_periode=liste_periode();

include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";  

?>

