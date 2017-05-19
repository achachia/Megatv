<?php

require_once './../../../connection/config.php';
require_once './../../modele/rapports/rapport_heures.php';
/*******************************************/
if (isset($_GET['code_famille'])) {
	$code_client = $_GET['code_famille'];
}
/*******************************************/
if (isset($_POST['code_famille'])) {
    $code_client = $_POST['code_famille'];
}else{
   $code_client=NULL; 
}
/*******************************************/
if (isset($_POST['month'])) { 
    $periode=$_POST['month'];
    if (isset($_POST['from']) && isset($_POST['to'])) {
        $from=$_POST['from'];
        $to=$_POST['to'];
    }
    else{
        $from=NULL;
        $to=NULL;
    }
}
else{
   $periode=NULL; 
}
/*******************************************/

$objet = rapport_heures($code_client,$periode,$from,$to);
//$objet = rapport_test($code_client,NULL,NULL,NULL);
header('Content-type: application/json');
echo json_encode($objet);
?>

