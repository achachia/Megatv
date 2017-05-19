<?php
require_once './../../../connection/config.php';
require_once './../../modele/rapports/rapport_e_coupon.php';
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
$objet = rapport_e_coupons($code_client,$periode,$from,$to);
/*******************************************/
header('Content-type: application/json');
echo json_encode($objet);
?>



