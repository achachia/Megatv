<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['membre'] ['code_intervenant'] );
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$infos_distinataire = infos_distinataire ( $_SESSION ['membre'] ['code_intervenant'] );
$badge = nombre_messages_non_lus ( $_SESSION ['membre'] ['code_intervenant'] );
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";
?>


