<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['code_conseiller'] );
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$liste_interventions_traitement_ss_intervenant=liste_interventions_ss_intervenant ('attente');
$liste_interventions_traitement_avec_intervenant = liste_interventions ('attente');
$liste_interventions_confirme = liste_interventions ('confirme');
$liste_interventions_termine = liste_interventions ('termine');
$liste_interventions_annule_sans_choix_intervenant = liste_interventions_annule_sans_choix_intervenant ();
$liste_interventions_annule_avec_choix_intervenant = liste_interventions_annule_avec_choix_intervenant ();
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>

