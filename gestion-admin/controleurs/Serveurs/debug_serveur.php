<?php

require './librairie/redirection.php';

redirection_membre($_SESSION ['user_admin'] ['code_user']);

require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";



include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php"; 

?>
