<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['code_conseiller']);
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>
