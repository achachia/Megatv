<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['membre'] ['code_intervenant'] );
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$liste_plannig_intervenant = liste_plannig_intervenant ( $_SESSION ['membre'] ['code_intervenant'] );
include  dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";
?>

