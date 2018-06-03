<?php

require './librairie/redirection.php';

redirection_membre($_SESSION ['user_admin'] ['code_user']);

require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";


$liste_codes_enregistre=liste_codes_enregistre();

$liste_periode=liste_periode();

include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";  

?>