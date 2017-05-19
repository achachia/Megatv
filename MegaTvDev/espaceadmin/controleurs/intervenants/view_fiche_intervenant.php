<?php

//controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION['code_conseiller']);
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$infos_interv = infos_intervenant($_GET['code_intervenant']);
$liste_matiere=liste_niveau_matiere_par_intervenant($_GET['code_intervenant']);
//$liste=array('1'=>array('1-1','1-2','1-3'),'2'=>array('2','2-1','2-2','2-3'));
//var_dump(sizeof($liste));
//var_dump($liste);
//var_dump($infos_interv);   
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";

?>