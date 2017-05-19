<?php
require './librairie/redirection.php';
redirection_membre($_SESSION ['code_conseiller']);
require dirname(dirname(dirname(__FILE__))) . chemin_modele . $module . "/" . $action . ".php";
$array_mois = array('1' => 'Janvier', '2' => 'Fevrier', '3' => 'Mars', '4' => 'Avril', '5' => 'Mai', '6' => 'Juin', '7' => 'Juillet', '8' => 'Aout', '9' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Decembre');
$tomonth = date('n');
$toyear = date('Y');
$lastmonth=($tomonth == 1)? 12 : $tomonth - 1;
$liste_famille = liste_famille();
$code_client=(isset($_GET['code_client']))? $_GET['code_client'] : NULL;
if(isset($_GET['code_client'])){
	$rapport_client = identite_client($code_client);	
}
$rapport_e_coupons  = rapport_e_coupons($code_client);
include dirname(dirname(dirname(__FILE__))) . chemin_vue . $module . "/" . $action . ".php";
?>

