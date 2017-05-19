<?php

require './librairie/redirection.php';
redirection_membre($_SESSION ['code_conseiller']);
//require dirname(dirname(dirname(__FILE__))) . chemin_modele . $module . "/" . $action . ".php";
//$rapport_client = identite_client($code_client);
//$rapport_heures = rapport_heures($code_client);
$array_mois = array('1' => 'Janvier', '2' => 'Fevrier', '3' => 'Mars', '4' => 'Avril', '5' => 'Mai', '6' => 'Juin', '7' => 'Juillet', '8' => 'Aout', '9' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Decembre');
$tomonth = date('n');
$toyear = date('Y');
if ($tomonth == 1) {
    $lastmonth = 12;
} else {
    $lastmonth = $tomonth - 1;
}
include dirname(dirname(dirname(__FILE__))) . chemin_vue . $module . "/" . $action . ".php";
?>
