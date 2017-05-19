<?php
require './../librairie/redirection.php';
redirection_membre($_SESSION['code_admin']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_chaines_Tv=liste_chaines_TV();
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>
