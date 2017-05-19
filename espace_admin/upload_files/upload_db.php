<?php

ini_set("display_errors", 0);
error_reporting(0);

session_start();
session_regenerate_id();

require './../../connection/config.php';

$reponse = TRUE;
$file_name = $_POST['file_name'];
$user=$_SESSION ['membre'] ['code_intervenant'];
$date= date("Y-m-d H:i:s"); 

try {
    $stmt = $cxn->prepare(" INSERT INTO  devoirs_maison (user,filename,date) VALUES (:param1,:param2,:param3)");
    $stmt->bindParam(':param1', $user);
    $stmt->bindParam(':param2', $file_name);
    $stmt->bindParam(':param3', $date);
    $stmt->execute();
} catch (Exception $e) {
    //echo "Une erreur est survenue lors de la rÃ©cupÃ©ration des donnÃ©es";
    $reponse = FALSE;
}
$sql=$file_name.'-'.$user.'-'.$date;
$objet['sql'] = array('sql' => $sql);
$objet['message'] = array('reponse' => $reponse);
header('Content-type: application/json');
echo json_encode($objet);
?>   

