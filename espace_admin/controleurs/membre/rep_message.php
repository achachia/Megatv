<?php
// controleurs
require './librairie/redirection.php';
redirection_membre ( $_SESSION ['membre'] ['code_intervenant'] );
require dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_modele . $module . "/" . $action . ".php";
if (isset ( $_GET ['id_message'] ) && ! empty ( $_GET ['id_message'] )) {
	$id_message = htmlentities ( addslashes ( trim ( $_GET ['id_message'] ) ), ENT_QUOTES );
	mise_a_jour_message_lu ( $id_message, $_SESSION ['membre'] ['code_intervenant'] );
}
$infos_message = infos_message ( $id_message, $_SESSION ['membre'] ['code_intervenant'] );
include dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . "/" . $action . ".php";
?>
