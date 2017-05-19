<?php
function  inclusion_level($action, $categorie, $module, $action, $level) {
	if ($action == 'require') {
		switch ($level) {			
			case 0 :
				include dirname ( __FILE__ ) . $categorie . $module . "/" . $action . ".php";
				break;
			case 1 :
				include dirname ( dirname ( __FILE__ ) ) . $categorie . $module . "/" . $action . ".php";
				break;
		}
	}
}
?>