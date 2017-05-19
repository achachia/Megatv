<?php
//controleurs
require './librairie/redirection.php';
redirection_membre($_SESSION ['code_conseiller']);
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$liste_niveau_peda = liste_niveau_peda();
$infos_benef = infos_beneficiaire($_GET['code_beneficiaire']);
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";
?>