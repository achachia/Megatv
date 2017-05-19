<?php
//controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION['code_conseiller']);
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$infos_benef = infos_beneficiaire($_GET['code_beneficiaire']);
//var_dump($infos_benef);
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";
?>