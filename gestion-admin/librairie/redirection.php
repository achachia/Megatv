<?php
function redirection_membre($user) {
	$etat = false;
	$lien = "http://" . $_SERVER ['HTTP_HOST'] . rtrim ( $_SERVER ['PHP_SELF'], '/\\' );
	if (! isset ( $ser )) {
		$etat = true;
		$lien = substr ( $lien, 0, - 9 ) . "login.php";
	} else {
		if (! isset ( $module ) || ! isset ( $action ) || ! is_file ( dirname ( dirname ( dirname ( __FILE__ ) ) ) . chemin_vue . $module . '/' . $action . '.php' )) {
			$etat = true;
			$lien = substr ( $lien, 0, - 9 ) . "index.php";
		}
	}	
	if (!$etat) {	    
		header ( "Location: $lien" );		
	}
}

?>
