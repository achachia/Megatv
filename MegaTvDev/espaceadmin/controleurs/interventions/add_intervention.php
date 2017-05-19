<?php
// controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION ['code_conseiller']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_duree = liste_duree();
$liste_famille = liste_famille($_SESSION['code_conseiller']);
$liste_matiere=liste_matiere();
$liste_sex=liste_sex();
$liste_statut=liste_statut();
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>


