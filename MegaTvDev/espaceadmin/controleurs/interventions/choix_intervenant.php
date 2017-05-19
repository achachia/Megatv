<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['code_conseiller'] );
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$infos_utile_intervention = infos_utile_intervention($_GET['reference_intervention']);
$infos_famille = infos_famille($_GET['reference_intervention']);
$infos_eleve = infos_eleve($_GET['reference_intervention']);
$liste_intervenants = liste_intervenants ();
$infos_intervention = infos_intervention ( $_GET ['reference_intervention'] );
$liste_intervenants_prive = liste_intervenants_prive ( $infos_intervention );
$liste_disponibilite = liste_disponibilite ( $liste_intervenants_prive, $infos_intervention ['diponibilite'] );
$test=''; 
foreach ($liste_disponibilite as $value) {
      $test.= $value ['intervenant_latitude'].'-'.$value ['intervenant_longitude'].",";
   }
   $test = substr ( $test, 0, - 1 );
   echo $test;
  
//var_dump($infos_intervention);
//var_dump($liste_intervenants_prive);
//var_dump($infos_intervention ['diponibilite']);
//var_dump($liste_disponibilite);
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";
?>
