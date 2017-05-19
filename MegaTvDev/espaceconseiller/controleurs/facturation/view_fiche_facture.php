<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['code_conseiller'] );
require dirname(dirname(dirname(__FILE__) )).chemin_modele . $module . "/" . $action . ".php";
$infos_facture = infos_facture($_GET['N_facture']);
//var_dump($infos_facture);
$etat_facture_possible=liste_etat($_GET['N_facture']);
$liste_encaissements_facture=liste_encaissements_facture($_GET['N_facture']);
include  dirname(dirname(dirname(__FILE__) )).chemin_vue  . $module . "/" . $action . ".php";
?>

