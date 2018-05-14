<?php

require_once 'connection/config.php';
ini_set('date.timezone', 'Europe/Paris');


$date_actuel = date("Y-m-d");
$date_sept_jour = strftime("%y-%m-%d", mktime(0, 0, 0, date('m'), date('d') - 7, date('y')));

$sql = " DELETE FROM  HistoriqueConnectionMateriel  WHERE DATE_FORMAT(date,'%Y-%m-%d' )<'" . $date_sept_jour . "' ";

echo $sql; 

$resultat = $cxn->prepare($sql);
$resultat->execute();

// date 7 jours avant au format d-m-Y (année sur 4 caractères)
//$date = strftime("%d-%m-%Y", mktime(0, 0, 0, date('m'), date('d')-7, date('y')));
// date 12 jours et 2 mois avant :
//$date = strftime("%y-%m-%d", mktime(0, 0, 0, date('m')-2, date('d')-12, date('y')));
?>

