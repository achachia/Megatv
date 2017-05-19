<?php
session_start ();
session_regenerate_id ();
require_once './../../../connection/config.php';
require './../../librairie/protection_contenu.php';
require_once './../../librairie/generer_code.php';
ini_set('date.timezone', 'Europe/Paris'); 
$etat = TRUE;
$objet = array ();
if (isset($_POST ['code_client'])) {   
    $sql = " SELECT N_compte_banc  FROM membre_famille  WHERE code_famille=:param ";
    $resultat = $cxn->prepare($sql);
    $resultat->bindParam(':param', $param);
    $param = $_POST ['code_client'];
    $resultat->execute();
    $i = 0;
    while ($enregistrement = $resultat->fetch()) {
        $key=$_POST ['code_client'].'_'.$enregistrement ['N_compte_banc'];
        $liste [$i] ['val1'] = $key;
        $liste [$i] ['val2'] = $enregistrement ['N_compte_banc'];
        $i ++;
    }
    $liste_comptes= $liste;
}
//$liste_comptes=array("key1"=>"val1","key2"=>"val2");
$objet ['message'] ['liste_comptes'] = $liste_comptes;
$objet ['message'] ['reponse'] = $etat;
header('Content-type: application/json');
echo json_encode($objet);
?>

