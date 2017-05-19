<?php

//controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION['code_conseiller']);
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$civilite=array(''=>'Choisir civilit&eacute;','Mme'=>'Mme','M.'=>'M.','Mlle'=>'Mlle');
$nationalite=array(''=>'Choisir nationalit&eacute;','francaise'=>'Française','etrangere'=>'Etrangere','non_defini'=>'non_defini');
$liste_sex=liste_sex();
$liste_statut=liste_statut();
$liste_matiere=liste_matiere();
$liste_zone = liste_zone ();
$liste_niveau = liste_niveau ();
$liste_diplomes=liste_diplomes();
$liste_matiere_intervenant=liste_interv_matiere($_GET['code_intervenant']);
//var_dump($liste_matiere);
//var_dump(sizeof($liste_matiere));
$infos_interv = infos_intervenant($_GET['code_intervenant']);
//var_dump($_GET['code_intervenant']);
//var_dump($infos_interv);   
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";

?>
