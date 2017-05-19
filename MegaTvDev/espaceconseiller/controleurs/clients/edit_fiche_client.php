<?php
//controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION['code_conseiller']);
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$infos_client = infos_client($_GET['code_client']);
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";
?>