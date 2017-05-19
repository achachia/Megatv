<?php
require './../librairie/redirection.php';
redirection_membre($_SESSION['code_admin']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_sources=liste_sources();
$liste_SectionVod=liste_SectionVod('2');
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>

