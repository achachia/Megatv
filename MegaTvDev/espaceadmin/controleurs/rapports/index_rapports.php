<?php
require './librairie/redirection.php';
redirection_membre($_SESSION ['code_conseiller']);
//require dirname(dirname(dirname(__FILE__))) . chemin_modele . $module . "/" . $action . ".php";
include dirname(dirname(dirname(__FILE__))) . chemin_vue . $module . "/" . $action . ".php";
?>

