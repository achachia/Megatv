<?php
// controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION ['code_conseiller']);
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$infos_intervention = infos_intervention($_GET['reference_intervention']);
$infos_famille = infos_famille($_GET['reference_intervention']);
$infos_eleve = infos_eleve($_GET['reference_intervention']);
$infos_intervenant = infos_intervenant($_GET['reference_intervention']);
$etat_intervention_possible=liste_etat($_GET['reference_intervention']);
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>