<?php
function unhtmlentities($string) {
	$string = trim ( $string );
	$string = (! get_magic_quotes_gpc ()) ? addslashes ( $string ) : $string;
	$string = htmlentities ( $string, ENT_QUOTES );
	return $string;
}
function add_year_date($date){
    //durée à rajouter : 6 mois;
    $duree = 12;

    //la première étape est de transformer cette date en timestamp
    $dateDepartTimestamp = strtotime($date);

    //on calcule la date de fin
    $dateFin = date('Y-m-d', strtotime('+'.$duree.'month', $dateDepartTimestamp ));
    return $dateFin;
}
function inclusion_level($type, $categorie,$module, $action, $level) {
	if ($type == 'require') {
		switch ($level) {
			case 0 :
				if ($module == '*') {
					require dirname ( dirname ( __FILE__ ) ) . $categorie . $action . ".php";
				} else {
					require dirname ( dirname ( __FILE__ ) ) . $categorie . $module . "/" . $action . ".php";
				}				
				break;
			case 1 :
				if ($module == '*') {
					require dirname ( dirname ( __FILE__ ) )  . $categorie . $action . ".php";
				} else {
					require dirname ( dirname ( __FILE__ ) )  . $categorie . $module . "/" . $action . ".php";
					
				}
				break;
			case 2 :
				if ($module == '*') {
					require  dirname ( dirname ( __FILE__ ) )  . $categorie . $action . ".php";
				} else {
					require  dirname ( dirname ( __FILE__ ) ) . $categorie . $module . "/" . $action . ".php";
				}
				break;
		}
	} 

	elseif ($type == 'include') {
		switch ($level) {
			case 0 :
				if ($module = '*') {
					include dirname ( dirname ( __FILE__ ) ) . $categorie . $action . ".php";
				} else {
					include dirname ( dirname ( __FILE__ ) ) . $categorie . $module . "/" . $action . ".php";
				}
				break;
			case 1 :
				if ($module == '*') {
					include dirname ( dirname ( dirname ( __FILE__ ) ) ) . $categorie . $action . ".php";
				} else {
					include dirname ( dirname ( dirname ( __FILE__ ) ) ) . $categorie . $module . "/" . $action . ".php";
				}
				break;
			case 2 :
				if ($module == '*') {
					include  dirname ( dirname ( __FILE__ ) )  . $categorie . $action . ".php";
				} else {					
					include  dirname(dirname(__FILE__) ). $categorie . $module . "/" . $action . ".php";
				}
				break;
		}
	}
}
?>
