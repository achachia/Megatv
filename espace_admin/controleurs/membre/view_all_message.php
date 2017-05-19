<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['membre'] ['code_intervenant'] );
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
$mes_messages_recus = mes_messages_recus ( $_SESSION ['membre'] ['code_intervenant'] );
$mes_messages_envoye = mes_messages_envoye ( $_SESSION ['membre'] ['code_intervenant'] );
$badge = nombre_messages_non_lus ( $_SESSION ['membre'] ['code_intervenant'] );
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";
?>

