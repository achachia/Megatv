<?php
if (isset ( $_SESSION ['code_conseiller'] )) {
	$_SESSION ['code_conseiller'] = NULL;
	unset ( $_SESSION ['code_conseiller'] );
	session_destroy ();
} else {
	$lien = "http://" . $_SERVER ['HTTP_HOST'] . rtrim ( dirname ( dirname ( dirname ( $_SERVER ['PHP_SELF'] ) ) ), '/\\' ) . "/login.php?message_deconnection=deconnection_conseiller";
	header ( "Location: $lien" );
	exit ();
}
?>

