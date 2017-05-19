<?php
require './../librairie/redirection.php';
redirection_membre($_SESSION['code_admin']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_fichiers=liste_fichiers('1');
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>
